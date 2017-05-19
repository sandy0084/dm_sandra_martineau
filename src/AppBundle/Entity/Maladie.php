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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Maladie
 *
 * @ORM\Table(name="maladie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MaladieRepository")
 */
class Maladie
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @Assert\Type(type="AppBundle\Entity\Traitement")
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Traitement", mappedBy="maladie", cascade={"persist"})
     */
    private $traitement;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Espece", inversedBy="maladies")
     * @ORM\JoinTable(name="maladies_especes")
     * joinColumns={@ORM\JoinColumn(name="maladies_id", referencedColumnName="id")}
     * inverseJoinColumns={ORM\JoinColumn(name="especes_id", referencedColumnName="id")}
     */
    private $especes;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rdv", mappedBy="maladie")
     */
    private $rdvs;

    public function __construct() {
        $this->especes = new ArrayCollection();
        $this->rdvs = new ArrayCollection();
    }

    function __toString()
    {
        return $this->getNom();
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
    public function getTraitement()
    {
        return $this->traitement;
    }

    /**
     * @param mixed $traitement
     */
    public function setTraitement($traitement)
    {
        $this->traitement = $traitement;
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
     * Add espece
     *
     * @param \AppBundle\Entity\Espece $espece
     *
     * @return Maladie
     */
    public function addEspece(\AppBundle\Entity\Espece $espece)
    {
        $this->especes[] = $espece;

        return $this;
    }

    /**
     * Remove espece
     *
     * @param \AppBundle\Entity\Espece $espece
     */
    public function removeEspece(\AppBundle\Entity\Espece $espece)
    {
        $this->especes->removeElement($espece);
    }

    /**
     * Add rdv
     *
     * @param \AppBundle\Entity\Rdv $rdv
     *
     * @return Maladie
     */
    public function addRdv(\AppBundle\Entity\Rdv $rdv)
    {
        $this->rdvs[] = $rdv;

        return $this;
    }

    /**
     * Remove rdv
     *
     * @param \AppBundle\Entity\Rdv $rdv
     */
    public function removeRdv(\AppBundle\Entity\Rdv $rdv)
    {
        $this->rdvs->removeElement($rdv);
    }
}
