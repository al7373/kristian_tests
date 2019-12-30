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

    public function fastest()
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->findFastest();
				return $this->json($r); 
    }

    public function fastestHazardous()
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->findFastest(true);
				return $this->json($r); 
    }

    public function bestYear()
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->bestYear(true);
				return $this->json($r); 
    }

    public function bestMonth()
    {
				$r = $this->getDoctrine()->getRepository(NEO::class)->bestMonth(true);
				return $this->json($r); 
    }
}
