<?php
namespace App\Neo\NeoBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Console\Input\InputOption;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\NEO;

class FetchCommand extends Command
{
		protected static $defaultName = 'neo:fetch';
		private $em;

		public function __construct(){
			parent::__construct();
		}

		protected function configure(EntityManagerInterface $em){
			$this->em = $em;
			$this
				->setDescription('to request the data since requested time from nasa api')
				->setHelp('accept 1 option --since -s with default 3 days')
				->addOption('since', null, InputOption::VALUE_REQUIRED, 'since n days', 3)
			;
		}

		protected function execute(InputInterface $input, OutputInterface $output){
			$since = $input->getOption('since');

			if($since < 1){
				$output->writeln(['since must be >= 1']);
				return -1;
			}

			if($since > 7){
				$output->writeln(['since must be <= 7']);
				return -1;
			}

			$currentTime = time();
			$format = "Y-m-d";
			$endDate = date($format, $currentTime);
			$startDate = date($format, strtotime("-".strval($since - 1)." day", $currentTime));

			$client = HttpClient::create();
			$output->writeln(['retrieving data from nasa api from '.$startDate.' to '.$endDate.'; since '.strval($since).' days']);
			$response = $client->request(
				'GET', 
				'https://api.nasa.gov/neo/rest/v1/feed?detailed=true&api_key=0PwUQG3UbV278anbQuKzGOFpUKWuU2aQC8vFsXcE&start_date='.$startDate.'&end_date='.$endDate
			);

			$statusCode = $response->getStatusCode();
			if($statusCode == 200){
				$output->writeln(['data retrieved']);
			} else {
				$output->writeln(['an error has occured']);
				return -1;
			}
			$output->writeln(['displaying retrieved data']);

			$content = $response->toArray();

			$output->writeln([
				'data since ' . $since . ' day(s) requested from nasa api',
				'============',
				'',
			]);

			$elementCount = $content["element_count"];
			$nearEarthObjects = $content["near_earth_objects"];
			$neosForDb = [];

			foreach($nearEarthObjects as $date => $nearEarthObjectsPerDate){
				foreach($nearEarthObjectsPerDate as $nearEarthObject){
					$closeApproachData = $nearEarthObject["close_approach_data"];
					$relativeVelocity = array_key_exists("relative_velocity", $closeApproachData) ? $closeApproachData["relative_velocity"] : false;
					
					$kilometersPerHour = $relativeVelocity ? $relativeVelocity["kilometers_per_hour"] : "unknown";

					$isHazardousBool = $nearEarthObject["is_potentially_hazardous_asteroid"];

					$isHazardous = $isHazardousBool ? "true" : "false";

					$reference = $nearEarthObject["neo_reference_id"];
					$name = $nearEarthObject["name"];

					$output->writeln([
						"date: ".$date,
						"reference: ".$reference,
						"name: ".$name,
						"speed: ".$kilometersPerHour,
						"is hazardous: ".$isHazardous,
						"------------------------------------------------"	
					]);

					$neosForDb[] = [
						"date" => DateTime::createFromFormat($format, $date),
						"reference" => $reference,
						"name" => $name,
						"speed" => $kilometersPerHour,
						"is_hazardous" => $isHazardousBool
					];
				}
			}

			$output->writeln([
				'count of Near-Earth Objects: ' . $elementCount
			]);

			$output->writeln([
				'saving NEOs to database'
			]);

			foreach($neosForDb as $neo){
				$n = new NEO();
				$n->setReference($neo["reference"]);
				$n->setName($neo["name"]);
				$n->setSpeed($neo["speed"]);
				$n->setIsHazardous($neo["is_hazardous"]);
				$this->em->persist($n);
			}

			$this->em->flush();

			return 0;
		}
}
