<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CandidatSpecialite
 *
 * @ORM\Table(name="candidat_specialite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CandidatSpecialiteRepository")
 */
class CandidatSpecialite
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
     * @Assert\NotBlank(message="L'année ne doit pas étre vide")
     * @Assert\Regex(pattern="/^[0-9]*$/"
     *     ,message="Cette valeur doit etre numerique")
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      exactMessage="l'année doit avoir 4 caractéres")
     * @ORM\Column(name="annee", type="string", length=4)
     */
    private $annee;

    /**
     * @var string
     * @Assert\NotBlank(message="Faculté ne doit pas étre vide")
     * @ORM\Column(name="fac", type="string", length=255)
     */
    private $fac;


    /**
     * @ORM\ManyToOne(targetEntity="AuthentificationBundle\Entity\Candidat", inversedBy="candidatSpecialites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat;

    /**
     * @ORM\ManyToOne(targetEntity="Specialite", inversedBy="candidatSpecialites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialite;


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
     * Set annee
     *
     * @param string $annee
     *
     * @return CandidatSpecialite
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
     * Set fac
     *
     * @param string $fac
     *
     * @return CandidatSpecialite
     */
    public function setFac($fac)
    {
        $this->fac = $fac;

        return $this;
    }

    /**
     * Get fac
     *
     * @return string
     */
    public function getFac()
    {
        return $this->fac;
    }

    /**
     * Set candidat
     *
     * @param \AuthentificationBundle\Entity\Candidat $candidat
     *
     * @return CandidatSpecialite
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
     * Set specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     *
     * @return CandidatSpecialite
     */
    public function setSpecialite(\AppBundle\Entity\Specialite $specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return \AppBundle\Entity\Specialite
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }
}
