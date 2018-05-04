<?php

namespace AuthentificationBundle\Controller;
use AuthentificationBundle\Entity\Candidat;
use AuthentificationBundle\Form\CandidatType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class InscriptionController extends Controller
{
    /**
     * @Route("/inscription", name="inscription_candidat")
     */
    public function InscriptionAction(Request $request)
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

           $this->container->get('app.doctrine.hash_password_listener')->encodePassword($candidat);
            $em = $this->getDoctrine()->getManager();
            $candidat->setRoles(['ROLE_CANDIDAT']);
            $em->persist($candidat);

            $em->flush();
            $this->addFlash('success','Compte crée Vous pouvez vous connecter');
            return $this->redirectToRoute('login_candidat');
        }



        return $this->render(
            'inscription.html.twig',
            array('form' => $form->createView())
        );
    }
}
