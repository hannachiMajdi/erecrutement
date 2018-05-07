<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 *
 * @ORM\Table(name="poste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PosteRepository")
 */
class Poste
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
     * @ORM\Column(name="diplome", type="string", length=255)
     */
    private $diplome;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Specialite", inversedBy="postes")
     * @ORM\JoinTable(name="post_specialite")
     */
    private $specialites;
    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Formation", mappedBy="postes")
     */
    private $formations;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Concour", inversedBy="postes")
     * @ORM\JoinTable(name="concour_poste",
     *      joinColumns={@ORM\JoinColumn(name="id_poste", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_concour", referencedColumnName="reference")})
     */
    private $concours;

    public function __construct() {
        $this->specialites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->concours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param string $observation
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;
    }

    /**
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * @param string $diplome
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;
    }




    /**
     * Add specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     *
     * @return Poste
     */
    public function addSpecialite(\AppBundle\Entity\Specialite $specialite)
    {
        $this->specialites[] = $specialite;

        return $this;
    }

    /**
     * Remove specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     */
    public function removeSpecialite(\AppBundle\Entity\Specialite $specialite)
    {
        $this->specialites->removeElement($specialite);
    }

    /**
     * Get specialites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialites()
    {
        return $this->specialites;
    }

    /**
     * Add concour
     *
     * @param \AppBundle\Entity\Concour $concour
     *
     * @return Poste
     */
    public function addConcour(\AppBundle\Entity\Concour $concour)
    {
        $this->concours[] = $concour;

        return $this;
    }

    /**
     * Remove concour
     *
     * @param \AppBundle\Entity\Concour $concour
     * @return Poste
     */
    public function removeConcour(\AppBundle\Entity\Concour $concour)
    {
        $this->concours->removeElement($concour);
        return $this;
    }

    /**
     * Get concours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConcours()
    {
        return $this->concours;
    }

    public function __toString()
    {
        return  $this->observation;
    }

    /**
     * Add formation
     *
     * @param \AppBundle\Entity\Formation $formation
     *
     * @return Poste
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
