<?php

namespace covBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Time;

/**
 * offre
 *
 * @ORM\Table(name="offre")
 * @ORM\Entity(repositoryClass="covBundle\Repository\offreRepository")
 */
class offre
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_dep", type="string", length=255)
     */
    private $villeDep;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_arr", type="string", length=255)
     */
    private $villeArr;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_place", type="integer")
     */
    private $nbrePlace;

    /**
     * @var Time
     * @ORM\Column(name="heure", type="time")
     */
    private $heure;

    /**
     * @var string
     * @ORM\Column(name="image_voiture",type="string",length=255)
     */
    private $image_voiture;

    /**
     * @var string
     * @ORM\Column(name="nom_voiture",type="string",length=255)
     */
    private $nom_voiture;

    /**
     * @return string
     */
    public function getImageVoiture()
    {
        return $this->image_voiture;
    }

    /**
     * @param string $image_voiture
     */
    public function setImageVoiture($image_voiture)
    {
        $this->image_voiture = $image_voiture;
    }

    /**
     * @return string
     */
    public function getNomVoiture()
    {
        return $this->nom_voiture;
    }

    /**
     * @param string $nom_voiture
     */
    public function setNomVoiture($nom_voiture)
    {
        $this->nom_voiture = $nom_voiture;
    }


    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     *@ORM\ManyToOne(targetEntity="covBundle\Entity\user")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
     private $user;



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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return offre
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set villeDep
     *
     * @param string $villeDep
     *
     * @return offre
     */
    public function setVilleDep($villeDep)
    {
        $this->villeDep = $villeDep;

        return $this;
    }

    /**
     * Get villeDep
     *
     * @return string
     */
    public function getVilleDep()
    {
        return $this->villeDep;
    }

    /**
     * Set villeArr
     *
     * @param string $villeArr
     *
     * @return offre
     */
    public function setVilleArr($villeArr)
    {
        $this->villeArr = $villeArr;

        return $this;
    }

    /**
     * Get villeArr
     *
     * @return string
     */
    public function getVilleArr()
    {
        return $this->villeArr;
    }

    /**
     * Set nbrePlace
     *
     * @param integer $nbrePlace
     *
     * @return offre
     */
    public function setNbrePlace($nbrePlace)
    {
        $this->nbrePlace = $nbrePlace;

        return $this;
    }

    /**
     * Get nbrePlace
     *
     * @return int
     */
    public function getNbrePlace()
    {
        return $this->nbrePlace;
    }

    /**
     * Set heure
     *
     * @param Time $heure
     *
     * @return offre
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return Time
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return offre
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return offre
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
}

