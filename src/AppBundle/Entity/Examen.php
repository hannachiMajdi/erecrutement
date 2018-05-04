<?php

namespace AppBundle\Entity;

use AuthentificationBundle\Entity\Candidat;
use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExamenRepository")
 */
class Examen
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
     * @var float
     *
     * @ORM\Column(name="coefficient", type="float", nullable=true)
     */
    private $coefficient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;
    /**
     * @var boolean
     *
     * @ORM\Column(name="verification", type="boolean", nullable=true)
     */
    private $verification;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Concour", inversedBy="examens")
     * @ORM\JoinColumn(name="concour", referencedColumnName="reference")
     */
    private $concour;

    /**
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\Candidat", inversedBy="examens")
     * @ORM\JoinColumn(name="id_candidat", referencedColumnName="id")
     *
     */
    private $candidat;

    public function __construct($type = null ,$coefficient = null,Candidat $candidat = null,Concour $concour = null) {
        $this->candidat = $candidat;
        $this->concour = $concour;
        $this->type = $type;
        $this->coefficient = $coefficient ;
    }

    /**
     * @return float
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * @param float $coefficient
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * Set concour
     *
     * @param \AppBundle\Entity\Concour $concour
     *
     * @return Examen
     */
    public function setConcour(\AppBundle\Entity\Concour $concour = null)
    {
        $this->concour = $concour;

        return $this;
    }
    /**
     * Set concour
     *
     * @param \AuthentificationBundle\Entity\Candidat $candidat
     *
     * @return Examen
     */
    public function setCandidat(Candidat $candidat = null)
    {
        $this->candidat = $candidat;

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
     * Get candidats
     *
     * @return Candidat
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * @return bool
     */
    public function isVerification()
    {
        return $this->verification;
    }

    /**
     * @param bool $verification
     * @return  Examen
     */
    public function setVerification($verification)
    {
        $this->verification = $verification;
        return $this;
    }


    /**
     * Get verification
     *
     * @return boolean
     */
    public function getVerification()
    {
        return $this->verification;
    }
}
