<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Concour;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
class ExamenController extends Controller
{
    /**
     * @Route("/concours/{id}/candidats", name="index_candidat")
     * @Security("is_granted('ROLE_RESPONSABLE') or is_granted('ROLE_AGENT')")
     */
    public function ListeCandidatAction(Request $request,Concour $concour)
    {
        $canExs = array();
        $form = $this->createForm('AppBundle\Form\ExamensType');
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        $historiques = $em->getRepository('AppBundle:Inscription')
                        ->findBy(['situation'=>'e','concour'=>$concour->getReference()]);
        foreach ($historiques as $historique){
            array_push($canExs,[
                'candidat'=>$historique->getCandidat(),
                'orale'=>$em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'o','candidat'=>$historique->getCandidat()]),
                'ecrit'=>$em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'e','candidat'=>$historique->getCandidat()]),
                'pratique'=>$em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'p','candidat'=>$historique->getCandidat()]),
            ]);
        }
        if($form->isSubmitted()){
            foreach ($canExs as $canEx){
                $orale = $em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'o','candidat'=>$canEx['candidat']->getId()]);
                $orale->setNote(intval($request->get('o_'.$canEx['candidat']->getId())));

                $pratique = $em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'p','candidat'=>$canEx['candidat']->getId()]);
                $pratique->setNote(intval($request->get('p_'.$canEx['candidat']->getId())));

                $ecrit = $em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'e','candidat'=>$canEx['candidat']->getId()]);
                $ecrit->setNote(intval($request->get('e_'.$canEx['candidat']->getId())));
                $em->flush();
            }
            $this->addFlash('success','Les notes sont modifié !');
            foreach ($canExs as $canEx){
                $orale = $em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'o','candidat'=>$canEx['candidat']->getId()]);
                if($request->get('o_check_'.$canEx['candidat']->getId()))
                $orale->setVerification(true);

                $pratique = $em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'p','candidat'=>$canEx['candidat']->getId()]);
                if($request->get('p_check_'.$canEx['candidat']->getId()))
                    $pratique->setVerification(true);

                $ecrit = $em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'e','candidat'=>$canEx['candidat']->getId()]);
                if($request->get('e_check_'.$canEx['candidat']->getId()))
                    $ecrit->setVerification(true);
                $em->flush();
            }
            $this->addFlash('success','Verification établite!');

        }
        return $this->render('concour/candidat/index.html.twig',
        array(
            'canExs'=>$canExs,
            'form'=>$form->createView()
        )
        );
    }




}
