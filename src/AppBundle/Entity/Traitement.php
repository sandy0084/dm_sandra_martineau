<?php

/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 15/05/2017
 * Time: 17:35
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Traitement
 *
 * @ORM\Table(name="traitement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TraitementRepository")
 */
class Traitement
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Maladie", inversedBy="traitement", cascade={"persist"})
     * @ORM\JoinColumn(name="maladie_id", referencedColumnName="id")
     */
    private $maladie;

    function __toString()
    {
        return $this->getNom();
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
     * @return mixed
     */
    public function getMaladie()
    {
        return $this->maladie;
    }

    /**
     * @param mixed $maladie
     */
    public function setMaladie($maladie)
    {
        $this->maladie = $maladie;
    }


}