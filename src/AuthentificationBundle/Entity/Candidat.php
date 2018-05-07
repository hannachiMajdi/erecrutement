<?php

namespace AuthentificationBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Candidat
 *
 * @ORM\Table(name="candidat")
 * @ORM\Entity(repositoryClass="AuthentificationBundle\Repository\CandidatRepository")
 * @UniqueEntity(
 *     fields={"cin", "email"},
 *     errorPath="cin",
 *     message="ce cin/email est déja utilisé"
 * )
 */
class Candidat implements UserInterface
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
     * @ORM\Column(name="cin", type="string", length=8, unique=true)
     * @Assert\NotBlank(message="Le champs du CIN est vide!")
     * @Assert\Regex(pattern="/^[0-9]*$/"
     *     ,message="Cette valeur doit etre numerique")
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Minimum 8 chiffres pour la CIN",
     *      maxMessage = "maximum 8 chiffres pout la CIN",
     *     exactMessage="Exactement 8 chiffres pour la CIN"
     * )
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="mots_de_passe", type="string", length=255)
     *
     */
    private $motsDePasse;

    /**
     *
     * @ORM\Column(type="json_array")
     * @Assert\NotBlank(message="La Role ne doit pas étre vide")
     */
    private $roles = ['ROLE_CANDIDAT'];

    /**
     * @var string
     * @Assert\NotBlank(message="Mots de passe est vide")
     */
    private $plainPassword;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     minMessage="2 lettre minimum"
     *     )
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank(message="Champs invalide")
     * @Assert\Length(
     *     min=2,
     *     minMessage="2 lettres minimum"
     *     )
    */
    private $prenom;

    /**
     * @var \datetime
     * @ORM\Column(name="date_naissance", type="datetime")
     *
     * @Assert\NotBlank(message="Champs invalide")
     */
    private $date_naissance;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255 , unique=true)
     * @Assert\NotBlank(message="l'email ne doit pas étre vide")
     * @Assert\Email(message="Exemple: Mario@exemple.com")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="num_telephone", type="string", length=8)
     * @Assert\NotBlank(message="le numéro ne doit pas étre vide")
     * @Assert\Regex(pattern="/^[0-9]*$/"
     *     ,message="Cette valeur doit etre numerique")
     * @Assert\Length(
     *     min="8",
     *     max="8",
     *     minMessage="Minimum 8 chiffres",
     *     maxMessage="Maximum 8 chiffres")
     */
    private $num_telephone;

    /**
     * @var string
     * @ORM\Column(name="adresse", type="string", length=255)
     * @Assert\NotBlank(message="Invalide")
     * @Assert\Length(
     *     min="5",
     *     minMessage="Minimum 5 charactéres",
     *     )
     */
    private $adresse;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=255)
     * @Assert\NotBlank(message="Invalide")
     * @Assert\Length(
     *     min="3",
     *     minMessage="Minimum 3 charactéres",
     *     )
     */
    private $ville;

    /**
     * @var string
     * @ORM\Column(name="gouvernorat", type="string", length=255)
     * @Assert\NotBlank(message="Invalide")
     * @Assert\Length(
     *     min="3",
     *     minMessage="Minimum 3 charactéres",
     *     )
     */
    private $gouvernorat;

    /**
     * @ORM\Column(name="document_necessaire",type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $document_necessaire;


    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Examen", mappedBy="candidat")
     */
    private $examens;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Inscription", mappedBy="candidat")
     *
     */
    private $inscriptions;
    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Experience", mappedBy="candidat", cascade={"persist"})
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CandidatSpecialite", mappedBy="candidat", fetch="EXTRA_LAZY", cascade={"persist"})
     */
    private $candidatSpecialites;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Formation", mappedBy="candidats")
     *
     */
    private $formations;



    public function __construct() {
        $this->examens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inscriptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->candidatSpecialites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->experiences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDocumentNecessaire()
    {
        return $this->document_necessaire;
    }

    /**
     * @param mixed $document_necessaire
     */
    public function setDocumentNecessaire($document_necessaire)
    {
        $this->document_necessaire = $document_necessaire;
    }


    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->motsDePasse = null;
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
     * Set cin
     *
     * @param string $cin
     *
     * @return Candidat
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set motsDePasse
     *
     * @param string $motsDePasse
     *
     * @return Candidat
     */
    public function setMotsDePasse($motsDePasse)
    {
        $this->motsDePasse = $motsDePasse;

        return $this;
    }

    /**
     * Get motsDePasse
     *
     * @return string
     */
    public function getMotsDePasse()
    {
        return $this->motsDePasse;
    }
    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // give everyone ROLE_USER!
        if (!in_array('ROLE_CANDIDAT', $roles)) {
            $roles[] = 'ROLE_CANDIDAT';
        }
        return $roles;
    }
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
       return $this->motsDePasse;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->cin;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Candidat
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Candidat
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Candidat
     */
    public function setDateNaissance($dateNaissance)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $dateNaissance);
        $this->date_naissance = $date;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Candidat
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set numTelephone
     *
     * @param string $numTelephone
     *
     * @return Candidat
     */
    public function setNumTelephone($numTelephone)
    {
        $this->num_telephone = $numTelephone;

        return $this;
    }

    /**
     * Get numTelephone
     *
     * @return string
     */
    public function getNumTelephone()
    {
        return $this->num_telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Candidat
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Candidat
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set gouvernorat
     *
     * @param string $gouvernorat
     *
     * @return Candidat
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return string
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Add examen
     *
     * @param \AppBundle\Entity\Examen $examen
     *
     * @return Candidat
     */
    public function addExamen(\AppBundle\Entity\Examen $examen)
    {
        $this->examens[] = $examen;

        return $this;
    }

    /**
     * Remove examen
     *
     * @param \AppBundle\Entity\Examen $examen
     */
    public function removeExamen(\AppBundle\Entity\Examen $examen)
    {
        $this->examens->removeElement($examen);
    }

    /**
     * Get examens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamens()
    {
        return $this->examens;
    }

    /**
     * Add inscription
     *
     * @param \AppBundle\Entity\Inscription $inscription
     *
     * @return Candidat
     */
    public function addInscription(\AppBundle\Entity\Inscription $inscription)
    {
        $this->inscriptions[] = $inscription;

        return $this;
    }

    /**
     * Remove inscription
     *
     * @param \AppBundle\Entity\Inscription $inscription
     */
    public function removeInscription(\AppBundle\Entity\Inscription $inscription)
    {
        $this->inscriptions->removeElement($inscription);
    }

    /**
     * Get inscriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscriptions()
    {
        return $this->inscriptions;
    }


    public function getConcours(){
        $concours= new ArrayCollection();
        foreach ($this->inscriptions as $inscription){
            $concours->add($inscription->getConcour());
        }
        return $concours;
    }


    public function __toString()
    {
        return $this->nom.' '.$this->prenom;
    }

    /**
     * Add candidatSpecialite
     *
     * @param \AppBundle\Entity\CandidatSpecialite $candidatSpecialite
     *
     * @return Candidat
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

    /**
     * Add experience
     *
     * @param \AppBundle\Entity\Experience $experience
     *
     * @return Candidat
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

    /**
     * Add formation
     *
     * @param \AppBundle\Entity\Formation $formation
     *
     * @return Candidat
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
