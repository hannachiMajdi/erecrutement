<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InscriptionRepository")
 */
class Inscription
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
     * @ORM\Column(name="mot_cle", type="string", length=255, unique=true)
     */
    private $mot_cle;
    /**
     * @var string
     *
     * @ORM\Column(name="situation", type="string", length=255)
     */
    private $situation;
    /**
     * @var float
     *
     * @ORM\Column(name="moyenne", type="float",options={"default" : 0})
     */
    private $moyenne = 0;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Concour", inversedBy="inscriptions")
     * @ORM\JoinColumn(name="id_concour", referencedColumnName="reference", nullable=FALSE)
     */
    protected $concour;

    /**
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\Candidat", inversedBy="inscriptions")
     * @ORM\JoinColumn(name="id_candidat", referencedColumnName="id", nullable=FALSE)
     */
    protected $candidat;

    public function __construct($candidat = null ,$concour = null , $mot_cle = null , $situation = null)
    {
        if($candidat)
            $this->candidat = $candidat;
        if($mot_cle)
            $this->mot_cle = $mot_cle;
        if($concour)
            $this->concour = $concour;
        if($situation)
            $this->situation = $situation;

        return $this;
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
     * Set motCle
     *
     * @param string $motCle
     *
     * @return Inscription
     */
    public function setMotCle($motCle)
    {
        $this->mot_cle = $motCle;

        return $this;
    }

    /**
     * Get motCle
     *
     * @return string
     */
    public function getMotCle()
    {
        return $this->mot_cle;
    }

    /**
     * Set situation
     *
     * @param string $situation
     *
     * @return Inscription
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * Get situation
     *
     * @return string
     */
    public function getSituation()
    {
        return $this->situation;
    }

    /**
     * Set concour
     *
     * @param \AppBundle\Entity\Concour $concour
     *
     * @return Inscription
     */
    public function setConcour(\AppBundle\Entity\Concour $concour)
    {
        $this->concour = $concour;

        return $this;
    }

    /**
     * Get concour
     *
     * @return \AppBundle\Entity\Concour
     */
    public function getConcour()
    {
        return $this->concour;
    }

    /**
     * Set candidat
     *
     * @param \AuthentificationBundle\Entity\Candidat $candidat
     *
     * @return Inscription
     */
    public function setCandidat(\AuthentificationBundle\Entity\Candidat $candidat)
    {
        $this->candidat = $candidat;

        return $this;
    }

    /**
     * Get candidat
     *
     * @return \AuthentificationBundle\Entity\Candidat
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * @return mixed
     */
    public function getMoyenne()
    {
        return $this->moyenne;
    }

    /**
     * @param mixed $moyenne
     */
    public function setMoyenne($moyenne)
    {
        $this->moyenne = $moyenne;
    }

}
