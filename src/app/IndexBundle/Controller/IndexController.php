<?php
// src/IndexBundle/Controller/IndexController.php

namespace app\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use app\IndexBundle\Controller\SistemaReglas\SistemaReglas;
use app\IndexBundle\Controller\Listener\AddGamesFieldSubscriber;

class formExecutor{
    public $game;
    public $pj1;
    public $pj2;
    public $action;
    public $spell;
    public $CD;
    public $skill;
}

class IndexController extends Controller{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request){

        $executor = new formExecutor();

        //Se crea el formulario de selección de juego

        $var = $this->createFormBuilder($executor)
            ->add('game','choice', array('choices' => array("DD35" => 'D&D35', "Vampiro" => 'Vampiro'), 'required' => true))
            ->addEventSubscriber($this->get('my_form_editor'))
            ->getForm();


        $html = $this->container->get('templating')->render(
            'index/index.html.twig', array('form' => $var->createView(), 'hola' => '')
        );

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

        return new Response($html);
    }
}
?> 