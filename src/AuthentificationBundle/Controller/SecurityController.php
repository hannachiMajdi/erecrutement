<?php

namespace AuthentificationBundle\Controller;

use AuthentificationBundle\Form\LoginCandidatForm;
use AuthentificationBundle\Form\LoginPersonnelForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login_per", name="login_personnel")
     */
    public function loginPersonnelAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginPersonnelForm::class, [
            '_matricule' => $lastUsername,
        ]);
        return $this->render(
            'security/login_personnel.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
                'form'         => $form->createView(),
            )
        );
    }

    /**
     * @Route("/login_candidat", name="login_candidat")
     */
    public function loginCandidatAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginCandidatForm::class, [
            '_cin' => $lastUsername,
        ]);
        return $this->render(
            'security/login_candidat.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
                'form' => $form->createView()
            )
        );
    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }
}
