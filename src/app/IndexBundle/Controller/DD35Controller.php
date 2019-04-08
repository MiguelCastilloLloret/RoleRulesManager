<?php

namespace app\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormView;
use app\IndexBundle\Entity\DD35\Personaje;
use app\IndexBundle\Entity\DD35\Plantilla;
use app\IndexBundle\Controller\idPlantilla;
use app\IndexBundle\Entity\DD35\Arma;


class DD35Controller extends Controller{

    public $userId;

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
        $inputValue = "Importar";
        $em = $this->get('doctrine.orm.default_entity_manager');
        $plList = NULL;

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
        $security_context = $this->get('security.context');
        $security_token = $security_context->getToken();
        $userId = $security_token->getUser()->getId();
        $pj->usuario = $userId;
        $var = $this->createFormBuilder($pj)
            ->add('nombre')
            ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
            ->add('nivel')
            ->add('puntosVida')
            ->add('vidaMaxima')
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
            ->add('partida')
            ->add('usuario','hidden')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                if($plantilla->isValid()){
                    $personajePlantilla = $em->getRepository('app\IndexBundle\Entity\DD35\Plantilla')->find($id->id);
                    $pj = $personajePlantilla;
                    $pj->vidaMaxima = $pj->puntosVida;
                    $pj->partida = "Introduzca Partida";
                    $pj->usuario = $userId;
                    $var = $this->createFormBuilder($pj)
                        ->add('nombre')
                        ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
                        ->add('nivel')
                        ->add('puntosVida')
                        ->add('vidaMaxima')
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
                        ->add('partida')
                        ->add('usuario','hidden')
                        ->getForm();
                    }
            }
            else{
                $var->bind($request);
                if($var->isValid()){
                    $em->persist($pj);
                    $em->flush();
                    $hola = "Se introdujo correctamente el personaje en la BD";
                }
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function DD35CreatePAction(Request $request){ 
        $hola = "";
        $tipo = "";
        $link = "crearPlantilla";
        $inputValue = "Importar";
        $em = $this->get('doctrine.orm.default_entity_manager');
        $plList = NULL;

        $List = $em->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\DD35\Plantilla p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $pj = new Plantilla();
        $var = $this->createFormBuilder($pj)
            ->add('nombre')
            ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
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
                        ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
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
                    $em->flush();
                    $hola = "Se introdujo correctamente la plantilla en la BD";
                }
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function DD35ChangeAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "modificar";
        $inputValue = "Importar";
        $plList = NULL;
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
            ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
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
                    $tipo = "";
                    $var = $this->createFormBuilder($personajePlantilla)
                        ->add('ID', 'hidden')
                        ->add('nombre')
                        ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
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
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }
    
    public function DD35DeleteAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "eliminar";
        $inputValue = "Eliminar";
        $plList = NULL;
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
            ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
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
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function DD35DeletePAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "eliminar";
        $inputValue = "Eliminar";
        $plList = NULL;
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
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clase', 'choice', array('choices' => array("Guerrero" => 'Guerrero', "Mago" => 'Mago', "Clerigo" => 'Clerigo', "Picaro" => 'Picaro', "Explorador" => 'Explorador', "Barbaro" => 'Barbaro', "Bardo" => 'Bardo', "Hechicero" => 'Hechicero', "Druida" => 'Druida', "Paladin" => 'Paladin', "Monje" => 'Monje')))
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
                $personajePlantilla = $em->getRepository('app\IndexBundle\Entity\DD35\Plantilla')->find($id->id);
                $em->remove($personajePlantilla);
                $em->flush();
                $hola = "La plantilla se borró correctamente";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function DD35CreateWAction(Request $request){ 
        $hola = "";
        $tipo = "";
        $link = "crearArma";
        $inputValue = "";
        $em = $this->get('doctrine.orm.default_entity_manager');

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id')
            ->getForm();


        $w = new Arma();
        $security_context = $this->get('security.context');
        $var = $this->createFormBuilder($w)
            ->add('nombre')
            ->add('dado','integer')
            ->add('dano', 'integer', array('label' => 'Numero de Dados'))
            ->add('bonus')
            ->getForm();

        if ($request->isMethod('POST')) {
            $var->bind($request);
            if($var->isValid()){
                $em->persist($w);
                $em->flush();
                $hola = "Se introdujo correctamente el arma en la BD";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function DD35DeleteWAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "eliminarArma";
        $inputValue = "Eliminar";
        $plList = NULL;
        $em = $this->get('doctrine.orm.default_entity_manager');

        $List = $em->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\DD35\Arma p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $w = new Arma();
        $var = $this->createFormBuilder($w)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('dado')
            ->add('dano')
            ->add('bonus')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                $armaPlantilla = $em->getRepository('app\IndexBundle\Entity\DD35\Arma')->find($id->id);
                $em->remove($armaPlantilla);
                $em->flush();
                $hola = "El arma se borró correctamente";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterDD35.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

}
