<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Concour
 *
 * @ORM\Table(name="concour")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConcourRepository")
 * @UniqueEntity(
 *     fields={"reference"},
 *     errorPath="reference",
 *     message="La référence est déja utilisé"
 * )
 */
class Concour
{
    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string")
     * @ORM\Id
     * @Assert\NotBlank(message="La référence ne doit pas étre vide")
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string")
     * @Assert\NotBlank(message="L'année ne doit pas étre vide")
     * @Assert\Regex(pattern="/^[0-9]*$/"
     *     ,message="Cette valeur doit etre numerique")
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      exactMessage="l'année doit avoir 4 caractéres")
     */
    private $annee;

    /**
     * @var string
     * @Assert\NotBlank(message="Le titre ne doit pas étre vide")
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     * @Assert\NotBlank(message="Le lieu ne doit pas étre vide")
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Le date de début ne doit pas étre vide")
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Le date de Fin ne doit pas étre vide")
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     * @Assert\NotBlank(message="Les documents necessaires de Fin ne doit pas étre vide")
     * @ORM\Column(name="documents_necessaire", type="string", length=255, nullable=true)
     */
    private $documentsNecessaire;

    /**
     * @var string
     * @Assert\NotBlank(message="L'introduction ne doit pas étre vide")
     * @ORM\Column(name="introduction", type="string", length=500)
     */
    private $introduction;

    /**
     * @var string
     * @Assert\NotBlank(message="La maniére ne doit pas étre vide")
     * @ORM\Column(name="maniere", type="string", length=255)
     */
    private $maniere;
    /**
     * @var string
     *
     * @ORM\Column(name="mots_cle", type="string", length=255,nullable=true)
     */
    private $mots_cle;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", length=255)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=1, nullable=true)
     */
    private $statut = true;


    /**
     *
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\Personnel", inversedBy="concours")
     * @ORM\JoinColumn(name="admin", referencedColumnName="id")
     */
    private $admin;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examen", mappedBy="concour")
     */
    private $examens;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Poste", mappedBy="concours")
     */
    private $postes;
    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Inscription", mappedBy="concour")
     */
    private $inscriptions;

    public function __construct() {
        $this->examens = new ArrayCollection();
        $this->postes = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {

        return $this->reference;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }
    /**
     * @param string $reference
     */
    public function setId($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return Concour
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Concour
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Concour
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set dateDebut
     *
     * @param mixed $dateDebut
     *
     * @return Concour
     */
    public function setDateDebut($dateDebut)
    {
        if($dateDebut instanceof \DateTime)
         $this->dateDebut = $dateDebut;
        else
            $this->dateDebut = \DateTime::createFromFormat('Y-m-d', $dateDebut);

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        if( $this->dateDebut)

            return $this->dateDebut->format('Y-m-d');
    }

    /**
     * Set dateFin
     *
     * @param mixed $dateFin
     *
     * @return Concour
     */
    public function setDateFin($dateFin)
    {
        //$this->dateFin = $dateFin;
        if($dateFin instanceof \DateTime)
            $this->dateFin = $dateFin;
        else
            $this->dateFin = \DateTime::createFromFormat('Y-m-d', $dateFin);

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    { if( $this->dateFin)

        return $this->dateFin->format('Y-m-d');
    }

    /**
     * Set documentsNecessaire
     *
     * @param string $documentsNecessaire
     *
     * @return Concour
     */
    public function setDocumentsNecessaire($documentsNecessaire)
    {
        $this->documentsNecessaire = $documentsNecessaire;

        return $this;
    }

    /**
     * Get documentsNecessaire
     *
     * @return string
     */
    public function getDocumentsNecessaire()
    {
        return $this->documentsNecessaire;
    }

    /**
     * Set introduction
     *
     * @param string $introduction
     *
     * @return Concour
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * Get introduction
     *
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * Set maniere
     *
     * @param string $maniere
     *
     * @return Concour
     */
    public function setManiere($maniere)
    {
        $this->maniere = $maniere;

        return $this;
    }

    /**
     * Get maniere
     *
     * @return string
     */
    public function getManiere()
    {
        return $this->maniere;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Concour
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set admin
     *
     * @param \AuthentificationBundle\Entity\Personnel $admin
     *
     * @return Concour
     */
    public function setAdmin(\AuthentificationBundle\Entity\Personnel $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \AuthentificationBundle\Entity\Personnel
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Add examen
     *
     * @param \AppBundle\Entity\Examen $examen
     *
     * @return Concour
     */
    public function addExamen(\AppBundle\Entity\Examen $examen)
    {
        $this->examens[] = $examen;

        return $this;
    }

    /**
     * Remove examen
     *
     * @param \AppBundle\Entity\Examen $examen
     */
    public function removeExamen(\AppBundle\Entity\Examen $examen)
    {
        $this->examens->removeElement($examen);
    }

    /**
     * Get examens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamens()
    {
        return $this->examens;
    }

    /**
     * Add poste
     *
     * @param \AppBundle\Entity\Poste $poste
     *
     * @return Concour
     */
    public function addPoste(\AppBundle\Entity\Poste $poste)
    {
        $this->postes[] = $poste;

        return $this;
    }

    /**
     * Remove poste
     *
     * @param \AppBundle\Entity\Poste $poste
     */
    public function removePoste(\AppBundle\Entity\Poste $poste)
    {
        $this->postes->removeElement($poste);
    }

    /**
     * Get postes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostes()
    {
        return $this->postes;
    }

    public  function setPostes(){
        foreach ($this->postes as $poste){
            $this->addPoste($poste);
            $poste->addConcour($this);
        }
        return $this;
    }


    /**
     * Add Inscription
     *
     * @param \AppBundle\Entity\Inscription $Inscription
     *
     * @return Concour
     */
    public function addInscription(\AppBundle\Entity\Inscription $Inscription)
    {
        $this->inscriptions[] = $Inscription;

        return $this;
    }

    /**
     * Remove Inscription
     *
     * @param \AppBundle\Entity\Inscription $Inscription
     */
    public function removeInscription(\AppBundle\Entity\Inscription $Inscription)
    {
        $this->inscriptions->removeElement($Inscription);
    }

    /**
     * Get Inscriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscriptions()
    {
        return $this->inscriptions;
    }

    public function getCandidats(){
        $candidats= new ArrayCollection();
        foreach ($this->inscriptions as $Inscription){
            $candidats->add($Inscription->getCandidat());
        }
        return $candidats;
    }
    /**
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return string
     */
    public function getMotsCle()
    {
        return $this->mots_cle;
    }

    /**
     * @param string $mots_cle
     */
    public function setMotsCle($mots_cle)
    {
        $this->mots_cle = $mots_cle;
    }


    public function inSpeciaite(Specialite $specialite){
        $specialites =[];
        foreach ($this->postes as $poste){
            foreach ($poste->getSpecialites() as $spec){
                array_push($specialites,$spec);
            }
        }
        if(in_array($specialite,$specialites)){
            return true;
        }
        return false;
    }

}
