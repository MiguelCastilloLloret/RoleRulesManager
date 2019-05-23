<?php
// src/IndexBundle/Controller/IndexController.php

namespace app\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use app\IndexBundle\Controller\Listener\AddGamesFieldSubscriber;
use app\IndexBundle\Controller\SistemaReglas\SistemaReglas;
use app\IndexBundle\Entity\DD35\Personaje;
use app\IndexBundle\Entity\DD35\Plantilla;
use app\IndexBundle\Entity\Vampiro\vPersonaje;
use app\IndexBundle\Entity\Vampiro\vPlantilla;

class formExecutor{
    public $game;
    public $party;
    public $pj1;
    public $pj2;
    public $action;
    public $spell;
    public $CD;
    public $skill;
    public $id;
}

class game{
    public $game;
}

class IndexController extends Controller{
    /**
     * @Route("/reglas")
     */
    public function indexAction(Request $request){

        $userId = $this->getUser()->getId();

        $executor = new formExecutor();

        $executor->id = $userId;

        //Se crea el formulario de selección de juego

        $var = $this->createFormBuilder($executor)
            ->add('game','choice', array('choices' => array("DD35" => 'D&D35', "Vampiro" => 'Vampiro'), 'required' => true), 'label' => 'Juego')
            ->add('party','text', array('required' => true))
            ->add('id','hidden', array('required' => true))
            ->addEventSubscriber($this->get('my_form_editor'))
            ->getForm();

        if ($request->isMethod('POST')) {
            $var->bind($request);
            if ($var->isValid()) {
                $SistemaReglas = $this->get('my_rules_manager');
                $hola = $SistemaReglas->ejecutorReglas($executor);
                $html = $html = $this->container->get('templating')->render(
                    'index/index.html.twig', array('form' => $var->createView(), 'hola' => $hola)
                 );
                return new Response($html);
            }
        }
        else{
            $html = $this->container->get('templating')->render(
            'index/index.html.twig', array('form' => $var->createView(), 'hola' => '')
        );
        }

        return new Response($html);
    }

    public function selectAction(Request $request){

        $game = new game();
        $hola = "";

        //Se crea el formulario de selección de juego

        $var = $this->createFormBuilder($game)
            ->add('game','choice', array('choices' => array("DD35Master" => 'D&D35', "VampiroMaster" => 'Vampiro'), 'required' => true), 'label' => 'Juego')
            ->getForm();

        if ($request->isMethod('POST')) {
            $var->bind($request);
            $cad = "./".$game->game;
            return $this->redirect($cad,301);
        }
        else{
            $html = $this->container->get('templating')->render(
                'index/select.html.twig', array('form' => $var->createView(), 'hola' => $hola)
            );

            return new Response($html);
        }
    }
}
?> 