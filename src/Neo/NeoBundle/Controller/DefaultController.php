<?php
namespace App\Neo\NeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\NEO;

class DefaultController extends AbstractController
{
    public function hazardous()
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->findBy(["is_hazardous" => true]);
				return $this->json($r); 
    }

    public function fastest($hazardous)
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->findFastest($hazardous ? true : false);
				return $this->json($r); 
    }

    public function bestYear($hazardous)
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->bestYear($hazardous ? true : false);
				return $this->json($r); 
    }

    public function bestMonth($hazardous)
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->bestMonth($hazardous ? true : false);
				return $this->json($r); 
    }
}
