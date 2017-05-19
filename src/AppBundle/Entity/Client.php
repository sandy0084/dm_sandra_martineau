<?php

/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 15/05/2017
 * Time: 17:33
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Class Client
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Espece", inversedBy="clients")
     * @ORM\JoinColumn(name="espece_id", referencedColumnName="id")
     */
    private $espece;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rdv", mappedBy="client")
     */
    private $rdvs;



    public function __construct() {
        $this->rdvs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNom().' '.$this->getEspece();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Client
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Client
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set espece
     *
     * @param \AppBundle\Entity\Espece $espece
     *
     * @return Client
     */
    public function setEspece(\AppBundle\Entity\Espece $espece = null)
    {
        $this->espece = $espece;

        return $this;
    }

    /**
     * Get espece
     *
     * @return \AppBundle\Entity\Espece
     */
    public function getEspece()
    {
        return $this->espece;
    }

    /**
     * Add rdv
     *
     * @param \AppBundle\Entity\Rdv $rdv
     *
     * @return Client
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

    /**
     * Get rdvs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }
}
