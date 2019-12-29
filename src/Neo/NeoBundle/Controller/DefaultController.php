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
}
