<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Concour;
use AppBundle\Entity\Cv;
use AppBundle\Entity\Examen;
use AppBundle\Entity\Inscription;
use AuthentificationBundle\Entity\Candidat;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Concour controller.
 *
 * @Route("concours")
 */
class ConcourController extends Controller
{
    /**
     * Lists all concour entities.
     * @Security("is_granted('ROLE_USER')")
     * @Route("/", name="concour_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($this->isGranted('ROLE_PER')) {
        $concours = $em->getRepository('AppBundle:Concour')->findAll();
        }else{
            $concours = $concours = $em->getRepository('AppBundle:Concour')->findBy(['statut'=>'p']);
        }



        return $this->render('concour/index.html.twig', array(
            'concours' => $concours,
        ));
    }

    /**
     * Creates a new concour entity.
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/new", name="concour_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $concour = new Concour();
        $form = $this->createForm('AppBundle\Form\ConcourType', $concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $concour->setAdmin($this->getUser());
            $concour->setStatut('c');
            $this->reset($concour,$em);
            $concour->setPostes();
            $em->persist($concour);
            $em->flush();
            $this->addFlash('success','Concours Enregistré avec Succés');
            return $this->redirectToRoute('concour_show', array('id' => $concour->getId()));
        }

        return $this->render('concour/new.html.twig', array(
            'concour' => $concour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a concour entity.
     *
     * @Route("/{id}", name="concour_show")
     * @Method("GET")
     */
    public function showAction(Concour $concour)
    {
        //var_dump($this->getUser()->getCv()->getDocumentsnecessaire());die();


        return $this->render('concour/show.html.twig', array(
            'concour' => $concour,

        ));
    }

    /**
     * Displays a form to edit an existing concour entity.
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/{id}/edit", name="concour_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Concour $concour)
    {

        $editForm = $this->createForm('AppBundle\Form\ConcourType', $concour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $this->reset($concour,$em);
            $concour->setPostes();

            $em->flush();
            $this->addFlash('success','Modification établie avec succés');
            return $this->redirectToRoute('concour_show', array('id' => $concour->getId()));
        }

        return $this->render('concour/edit.html.twig', array(
            'concour' => $concour,
            'form' => $editForm->createView(),

        ));
    }
    /**
     * Displays a form to edit an existing concour entity.
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/{id}/statut", name="concour_change")
     * @Method({"GET", "POST"})
     */
    public function changerStatutAction(Request $request, Concour $concour)
    {
        $statut = ($concour->getStatut() == 'p')?'d':'p';
        $concour->setStatut($statut);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success','Statut du Concours '.$concour->getReference().' Changé');
        return $this->redirectToRoute('concour_index');
    }



    protected function reset($concour,$em){
        $connection = $em->getConnection();
        $statement = $connection->prepare("DELETE  FROM concour_poste WHERE id_concour = :id");
        $statement->bindValue('id', $concour->getId());
        return $statement->execute();

    }

