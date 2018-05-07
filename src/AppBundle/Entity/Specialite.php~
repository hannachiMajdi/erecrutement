<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialite
 *
 * @ORM\Table(name="specialite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpecialiteRepository")
 */
class Specialite
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
     * @ORM\Column(name="observation", type="string", length=255)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Poste", mappedBy="specialites")
     */
    private $postes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CandidatSpecialite", mappedBy="specialite", fetch="EXTRA_LAZY")
     */
    private $candidatSpecialites;


    public function __construct() {
        $this->postes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->candidatSpecialites = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add poste
     *
     * @param \AppBundle\Entity\Poste $poste
     *
     * @return Specialite
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

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Specialite
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Specialite
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

    public function __toString()
    {
        return $this->libelle;
    }


    /**
     * Add candidatSpecialite
     *
     * @param \AppBundle\Entity\CandidatSpecialite $candidatSpecialite
     *
     * @return Specialite
     */
    public function addCandidatSpecialite(\AppBundle\Entity\CandidatSpecialite $candidatSpecialite)
    {
        $this->candidatSpecialites[] = $candidatSpecialite;

        return $this;
    }

    /**
     * Remove candidatSpecialite
     *
     * @param \AppBundle\Entity\CandidatSpecialite $candidatSpecialite
     */
    public function removeCandidatSpecialite(\AppBundle\Entity\CandidatSpecialite $candidatSpecialite)
    {
        $this->candidatSpecialites->removeElement($candidatSpecialite);
    }

    /**
     * Get candidatSpecialites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidatSpecialites()
    {
        return $this->candidatSpecialites;
    }
}
