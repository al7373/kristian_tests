<?php
namespace App\Neo\NeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

class DefaultController extends AbstractController
{
    public function testNeoBundle()
    {
				return $this->json(["test" => "ok"]); 
    }
}
