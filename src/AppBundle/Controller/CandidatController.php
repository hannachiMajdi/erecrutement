<?php

namespace AppBundle\Controller;

use AuthentificationBundle\Entity\Candidat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class CandidatController extends Controller
{
    /**
     * @Route("/profil_candidat/{id}/show", name="profile_candidat")
     * @Method({"GET", "POST"})
     */
    public function profileCandidatAction(Request $request, Candidat $candidat)
    {
      //  if($this->isGranted('ROLE_CANDIDAT')){
            return $this->render('candidat/show.html.twig', array(
                'candidat' => $candidat,
            ));

       // }
    }


}
