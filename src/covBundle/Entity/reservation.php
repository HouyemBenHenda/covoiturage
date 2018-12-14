<?php

namespace covBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Time;

/**
 * reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="covBundle\Repository\reservationRepository")
 */
class reservation
{
    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="covBundle\Entity\user")
     */
    private $passager_1;


    /**
     * @var string
     *
     * @ORM\Column(name="etat",type="string",length=255)
     */
    private $etat;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return int
     */
    public function getPassager4()
    {
        return $this->passager4;
    }

    /**
     * @param int $passager4
     */
    public function setPassager4($passager4)
    {
        $this->passager4 = $passager4;
    }


    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="covBundle\Entity\user")
     */
    private $passager2;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="covBundle\Entity\user")
     */
    private $passager3;

    /**
     * @return int
     */
    public function getPassager1()
    {
        return $this->passager_1;
    }

    /**
     * @param int $passager_1
     */
    public function setPassager1($passager_1)
    {
        $this->passager_1 = $passager_1;
    }

    /**
     * @return int
     */
    public function getPassager2()
    {
        return $this->passager2;
    }

    /**
     * @param int $passager2
     */
    public function setPassager2($passager2)
    {
        $this->passager2 = $passager2;
    }

    /**
     * @return int
     */
    public function getPassager3()
    {
        return $this->passager3;
    }

    /**
     * @param int $passager3
     */
    public function setPassager3($passager3)
    {
        $this->passager3 = $passager3;
    }

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="covBundle\Entity\user")
     */
    private $passager4;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="covBundle\Entity\user")
     */
    private $conducteur;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_dep", type="string", length=255)
     */
    private $villeDep;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_arriv", type="string", length=255)
     */
    private $villeArriv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;


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
     * @var string
     * @ORM\Column(name="nom_voiture",type="string",length=255)
     */
    private $nom_voiture;

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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * Set conducteur
     *
     * @param \stdClass $conducteur
     *
     * @return reservation
     */
    public function setConducteur($conducteur)
    {
        $this->conducteur = $conducteur;

        return $this;
    }




    /**
     * Get conducteur
     *
     * @return \stdClass
     */
    public function getConducteur()
    {
        return $this->conducteur;
    }

    /**
     * Set villeDep
     *
     * @param string $villeDep
     *
     * @return reservation
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
     * Set villeArriv
     *
     * @param string $villeArriv
     *
     * @return reservation
     */
    public function setVilleArriv($villeArriv)
    {
        $this->villeArriv = $villeArriv;

        return $this;
    }

    /**
     * @var time
     *
     * @ORM\Column(name="heure",type="time")
     */
    private $heure;

    /**
     * @return string
     */
    public function getImageVaoiture()
    {
        return $this->image_vaoiture;
    }

    /**
     * @param string $image_vaoiture
     */
    public function setImageVaoiture($image_vaoiture)
    {
        $this->image_vaoiture = $image_vaoiture;
    }

    /**
     * @return int
     */
    public function getNbreplace()
    {
        return $this->nbreplace;
    }

    /**
     * @param int $nbreplace
     */
    public function setNbreplace($nbreplace)
    {
        $this->nbreplace = $nbreplace;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */

    /**
     * @var int-
     * @ORM\Column(name="nbreplace", type="integer")
     */
    private $nbreplace;

    /**
     * @var float
     * @ORM\Column(name="prix",type="float")
     */
    private $prix;


    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @var string
     * @ORM\Column(name="image_vaoiture",type="string",length=255)
     */
    private $image_vaoiture;

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return Time
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param Time $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * Get villeArriv
     *
     * @return string
     */
    public function getVilleArriv()
    {
        return $this->villeArriv;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return reservation
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
}

