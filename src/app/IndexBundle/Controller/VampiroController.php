<?php

namespace app\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use app\IndexBundle\Entity\Vampiro\vPersonaje;
use app\IndexBundle\Entity\Vampiro\vPlantilla;
use app\IndexBundle\Entity\Vampiro\vArma;
use app\IndexBundle\Controller\idPlantilla;	

class VampiroController extends Controller{

    public $clan = array("Assamita" => 'Assamita', "Brujah" => 'Brujah', "Gangrel" => 'Gangrel', "Giovanni" => 'Giovanni', "Lasombra" => 'Lasombra', "Malkavian" => 'Malkavian', "Nosferatu" => 'Nosferatu', "Ravnos" => 'Ravnos', "Seguidores de Set" => 'Seguidores de Set', "Toreador" => 'Toreador', "Tremere" => 'Tremere', "Tzimisce" => 'Tzimisce', "Ventrue" => 'Ventrue');
    
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
        $inputValue = "Importar";
        $ev = $this->get('doctrine.orm.vamp_entity_manager');
        $plList = NULL;

        $List = $ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\\vPlantilla p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $List = $ev->createQuery('SELECT p.nombre FROM app\IndexBundle\Entity\Vampiro\\vArma p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $wepList[$aux] =  $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $pj = new vPersonaje();
        $var = $this->createFormBuilder($pj)
            ->add('nombre')
            ->add('clan', 'choice', array('choices' => $this->clan))
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
            ->add('arma','choice', array('choices' => $wepList))
            ->add('habilidades', 'text')
            ->add('partida')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                if($plantilla->isValid()){
                    $personajePlantilla = $ev->getRepository('app\IndexBundle\Entity\Vampiro\vPlantilla')->find($id->id);
                    $pj = $personajePlantilla;
                    $var = $this->createFormBuilder($pj)
                        ->add('nombre')
                        ->add('clan', 'choice', array('choices' => $this->clan))
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
                        ->add('arma','choice', array('choices' => $wepList))
                        ->add('habilidades', 'text')
                        ->add('partida')
                        ->getForm();
                    }
            }
            $var->bind($request);
            if($var->isValid()){
                $ev->persist($pj);
                $ev->flush();
                $hola = "Se introdujo correctamente el personaje en la BD";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function VampiroCreatePAction(Request $request){ 
        $hola = "";
        $tipo = "";
        $link = "crear";
        $inputValue = "Importar";
        $ev = $this->get('doctrine.orm.vamp_entity_manager');
        $plList = NULL;

        $List = $ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\\vPlantilla p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $List = $ev->createQuery('SELECT p.nombre FROM app\IndexBundle\Entity\Vampiro\\vArma p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $wepList[$aux] =  $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $pj = new vPlantilla();
        $var = $this->createFormBuilder($pj)
            ->add('nombre')
            ->add('clan', 'choice', array('choices' => $this->clan))
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
            ->add('arma','choice', array('choices' => $wepList))
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
                        ->add('clan', 'choice', array('choices' => $this->clan))
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
                        ->add('arma','choice', array('choices' => $wepList))
                        ->add('habilidades', 'text')
                        ->getForm();
                    }
            }
            $var->bind($request);
            if($var->isValid()){
                $ev->persist($pj);
                $ev->flush();
                $hola = "Se introdujo correctamente la plantilla en la BD";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function VampiroChangeAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "modificar";
        $inputValue = "Importar";
        $plList = NULL;
        $ev = $this->get('doctrine.orm.vamp_entity_manager');

        $List = $ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\\vPlantilla p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $List = $ev->createQuery('SELECT p.nombre FROM app\IndexBundle\Entity\Vampiro\\vArma p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $wepList[$aux] =  $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $personajePlantilla = new vPersonaje();
        $var = $this->createFormBuilder($personajePlantilla)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clan', 'choice', array('choices' => $this->clan))
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
            ->add('arma','choice', array('choices' => $wepList))
            ->add('habilidades', 'text')
            ->add('partida')
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
                        ->add('clan', 'choice', array('choices' => $this->clan))
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
                        ->add('arma','choice', array('choices' => $wepList))
                        ->add('habilidades', 'text')
                        ->add('partida')
                        ->getForm();
                    }
            }
            else{
                $var->bind($request);
                if($var->isValid()){
                    $ev->flush();
                    $hola = "Se modificó correctamente el personaje en la BD";
                }
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function VampiroDeleteAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "eliminar";
        $inputValue = "Eliminar";
        $plList = NULL;
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

        $pj = new vPersonaje();
        $var = $this->createFormBuilder($pj)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clan', 'choice', array('choices' => $this->clan))
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
            ->add('partida')
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
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function VampiroDeletePAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "eliminar";
        $inputValue = "Eliminar";
        $plList = NULL;
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
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('clan', 'choice', array('choices' => $this->clan))
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
                $personajePlantilla = $ev->getRepository('app\IndexBundle\Entity\Vampiro\vPlantilla')->find($id->id);
                $ev->remove($personajePlantilla);
                $ev->flush();
                $hola = "La plantilla se borró correctamente";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function VampiroCreateWAction(Request $request){ 
        $hola = "";
        $tipo = "";
        $link = "crearArma";
        $inputValue = "";
        $ev = $this->get('doctrine.orm.vamp_entity_manager');

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id')
            ->getForm();


        $w = new vArma();
        $security_context = $this->get('security.context');
        $var = $this->createFormBuilder($w)
            ->add('nombre')
            ->add('ocultacion')
            ->add('dano', 'integer', array('label' => 'Numero de Dados'))
            ->add('tipo')
            ->add('cadencia', 'integer')
            ->getForm();

        if ($request->isMethod('POST')) {
            $var->bind($request);
            if($var->isValid()){
                $ev->persist($w);
                $ev->flush();
                $hola = "Se introdujo correctamente el arma en la BD";
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }

    public function VampiroChangeWAction(Request $request){ 
        $hola = "";
        $tipo = "oculto";
        $link = "modificarArma";
        $inputValue = "Importar";
        $plList = NULL;
        $ev = $this->get('doctrine.orm.vamp_entity_manager');

        $List = $ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\vArma p ORDER BY p.ID ASC')->getResult();

        for($i=0;$i<count($List);$i++){
            $aux = $List[$i]['nombre'];
            $plList[$List[$i]['ID']] = $aux;
        }

        $id = new idPlantilla();
        $plantilla = $this->createFormBuilder($id)
            ->add('id', 'choice', array('choices' => $plList, 'required' => true))
            ->getForm();

        $w = new vArma();
        $var = $this->createFormBuilder($w)
            ->add('ID', 'hidden')
            ->add('nombre')
            ->add('ocultacion')
            ->add('dano', 'integer', array('label' => 'Numero de Dados'))
            ->add('tipo')
            ->add('cadencia', 'integer')
            ->getForm();

        if ($request->isMethod('POST')) {
            if(isset($request->request->all()['form']['id'])){
                $plantilla->bind($request);
                if($plantilla->isValid()){
                    $w= $ev->getRepository('app\IndexBundle\Entity\Vampiro\vArma')->find($id->id);
                    $tipo = "";
                    $var = $this->createFormBuilder($w)
                        ->add('ID', 'hidden')
                        ->add('nombre')
                        ->add('ocultacion')
                        ->add('dano', 'integer', array('label' => 'Numero de Dados'))
                        ->add('tipo')
                        ->add('cadencia', 'integer')
                        ->getForm();
                    }
            }
            else{
                $var->bind($request);
                if($var->isValid()){
                    $ev->flush();
                    $hola = "Se modificó correctamente el arma en la BD";
                }
            }
        }

        $html = $this->container->get('templating')->render(
            'index/masterVampiro.html.twig', array('plantilla' => $plantilla->createView(),'form' => $var->createView(), 'hola' => $hola, 'tipo' => $tipo, 'link' => $link, 'inputValue' => $inputValue)
        );

        return new Response($html);
    }
}
