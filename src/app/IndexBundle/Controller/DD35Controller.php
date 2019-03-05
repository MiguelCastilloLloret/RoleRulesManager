<?php

namespace app\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use app\IndexBundle\Entity\DD35\Personaje;
use app\IndexBundle\Entity\DD35\Plantilla;
use app\IndexBundle\Controller\idPlantilla;	

$userId = NULL;

class DD35Controller extends Controller{

    public function DD35Action(Request $request){

        $html = $this->container->get('templating')->render(
            'index/rolManage.html.twig', array('hola' => '', 'juego' => 'DD35Master')
        );
        $security_context = $this->get('security.context');
        $security_token = $security_context->getToken();
        $userId = $security_token->getUser()->getId();
        ob_start();                    // start buffer capture
        var_dump( $userId );        // dump the values
        $contents = ob_get_contents(); // put the buffer into a variable
        ob_end_clean();                // end capture
        error_log( $contents );

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

        var_dump($plList);

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
                    var_dump($personajePlantilla);
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

}
