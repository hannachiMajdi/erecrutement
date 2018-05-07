<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="libelle  invalide")
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Date début invalide")
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Date début invalide")
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=255)
     */
    private $module;

    /**
     * @var string
     * @Assert\NotBlank(message="lieu début invalide")
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;
    /**
     * @var boolean
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut;
    /**
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\Personnel", inversedBy="formations")
     * @ORM\JoinColumn(name="id_grh", referencedColumnName="id", nullable=FALSE)
     */
    protected $responsable;

    /**
     * @ORM\ManyToMany(targetEntity="Poste", inversedBy="formations", cascade={"persist"})
     * @ORM\JoinTable(name="post_format")
     */
    private $postes;

    /**
     * @ORM\ManyToMany(targetEntity="AuthentificationBundle\Entity\Candidat", inversedBy="formations", cascade={"persist"})
     * @ORM\JoinTable(name="candidat_format")
     */
    private $candidats;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Formation
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Formation
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut =  \DateTime::createFromFormat('m-d-Y', $dateDebut);

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
        return $this->dateDebut->format('m-d-Y');
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Formation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin =  \DateTime::createFromFormat('m-d-Y', $dateFin);

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        if( $this->dateFin)

            return $this->dateFin->format('m-d-Y');
    }

    /**
     * Set module
     *
     * @param string $module
     *
     * @return Formation
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Formation
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
     * Set responsable
     *
     * @param \AuthentificationBundle\Entity\Personnel $responsable
     *
     * @return Formation
     */
    public function setResponsable(\AuthentificationBundle\Entity\Personnel $responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \AuthentificationBundle\Entity\Personnel
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->candidats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Poste
     *
     * @param \AppBundle\Entity\Poste $Poste
     *
     * @return Formation
     */
    public function addPoste(\AppBundle\Entity\Poste $Poste)
    {
        $this->postes[] = $Poste;

        return $this;
    }

    /**
     * Remove Poste
     *
     * @param \AppBundle\Entity\Poste $Poste
     */
    public function removePoste(\AppBundle\Entity\Poste $Poste)
    {
        $this->postes->removeElement($Poste);
    }

    /**
     * Get Postes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostes()
    {
        return $this->postes;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }


    /**
     * Add candidat
     *
     * @param \AuthentificationBundle\Entity\Candidat $candidat
     *
     * @return Formation
     */
    public function addCandidat(\AuthentificationBundle\Entity\Candidat $candidat)
    {
        $this->candidats[] = $candidat;

        return $this;
    }

    /**
     * Remove candidat
     *
     * @param \AuthentificationBundle\Entity\Candidat $candidat
     */
    public function removeCandidat(\AuthentificationBundle\Entity\Candidat $candidat)
    {
        $this->candidats->removeElement($candidat);
    }

    /**
     * Get candidats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidats()
    {
        return $this->candidats;
    }
}
