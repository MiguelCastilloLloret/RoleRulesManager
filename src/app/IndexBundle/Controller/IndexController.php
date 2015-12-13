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
    public $pj1;
    public $pj2;
    public $action;
    public $spell;
    public $CD;
    public $skill;
}

class game{
    public $game;
}

class idPlantilla{
    public $id;
}


class IndexController extends Controller{
    /**
     * @Route("/reglas")
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

    public function selectAction(Request $request){

        $game = new game();
        $hola = "";

        //Se crea el formulario de selección de juego

        $var = $this->createFormBuilder($game)
            ->add('game','choice', array('choices' => array("DD35Master" => 'D&D35', "VampiroMaster" => 'Vampiro'), 'required' => true))
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

    public function DD35Action(Request $request){

        $html = $this->container->get('templating')->render(
            'index/rolManage.html.twig', array('hola' => '', 'juego' => 'DD35Master')
        );

        return new Response($html);
    }

    public function DD35CreateAction(Request $request){ 
        $hola = "";
        $tipo = "";
        $link = "crear";
        $em = $this->get('doctrine.orm.default_entity_manager');

        $List = $em->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\DD35\Plantilla p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $pj = new Personaje();
        $var = $this->createFormBuilder($pj)
            ->add('nombre')
            ->add('clase')
            ->add('nivel')
            ->add('puntosVida')
            ->add('claseArmadura')
            ->add('bonusFuerza')
            ->add('bonusDestreza')
            ->add('bonusConstitucion')
            ->add('bonusInteligencia')
            ->add('bonusSabiduria')
            ->add('bonusCarisma')
            ->add('salvacionFortaleza')
            ->add('salvacionVoluntad')
            ->add('salvacionReflejos')
            ->add('estado')
            ->add('resistenciaMagica')
            ->add('reduccionDano')
            ->add('arma')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                if($plantilla->isValid()){
                    $personajePlantilla = $em->getRepository('app\IndexBundle\Entity\DD35\Plantilla')->find($id->id);
                    $pj = $personajePlantilla;
                    $var = $this->createFormBuilder($pj)
                        ->add('nombre')
                        ->add('clase')
                        ->add('nivel')
                        ->add('puntosVida')
                        ->add('claseArmadura')
                        ->add('bonusFuerza')
                        ->add('bonusDestreza')
                        ->add('bonusConstitucion')
                        ->add('bonusInteligencia')
                        ->add('bonusSabiduria')
                        ->add('bonusCarisma')
                        ->add('salvacionFortaleza')
                        ->add('salvacionVoluntad')
                        ->add('salvacionReflejos')
                        ->add('estado')
                        ->add('resistenciaMagica')
                        ->add('reduccionDano')
                        ->add('arma')
                        ->getForm();
                    }
            }
            else{
                $var->bind($request);
                if($var->isValid()){
                    $em->persist($pj);
                    $nombrePlantilla = $em->createQuery("SELECT p.nombre FROM app\IndexBundle\Entity\DD35\Plantilla p WHERE p.nombre = '".$pj->nombre."'")->getResult();
                    if(empty($nombrePlantilla)){
                        $pl= new Plantilla($pj->nombre, $pj->clase, $pj->nivel, $pj->puntosVida, $pj->claseArmadura, $pj->bonusFuerza, $pj->bonusDestreza, $pj->bonusConstitucion, $pj->bonusInteligencia, $pj->bonusSabiduria, $pj->bonusCarisma, $pj->salvacionVoluntad, $pj->salvacionFortaleza, $pj->salvacionReflejos, $pj->estado, $pj->resistenciaMagica, $pj->reduccionDano, $pj->arma);
                        $em->persist($pl);
                    }
                    $em->flush();
                    $hola = "Se introdujo correctamente el personaje en la BD";
                }
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link)
        );

        return new Response($html);
    }

    public function DD35ChangeAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "modificar";
        $em = $this->get('doctrine.orm.default_entity_manager');

        $List = $em->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\DD35\Personaje p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $personajePlantilla = new Personaje();
        $var = $this->createFormBuilder($personajePlantilla)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clase')
            ->add('nivel')
            ->add('puntosVida')
            ->add('claseArmadura')
            ->add('bonusFuerza')
            ->add('bonusDestreza')
            ->add('bonusConstitucion')
            ->add('bonusInteligencia')
            ->add('bonusSabiduria')
            ->add('bonusCarisma')
            ->add('salvacionFortaleza')
            ->add('salvacionVoluntad')
            ->add('salvacionReflejos')
            ->add('estado')
            ->add('resistenciaMagica')
            ->add('reduccionDano')
            ->add('arma')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                if($plantilla->isValid()){
                    $personajePlantilla = $em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($id->id);
                    var_dump($personajePlantilla);
                    $tipo = "";
                    $var = $this->createFormBuilder($personajePlantilla)
                        ->add('ID', 'hidden')
                        ->add('nombre')
                        ->add('clase')
                        ->add('nivel')
                        ->add('puntosVida')
                        ->add('claseArmadura')
                        ->add('bonusFuerza')
                        ->add('bonusDestreza')
                        ->add('bonusConstitucion')
                        ->add('bonusInteligencia')
                        ->add('bonusSabiduria')
                        ->add('bonusCarisma')
                        ->add('salvacionFortaleza')
                        ->add('salvacionVoluntad')
                        ->add('salvacionReflejos')
                        ->add('estado')
                        ->add('resistenciaMagica')
                        ->add('reduccionDano')
                        ->add('arma')
                        ->getForm();
                    }
            }
            else{
                $var->bind($request);
                if($var->isValid()){
                    $em->merge($personajePlantilla);
                    $em->flush();
                    $hola = "Se modificó correctamente el personaje en la BD";
                }
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link)
        );

        return new Response($html);
    }
    
    public function DD35DeleteAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "eliminar";
        $em = $this->get('doctrine.orm.default_entity_manager');

        $List = $em->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\DD35\Personaje p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $pj = new Personaje();
        $var = $this->createFormBuilder($pj)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clase')
            ->add('nivel')
            ->add('puntosVida')
            ->add('claseArmadura')
            ->add('bonusFuerza')
            ->add('bonusDestreza')
            ->add('bonusConstitucion')
            ->add('bonusInteligencia')
            ->add('bonusSabiduria')
            ->add('bonusCarisma')
            ->add('salvacionFortaleza')
            ->add('salvacionVoluntad')
            ->add('salvacionReflejos')
            ->add('estado')
            ->add('resistenciaMagica')
            ->add('reduccionDano')
            ->add('arma')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                $personajePlantilla = $em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($id->id);
                $em->remove($personajePlantilla);
                $em->flush();
                $hola = "El personaje se borró correctamente";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link)
        );

        return new Response($html);
    }

    public function VampiroAction(Request $request){

        $html = $this->container->get('templating')->render(
            'index/rolManage.html.twig', array('hola' => '', 'juego' => 'VampiroMaster')
        );

        return new Response($html);
    }

    public function VampiroCreateAction(Request $request){ 
        $hola = "";
        $tipo = "";
        $link = "crear";
        $ev = $this->get('doctrine.orm.vamp_entity_manager');

        $List = $ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\\vPlantilla p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $pj = new vPersonaje();
        $var = $this->createFormBuilder($pj)
            ->add('nombre')
            ->add('clan')
            ->add('generacion')
            ->add('puntosVida')
            ->add('armadura')
            ->add('bonusFuerza')
            ->add('bonusDestreza')
            ->add('bonusResistencia')
            ->add('bonusInteligencia')
            ->add('bonusManipulacion')
            ->add('bonusApariencia')
            ->add('bonusPercepcion')
            ->add('bonusAstucia')
            ->add('bonusCarisma')
            ->add('conciencia')
            ->add('autocontrol')
            ->add('coraje')
            ->add('estado')
            ->add('fuerzaVoluntad')
            ->add('sangre')
            ->add('arma')
            ->add('habilidades', 'text')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                if($plantilla->isValid()){
                    $personajePlantilla = $ev->getRepository('app\IndexBundle\Entity\Vampiro\vPlantilla')->find($id->id);
                    $pj = $personajePlantilla;
                    $var = $this->createFormBuilder($pj)
                        ->add('nombre')
                        ->add('clan')
                        ->add('generacion')
                        ->add('puntosVida')
                        ->add('armadura')
                        ->add('bonusFuerza')
                        ->add('bonusDestreza')
                        ->add('bonusResistencia')
                        ->add('bonusInteligencia')
                        ->add('bonusManipulacion')
                        ->add('bonusApariencia')
                        ->add('bonusPercepcion')
                        ->add('bonusAstucia')
                        ->add('bonusCarisma')
                        ->add('conciencia')
                        ->add('autocontrol')
                        ->add('coraje')
                        ->add('estado')
                        ->add('fuerzaVoluntad')
                        ->add('sangre')
                        ->add('arma')
                        ->add('habilidades', 'text')
                        ->getForm();
                    }
            }
            $var->bind($request);
            if($var->isValid()){
                $ev->persist($pj);
                $nombrePlantilla = $ev->createQuery("SELECT p.nombre FROM app\IndexBundle\Entity\Vampiro\\vPlantilla p WHERE p.nombre = '".$pj->nombre."'")->getResult();
                if(empty($nombrePlantilla)){
                    $pl= new vPlantilla($pj->nombre, $pj->clan, $pj->generacion, $pj->puntosVida, $pj->armadura, $pj->bonusFuerza, $pj->bonusDestreza, $pj->bonusResistencia, $pj->bonusInteligencia, $pj->bonusManipulacion, $pj->bonusApariencia, $pj->bonusPercepcion, $pj->bonusAstucia, $pj->bonusCarisma, $pj->conciencia, $pj->autocontrol, $pj->coraje, $pj->estado, $pj->fuerzaVoluntad, $pj->sangre, $pj->arma, $pj->habilidades);
                    $ev->persist($pl);
                }
                $ev->flush();
                $hola = "Se introdujo correctamente el personaje en la BD";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(), 'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link)
        );

        return new Response($html);
    }

    public function VampiroChangeAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "modificar";
        $ev = $this->get('doctrine.orm.vamp_entity_manager');

        $List = $ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\\vPlantilla p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $personajePlantilla = new vPersonaje();
        $var = $this->createFormBuilder($personajePlantilla)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clan')
            ->add('generacion')
            ->add('puntosVida')
            ->add('armadura')
            ->add('bonusFuerza')
            ->add('bonusDestreza')
            ->add('bonusResistencia')
            ->add('bonusInteligencia')
            ->add('bonusManipulacion')
            ->add('bonusApariencia')
            ->add('bonusPercepcion')
            ->add('bonusAstucia')
            ->add('bonusCarisma')
            ->add('conciencia')
            ->add('autocontrol')
            ->add('coraje')
            ->add('estado')
            ->add('fuerzaVoluntad')
            ->add('sangre')
            ->add('arma')
            ->add('habilidades', 'text')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                if($plantilla->isValid()){
                    $personajePlantilla = $ev->getRepository('app\IndexBundle\Entity\Vampiro\vPlantilla')->find($id->id);
                    $tipo = "";
                    $var = $this->createFormBuilder($personajePlantilla)
                        ->add('ID', 'hidden')
                        ->add('nombre')
                        ->add('clan')
                        ->add('generacion')
                        ->add('puntosVida')
                        ->add('armadura')
                        ->add('bonusFuerza')
                        ->add('bonusDestreza')
                        ->add('bonusResistencia')
                        ->add('bonusInteligencia')
                        ->add('bonusManipulacion')
                        ->add('bonusApariencia')
                        ->add('bonusPercepcion')
                        ->add('bonusAstucia')
                        ->add('bonusCarisma')
                        ->add('conciencia')
                        ->add('autocontrol')
                        ->add('coraje')
                        ->add('estado')
                        ->add('fuerzaVoluntad')
                        ->add('sangre')
                        ->add('arma')
                        ->add('habilidades', 'text')
                        ->getForm();
                    }
            }
            $var->bind($request);
            if($var->isValid()){
                $ev->flush();
                $hola = "Se modificó correctamente el personaje en la BD";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(), 'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link)
        );

        return new Response($html);
    }

    public function VampiroDeleteAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "eliminar";
        $ev = $this->get('doctrine.orm.vamp_entity_manager');

        $List = $ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\\vPersonaje p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $pj = new Personaje();
        $var = $this->createFormBuilder($pj)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clan')
            ->add('generacion')
            ->add('puntosVida')
            ->add('armadura')
            ->add('bonusFuerza')
            ->add('bonusDestreza')
            ->add('bonusResistencia')
            ->add('bonusInteligencia')
            ->add('bonusManipulacion')
            ->add('bonusApariencia')
            ->add('bonusPercepcion')
            ->add('bonusAstucia')
            ->add('bonusCarisma')
            ->add('conciencia')
            ->add('autocontrol')
            ->add('coraje')
            ->add('estado')
            ->add('fuerzaVoluntad')
            ->add('sangre')
            ->add('arma')
            ->add('habilidades', 'text')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                $personajePlantilla = $ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($id->id);
                $ev->remove($personajePlantilla);
                $ev->flush();
                $hola = "El personaje se borró correctamente";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link)
        );

        return new Response($html);
    }
}
?> 