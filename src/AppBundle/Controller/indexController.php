// src/AppBundle/Controller/IndexController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class IndexController extends Controller{
    /**
     * @Route("/hola")
     */
    public function indexAction(){

        $var = "PENE";

        $html = $this->container->get('templating')->render(
            'index/index.html.twig'
        );

        return new Response($html);
    }
}
