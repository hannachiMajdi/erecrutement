<?php

namespace AuthentificationBundle\Controller;

use AuthentificationBundle\Entity\Personnel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Personnel controller.
 *
 * @Route("personnel")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class PersonnelController extends Controller
{
    /**
     * Lists all personnel entities.
     *
     * @Route("/", name="personnel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $personnels = $em->getRepository('AuthentificationBundle:Personnel')->findAll();

        return $this->render('personnel/index.html.twig', array(
            'personnels' => $personnels,
        ));
    }

    /**
     * Creates a new personnel entity.
     *
     * @Route("/new", name="personnel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $personnel = new Personnel();
        $form = $this->createForm('AuthentificationBundle\Form\PersonnelType', $personnel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->container->get('app.doctrine.hash_password_listener')->encodePassword($personnel);
            $em->persist($personnel);
            $em->flush();
            $this->addFlash('success','Personnel ajouté');
            return $this->redirectToRoute('personnel_show', array('id' => $personnel->getId()));
        }

        return $this->render('personnel/new.html.twig', array(
            'personnel' => $personnel,
            'form' => $form->createView(),
            'errors'=>$form->getErrors()
        ));
    }

    /**
     * Finds and displays a personnel entity.
     *
     * @Route("/{id}", name="personnel_show")
     * @Method("GET")
     */
    public function showAction(Personnel $personnel)
    {


        return $this->render('personnel/show.html.twig', array(
            'personnel' => $personnel,

        ));
    }

    /**
     * Displays a form to edit an existing personnel entity.
     *
     * @Route("/{id}/edit", name="personnel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Personnel $personnel)
    {
        $editForm = $this->createForm('AuthentificationBundle\Form\PersonnelType', $personnel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($personnel->getPlainPassword())
                $this->container->get('app.doctrine.hash_password_listener')->encodePassword($personnel);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Personnel modifié');
            return $this->redirectToRoute('personnel_show', array('id' => $personnel->getId()));
        }

        return $this->render('personnel/edit.html.twig', array(
            'personnel' => $personnel,
            'form' => $editForm->createView(),
            'errors'=>$editForm->getErrors()

        ));
    }

    /**
     * Deletes a personnel entity.
     *
     * @Route("/{id}/change", name="personnel_change")
     * @Method("GET")
     */
    public function changeAction(Personnel $personnel)
    {

        if ($personnel) {
            $em = $this->getDoctrine()->getManager();
            if($personnel->getStatut()){
                $statut = 'désactivé';
                $personnel->setStatut(false);
            }
            else{
                $statut='activé';
                $personnel->setStatut(true);
            }

            $em->flush();
            $this->addFlash('success','Personnel de matricule '.$personnel->getMatricule().' est '.$statut);
        }

        return $this->redirectToRoute('personnel_index');
    }

}
