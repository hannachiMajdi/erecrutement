<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     *
     * @ORM\Column(name="societe", type="string", length=255)
     */
    private $societe;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=255)
     */
    private $poste;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cv", inversedBy="experiences", cascade={"persist"})
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
     */
    private $cv;

    public function __construct($cv = null)
    {
        $this->cv = $cv;
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
     * Set cv
     *
     * @param \AppBundle\Entity\Cv $cv
     *
     * @return Experience
     */
    public function setCv(\AppBundle\Entity\Cv $cv = null)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return \AppBundle\Entity\Cv
     */
    public function getCv()
    {
        return $this->cv;
    }

    public function __toString()
    {
        return $this->poste;
    }
}
