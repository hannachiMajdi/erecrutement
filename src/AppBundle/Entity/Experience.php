<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExperienceRepository")
 */
class Experience
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
     * @Assert\NotBlank(message="Sociéte invalide")
     * @ORM\Column(name="societe", type="string", length=255)
     */
    private $societe;

    /**
     * @var string
     * @Assert\NotBlank(message="Poste invalide")
     * @ORM\Column(name="poste", type="string", length=255)
     */
    private $poste;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Date début invalide")
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Date fin invalide")
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;

    /**
     * @var string
     * @Assert\NotBlank(message="Date fin invalide")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\Candidat", inversedBy="experiences", cascade={"persist"})
     * @ORM\JoinColumn(name="candidat_id", referencedColumnName="id")
     */
    private $candidat;

    public function __construct($Candidat = null)
    {
        $this->Candidat = $Candidat;
    }


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
     * Set societe
     *
     * @param string $societe
     *
     * @return Experience
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return Experience
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }


    public function setDatedebut($datedebut)
    {
      // var_dump(strtotime($datedebut));die();

        $this->datedebut = \DateTime::createFromFormat('m-d-Y', $datedebut);


        return $this;
    }

    /**
     * Get datedebut
     *
     * @return  \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    public function setDatefin($datefin)
    {

        $this->datefin =  \DateTime::createFromFormat('m-d-Y', $datefin);

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Experience
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Candidat
     *
     * @param \AuthentificationBundle\Entity\Candidat $Candidat
     *
     * @return Experience
     */
    public function setCandidat(\AuthentificationBundle\Entity\Candidat $Candidat = null)
    {
        $this->Candidat = $Candidat;

        return $this;
    }

    /**
     * Get Candidat
     *
     * @return \AuthentificationBundle\Entity\Candidat
     */
    public function getCandidat()
    {
        return $this->Candidat;
    }

    public function __toString()
    {
        return $this->poste;
    }
}
