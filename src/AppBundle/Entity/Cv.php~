<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cv
 *
 * @ORM\Table(name="cv")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CvRepository")
 */
class Cv
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
     *
     * @ORM\OneToOne(targetEntity="AuthentificationBundle\Entity\Candidat", mappedBy="cv")
     * @ORM\JoinColumn(name="id_candidat", referencedColumnName="id")
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\Column(name="Documentsnecessaire", type="string")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $documentsnecessaire;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Specialite", inversedBy="cvs", cascade={"persist"})
     * @ORM\JoinTable(name="education")
     */
    private $specialites;
    /**
     *
     * @ORM\OneToMany(targetEntity="Experience", mappedBy="cv", cascade={"persist"})
     */
    private $experiences;



    public function __construct() {
        $this->specialites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->experiences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addExperience(new Experience($this));


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


    public function setDocumentsnecessaire($documentsnecessaire)
    {
        if(is_array($documentsnecessaire))
        { $docs ='';
            foreach ($documentsnecessaire as $doc){
                $docs .=' , '.$doc;
            }
            $this->documentsnecessaire = $docs;
        }
        else
        $this->documentsnecessaire = $documentsnecessaire;

        return $this;
    }

    /**
     * Get documentsnecessaire
     *
     * @return string
     */
    public function getDocumentsnecessaire()
    {
        return $this->documentsnecessaire;
    }

    /**
     * @return mixed
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * @param mixed $candidat
     */
    public function setCandidat($candidat)
    {
        $this->candidat = $candidat;
    }


    /**
     * Add specialite
     *
     * @param \AppBundle\Entity\Specialite $specialite
     *
     * @return Cv
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
     * Add experience
     *
     * @param \AppBundle\Entity\Experience $experience
     *
     * @return Cv
     */
    public function addExperience(\AppBundle\Entity\Experience $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \AppBundle\Entity\Experience $experience
     */
    public function removeExperience(\AppBundle\Entity\Experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    public function getDureeExperience(){
        $diff = 0;
        foreach ($this->getExperiences() as $experience){
            $d=date_diff($experience->getDateFin(),$experience->getDateDebut());
            $diff += abs(intval($d->format('%R%a')));
        }
        return $diff;
    }

}
