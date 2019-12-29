<?php
namespace App\Neo\NeoBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Console\Input\InputOption;

class FetchCommand extends Command
{
		protected static $defaultName = 'neo:fetch';

		public function __construct(){
			parent::__construct();
		}

		protected function configure(){
			$this
				->setDescription('to request the data since requested time from nasa api')
				->setHelp('accept 1 option --since -s with default 3 days')
				->addOption('since', null, InputOption::VALUE_REQUIRED, 'since n days', 3)
			;
		}

		protected function execute(InputInterface $input, OutputInterface $output){
			$since = $input->getOption('since');
			$output->writeln([
				'data since ' . $since . ' day(s) requested from nasa api',
				'============',
				'',
			]);
			return 0;
		}
}
