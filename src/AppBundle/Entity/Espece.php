<?php

/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 15/05/2017
 * Time: 17:34
 */


namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Espece
 *
 * @ORM\Table(name="espece")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EspeceRepository")
 * 
 */
class Espece
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Client", mappedBy="espece")
     */
    private $clients;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Maladie", mappedBy="especes")
     */
    private $maladies;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Veto", mappedBy="especes")
     */
    private $vetos;

    public function __construct() {
        $this->clients = new ArrayCollection();
        $this->maladies = new ArrayCollection();
        $this->vetos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getLibelle().' '.$this->getClients();
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
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @param mixed $clients
     */
    public function setClients($clients)
    {
        $this->clients = $clients;
    }

    /**
     * @return mixed
     */
    public function getMaladies()
    {
        return $this->maladies;
    }

    /**
     * @param mixed $maladies
     */
    public function setMaladies($maladies)
    {
        $this->maladies = $maladies;
    }

    /**
     * @return mixed
     */
    public function getVetos()
    {
        return $this->vetos;
    }

    /**
     * @param mixed $vetos
     */
    public function setVetos($vetos)
    {
        $this->vetos = $vetos;
    }




    /**
     * Add client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Espece
     */
    public function addClient(\AppBundle\Entity\Client $client)
    {
        $this->clients[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \AppBundle\Entity\Client $client
     */
    public function removeClient(\AppBundle\Entity\Client $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Add malady
     *
     * @param \AppBundle\Entity\Maladie $malady
     *
     * @return Espece
     */
    public function addMalady(\AppBundle\Entity\Maladie $malady)
    {
        $this->maladies[] = $malady;

        return $this;
    }

    /**
     * Remove malady
     *
     * @param \AppBundle\Entity\Maladie $malady
     */
    public function removeMalady(\AppBundle\Entity\Maladie $malady)
    {
        $this->maladies->removeElement($malady);
    }

    /**
     * Add veto
     *
     * @param \AppBundle\Entity\Veto $veto
     *
     * @return Espece
     */
    public function addVeto(\AppBundle\Entity\Veto $veto)
    {
        $this->vetos[] = $veto;

        return $this;
    }

    /**
     * Remove veto
     *
     * @param \AppBundle\Entity\Veto $veto
     */
    public function removeVeto(\AppBundle\Entity\Veto $veto)
    {
        $this->vetos->removeElement($veto);
    }
}
