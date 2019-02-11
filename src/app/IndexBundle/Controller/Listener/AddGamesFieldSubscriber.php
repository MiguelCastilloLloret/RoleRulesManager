<?php

namespace app\IndexBundle\Controller\Listener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManager;

class AddGamesFieldSubscriber implements EventSubscriberInterface{

    public $em;
    public $ev;

    public function __construct($EM, $EV){
        $this->em = $EM;
        $this->ev = $EV;
    }

    public static function getSubscribedEvents(){
        return array(
            FormEvents::PRE_SUBMIT => 'preSubmit',
        );
    }

    /**
     * Cuando el usuario llene los datos del formulario y haga el envío del mismo,
     * este método será ejecutado.
     */
    public function preSubmit(FormEvent $event){
        $data = $event->getData();
        //data es un array que en este caso contiene el juego seleccionado por el usuario.

        $this->addField($event->getForm(), $data['game'], $data['party']);
    }

    protected function addField(Form $form, $game, $party){

        //En este método se añaden los campos del formulario correspondientes al juego elegido.
        $pjList = NULL;

        $user = $this->container->get('security.context')->getToken()->getId();

        if($game=="DD35"){
            $List = $this->em->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\DD35\Personaje p WHERE p.partida = \''.$party.'\' AND p.usuario = \''.$user.'\' ORDER BY p.ID ASC')->getResult();

            for($i=0;$i<count($List);$i++){
                $aux = $List[$i]['ID'];
                $pjList["$aux"] = $List[$i]['nombre'];
            }

            $List = $this->em->createQuery('SELECT p.nombre FROM app\IndexBundle\Entity\DD35\Hechizo p ORDER BY p.ID ASC')->getResult();

            for($i=0;$i<count($List);$i++){
                $aux = $List[$i]['nombre'];
                $spellList[$aux] =  $aux;
            }

            $List = $this->em->createQuery('SELECT p.nombre FROM app\IndexBundle\Entity\DD35\Habilidad p ORDER BY p.ID ASC')->getResult();

            for($i=0;$i<count($List);$i++){
                $aux = $List[$i]['nombre'];
                $habList[$aux] =  $aux;
            }

            $acciones = array("Ataque" => 'Ataque', "HechizoObjetivo" => 'HechizoObjetivo', "AutoHechizo" => 'AutoHechizo', "TiradaDificultad" => 'TiradaDificultad', "TiradaEnfrentada" => 'TiradaEnfrentada');
        }

        if($game=="Vampiro"){
            $List = $this->ev->createQuery('SELECT p.ID, p.nombre FROM app\IndexBundle\Entity\Vampiro\vPersonaje p WHERE p.partida = \''.$party.'\' ORDER BY p.ID ASC')->getResult();

            for($i=0;$i<count($List);$i++){
                $aux = $List[$i]['ID'];
                $pjList["$aux"] = $List[$i]['nombre'];
            }

            $List = $this->ev->createQuery('SELECT p.nombre FROM app\IndexBundle\Entity\Vampiro\vHabilidad p ORDER BY p.ID ASC')->getResult();

            for($i=0;$i<count($List);$i++){
                $aux = $List[$i]['nombre'];
                $habList[$aux] =  $aux;
            }

            $acciones = array("Ataque" => 'Ataque', "AtaqueMultiple" => 'AtaqueMultiple', "TiradaDificultad" => 'TiradaDificultad', "TiradaEnfrentada" => 'TiradaEnfrentada');
        }

        $form->add('game','choice', array('choices' => array("DD35" => 'D&D35', "Vampiro" => 'Vampiro'), 'required' => true, 'attr' => array('readonly' => true)))
             ->add('party','text', array('required' => true, 'data' => $party, 'attr' => array('readonly' => true)))
             ->add('pj1','choice', array('choices' => $pjList))
             ->add('pj2','choice', array('choices' => $pjList, 'required' => false))
             ->add('action','choice', array('choices' => $acciones, 'required' => true));

        if(isset($spellList)) $form->add('spell','choice', array('choices' => $spellList, 'required' => false, 'empty_data' => null));

        $form->add('CD','integer', array('required' => false, 'data' => 0))
             ->add('skill','choice', array('choices' => $habList,'required' => false, 'empty_data' => null));
    }
}