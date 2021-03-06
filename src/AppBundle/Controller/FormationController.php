<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Formation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formation controller.
 *
 * @Route("formation")
 */
class FormationController extends Controller
{
    /**
     * Lists all formation entities.
     *
     * @Route("/", name="formation_index")
     * @Security("is_granted('ROLE_RESPONSABLE') or is_granted('ROLE_CANDIDAT')")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->isGranted('ROLE_RESPONSABLE'))
        $formations = $em->getRepository('AppBundle:Formation')->findAll();
        elseif ($this->isGranted('ROLE_CANDIDAT')){
            $formations = $em->getRepository('AppBundle:Formation')->formationsPourCandidat($this->getUser());
        }

        return $this->render('formation/index.html.twig', array(
            'formations' => $formations,
        ));
    }

    /**
     * Creates a new formation entity.
     * @Security("is_granted('ROLE_RESPONSABLE')")
     * @Route("/new", name="formation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formation = new Formation();
        $form = $this->createForm('AppBundle\Form\FormationType', $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formation->setResponsable($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
            $this->addFlash('success','formation enregistré');
            return $this->redirectToRoute('formation_show', array('id' => $formation->getId()));
        }

        return $this->render('formation/new.html.twig', array(
            'formation' => $formation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formation entity.
     *
     * @Route("/{id}", name="formation_show")
     * @Method("GET")
     */
    public function showAction(Formation $formation)
    {

        return $this->render('formation/show.html.twig', array(
            'formation' => $formation,

        ));
    }

    /**
     * Displays a form to edit an existing formation entity.
     * @Security("is_granted('ROLE_RESPONSABLE')")
     * @Route("/{id}/edit", name="formation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Formation $formation)
    {

        $editForm = $this->createForm('AppBundle\Form\FormationType', $formation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Modification reussite');
            return $this->redirectToRoute('formation_show', array('id' => $formation->getId()));

        }

        return $this->render('formation/edit.html.twig', array(
            'formation' => $formation,
        ));
    }

    /**
     * Deletes a formation entity.
     *
     * @Route("/{id}/annuler", name="formation_change")
     * @Method("GET")
     */
    public function changeAction(Request $request, Formation $formation)
    {
            $em = $this->getDoctrine()->getManager();
            if($formation->getStatut()){
                $formation->setStatut(false);
                $statut = 'formation annulée';
            }

            else {
                $formation->setStatut(true);
                $statut ='formation activée';
            }

            $em->flush();
            $this->addFlash('success',$statut);

        return $this->redirectToRoute('formation_index');
    }
    /**
     * Deletes a formation entity.
     *
     * @Route("/{id}/inscription", name="formation_inscription")
     * @Method("GET")
     */
    public function inscriptionAction(Request $request, Formation $formation)
    {
        $em = $this->getDoctrine()->getManager();
        $formation->addCandidat($this->getUser());
        $em->flush();
        $this->addFlash('success','Demande effectué');

        return $this->redirectToRoute('formation_index');
    }


}
