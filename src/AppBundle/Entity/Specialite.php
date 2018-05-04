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
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Cv", mappedBy="specialites")
     */
    private $cvs;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Formation", mappedBy="specialites")
     */
    private $formations;


    public function __construct() {
        $this->postes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cvs = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add cv
     *
     * @param \AppBundle\Entity\Cv $cv
     *
     * @return Specialite
     */
    public function addCv(\AppBundle\Entity\Cv $cv)
    {
        $this->cvs[] = $cv;

        return $this;
    }

    /**
     * Remove cv
     *
     * @param \AppBundle\Entity\Cv $cv
     */
    public function removeCv(\AppBundle\Entity\Cv $cv)
    {
        $this->cvs->removeElement($cv);
    }

    /**
     * Get cvs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCvs()
    {
        return $this->cvs;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * Add formation
     *
     * @param \AppBundle\Entity\Formation $formation
     *
     * @return Specialite
     */
    public function addFormation(\AppBundle\Entity\Formation $formation)
    {
        $this->formations[] = $formation;

        return $this;
    }

    /**
     * Remove formation
     *
     * @param \AppBundle\Entity\Formation $formation
     */
    public function removeFormation(\AppBundle\Entity\Formation $formation)
    {
        $this->formations->removeElement($formation);
    }

    /**
     * Get formations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormations()
    {
        return $this->formations;
    }
}
