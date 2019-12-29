<?php
namespace App\Controller;

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;

class DefaultController extends AbstractController
{
    /**
     * @var KernelInterface
     */
    private $appKernel;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }

    public function index()
    {
        $projectDir = realpath($this->appKernel->getProjectDir()).\DIRECTORY_SEPARATOR;
        $docVersion = substr(Kernel::VERSION, 0, 3);

        return $this->render('default/welcome.html.twig', [
            'projectDir' => $projectDir,
            'docVersion' => $docVersion,
        ]);
    }

    public function hello()
    {
				return $this->json(["hello" => "world!"]); 
    }
}
