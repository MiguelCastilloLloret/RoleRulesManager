<?php

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
 
class SecurityController extends Controller{
     /** @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        // Recupera el servicio de autenticación
        $authenticationUtils = $this->get('security.authentication_utils');

        // Recupera, si existe, el último error al intentar hacer login
        $error = $authenticationUtils->getLastAuthenticationError();

        // Recupera el último nombre de usuario introducido
        $lastUsername = $authenticationUtils->getLastUsername();

        // Renderiza la plantilla, enviándole, si existen, el último error y nombre de usuario
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
    // UNREACHABLE CODE
    }

    /**
     * @Route("/registro", name="register")
     */
    public function registerAction(Request $request)
    {
    // Creamos el formulario y le enviamos un usuario como molde
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    
    // Hacemos que el formulario maneje la petición
    $form->handleRequest($request);
    
    // Comprobamos que se ha enviado el formulario
    if ($form->isSubmitted() && $form->isValid()) {
        
        // Codificamos la contraseña en texto plano accediendo al 'encoder' que habíamos indicado en la configuración
        $password = $this->get('security.password_encoder')
            ->encodePassword($user, $user->getPlainPassword());
        
        // Establecemos la contraseña real ya codificada al usuario
        $user->setPassword($password);
        
        // Persistimos la entidad como cualquier otra
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        
        // Redigirimos a la pantalla de login para que acceda el nuevo usuario
        return $this->redirectToRoute('login');
    }
 
    return $this->render(
        'page/register.html.twig',
        array('form' => $form->createView())
    );
}
}