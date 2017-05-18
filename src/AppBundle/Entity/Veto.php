<?php

/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 15/05/2017
 * Time: 17:34
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Veto
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="veto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VetoRepository")
 */
class Veto
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Espece", inversedBy="vetos")
     * @ORM\JoinTable(name="vetos_especes")
     */
    private $especes;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rdv", mappedBy="veto")
     */
    private $rdvs;

    public function __construct()
    {
        $this->especes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom.' '.$this->prenom;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEspeces()
    {
        return $this->especes;
    }

    /**
     * @param mixed $especes
     */
    public function setEspeces($especes)
    {
        $this->especes = $especes;
    }

    /**
     * @return mixed
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }

    /**
     * @param mixed $rdvs
     */
    public function setRdvs($rdvs)
    {
        $this->rdvs = $rdvs;
    }


}