    /**
     * Displays a form to edit an existing concour entity.
     * @Security("is_granted('ROLE_CANDIDAT')")
     * @Route("/{id}/inscription", name="concour_inscription")
     * @Method({"GET", "POST"})
     */
    public function inscriptionAction(Request $request, Concour $concour)
    {
        if(count($this->getUser()->getExperiences())!= 0){
            $em = $this->getDoctrine()->getManager();
            $inscription = new Inscription($this->getUser(),$concour,$concour->getReference().'-'.$this->getUser()->getId(),'ea');
            $em->persist($inscription);
            $em->flush();
            $this->addFlash('success','votre demande à été ajouté avec succés');
            return $this->redirectToRoute('concour_index');
        }else{

            $form = $this->createForm('AppBundle\Form\CvType');
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $inscription = new Inscription($this->getUser(),$concour,$concour->getReference().'-'.$this->getUser()->getId(),'ea');
                $em = $this->getDoctrine()->getManager();
                $user = $this->upload($this->getUser(),$form['documentsnecessaires']->getData());
                $experiences = $form['experiences']->getData();
                $specialites = $form['candidatSpecialites']->getData();
                foreach ($specialites as $spec)
                {
                    $this->getUser()->addCandidatSpecialite($spec);
                    $spec->setCandidat($this->getUser());
                    $em->persist($spec);
                   if(! $concour->inSpeciaite($spec->getSpecialite()))
                   {
                       $inscription->setSituation('r');
                       $this->addFlash('error','votre demande est refusé');
                   }
                }
                foreach ($experiences as $exp)
                {
                    $this->getUser()->addExperience($exp);
                    $exp->setCandidat($this->getUser());
                    $em->persist($exp);
                }

                $em->persist($inscription);
                $em->flush();
                $this->addFlash('success','votre demande à été ajouté avec succés');
                return $this->redirectToRoute('concour_index');
            }
            return $this->render('concour/inscription.html.twig',array(
                'form'=>$form->createView()
            ));
        }

    }
    /**
     * Displays a form to edit an existing concour entity.
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/{id}/preselection", name="concour_preselection")
     * @Method({"GET", "POST"})
     */
    public function preselectionAction(Request $request, Concour $concour)
    {
        $form = $this->createForm('AppBundle\Form\PreselectionType');
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            foreach ($concour->getInscriptions() as $inscription){
                $inscription->setSituation('r');
            }
            $em->flush();
            $percent = intval($form['pourcentage']->getData());
            $annee = intval($form['nbrAnnee']->getData());
            $mois = intval($form['nbrMois']->getData()) ;

            $candidats_ids = $this->liste($annee,$mois,$concour,$percent);

            foreach ($candidats_ids as $candidat_id){
                $inscription = $em->getRepository('AppBundle:Inscription')->find($candidat_id['id']);
                $inscription->setSituation('e');
               $examen_orale = new Examen('o',4,$inscription->getCandidat(),$inscription->getConcour());
               $examen_ecrit = new Examen('e',6,$inscription->getCandidat(),$inscription->getConcour());
               $em->persist($examen_orale);
                $em->persist($examen_ecrit);
               $postes = $inscription->getConcour()->getPostes();
               foreach ($postes as $poste){
                   if(strtoupper($poste->getObservation()) === 'CHAUFFEUR'){
                       $examen_pratique = new Examen('p',1,$inscription->getCandidat(),$inscription->getConcour());
                       $em->persist($examen_pratique);
                       break;
                   }
               }
                $em->flush();
            }
            $concour->setStatut('s');
            $em->flush();
            $this->addFlash('success','Préselection établie avec succés !');
            $this->addFlash('success',count($candidats_ids).' candidat à été selectionnés!');
            $this->redirectToRoute('concour_index');
        }
        return $this->render('concour/preselection.html.twig',
            array(
                'concour'=>$concour,
                'form'=>$form->createView()
            ));

    }
    /**
     * Displays a form to edit an existing concour entity.
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/{id}/cloture", name="concour_cloture")
     * @Method({"GET", "POST"})
     */
    public function clotureAction(Request $request, Concour $concour)
    {
        $form = $this->createForm('AppBundle\Form\ClotureType');
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $inscriptions = $em->getRepository('AppBundle:Inscription')->findBy(
            array('situation'=>'e','concour'=>$concour)
        );
        foreach ($inscriptions as $inscription){
            $examens = $em->getRepository('AppBundle:Examen')->findBy(
                array('candidat'=>$inscription->getCandidat())
            );
            $moyenne = 0;
            $somme = 0;
            $coef = 0;
            foreach ($examens as $examen){
                $somme += $examen->getNote()* $examen->getCoefficient();
                $coef += $examen->getCoefficient();
            }
            $inscription->setMoyenne($somme / $coef);
            $em->flush();
        }
        if($form->isSubmitted()){
            $percent = intval($form['pourcentage']->getData());
            $annee = intval($form['nbrAnnee']->getData());
            $mois = intval($form['nbrMois']->getData()) ;
            $moyenne = intval($form['moyenne']->getData()) ;
            $candidats_ids = $this->liste($annee,$mois,$concour,$percent, $moyenne);

            foreach ($candidats_ids as $candidat_id){
                $inscription = $em->getRepository('AppBundle:Inscription')->find($candidat_id['id']);
                $inscription->setSituation('a');
                $em->flush();
            }
            $concour->setStatut('c');
            $em->flush();

            $this->addFlash('success','Sélection établie avec succés !');
            $this->addFlash('success',count($candidats_ids).' candidat ont été selectionnés!');
           return $this->redirectToRoute('concour_index');

        }
        return $this->render('concour/cloture.html.twig',
            array(
                'concour'=>$concour,
                'form'=>$form->createView()
            ));

    }
    /**
     * Displays a form to edit an existing concour entity.
     * @Security("is_granted('ROLE_RESPONSABLE') or is_granted('ROLE_ADMIN')")
     * @Route("/{id}/candidats_reussies", name="candidat_reussies")
     * @Method({"GET", "POST"})
     */
    public function reussitAction(Request $request, Concour $concour)
    {
        $canExs = array();
        $em = $this->getDoctrine()->getManager();
         $inscriptions = $em->getRepository('AppBundle:Inscription')
             ->findBy(['situation'=>'a','concour'=>$concour->getReference()]);
        foreach ($inscriptions as $inscription){
            array_push($canExs,[
                'candidat'=>$inscription->getCandidat(),
                'orale'=>$em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'o','candidat'=>$inscription->getCandidat()]),
                'ecrit'=>$em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'e','candidat'=>$inscription->getCandidat()]),
                'pratique'=>$em->getRepository('AppBundle:Examen')
                    ->findOneBy(['type'=>'p','candidat'=>$inscription->getCandidat()]),
                'moyenne'=> $inscription->getMoyenne()
            ]);
        }
        return $this->render('concour\candidat\index2.html.twig',
        array('canExs'=>$canExs)

        );



    }

    public function liste($annee , $mois ,Concour $concour,$percent ,$moyenne = null){
        $nbtotal = count($concour->getCandidats());
        //var_dump($percent);die();
        if($nbtotal != 0)
            $limit = ($percent*$nbtotal)/100;
        else
            $limit = 0 ;

        $em = $this->getDoctrine()->getManager();
        $days = $annee * 365 + $mois * 30 ;
        $sql = $em->getConnection();
        $query = $sql->prepare('
                        SELECT i.id ,SUM(DATEDIFF(e.datefin,e.datedebut)) as days
                        FROM candidat c, inscription i,experience e
                        WHERE   e.candidat_id = c.id AND c.id = i.id_candidat AND i.id_concour = :concour
                        AND i.moyenne >= :moyenne
                        GROUP BY c.id
                        HAVING days > :da 
                        ORDER BY days DESC 
                        LIMIT :limit
            ');
        $query->bindValue('concour', $concour->getId(),\PDO::PARAM_STR);
        $query->bindValue('da', $days, \PDO::PARAM_INT);
        if($moyenne)
            $m =$moyenne;
        else
        {
            $m =0;
        }

        $query->bindValue('moyenne', $m, \PDO::PARAM_INT);

        $query->bindParam('limit', $limit, \PDO::PARAM_INT);
        $query->execute();
        $candidats = $query->fetchAll();
        //var_dump($query->rowCount());die;

        return $candidats;
       /* foreach($candidats as $candidat){
            if($candidat->getCv()->getDureeExperience() >= $days ){
                array_push($liste ,array(
                    'candidat'=>$candidat,
                    'experience'=>$candidat->getCv()->getDureeExperience()
                ) );
            }
        }*/
        //array_sort() $liste


    }

    public function upload(Candidat $candidat,$file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('documents_directory'),
                $fileName
            );
        $candidat->setDocumentNecessaire($fileName);

        return $candidat;
    }
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }




}
