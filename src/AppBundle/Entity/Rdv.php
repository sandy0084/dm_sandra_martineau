<?php

/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 15/05/2017
 * Time: 17:34
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Rdv
 *
 * @ORM\Table(name="rdv")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RdvRepository")
 */
class Rdv
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
     * @ORM\Column(name="reference", type="string", length=255, unique=true)
     */
    private $reference;

    /**
     * @var bool
     *
     * @ORM\Column(name="isComing", type="boolean")
     */
    private $isComing = false;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="rdvs")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Maladie", inversedBy="rdvs")
     * @ORM\JoinColumn(name="maladie_id", referencedColumnName="id")
     */
    private $maladie;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Veto", inversedBy="rdvs")
     * @ORM\JoinColumn(name="veto_id", referencedColumnName="id")
     */
    private $veto;

    public function __construct()
    {
        $this->reference = bin2hex(random_bytes(14));
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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return boolean
     */
    public function isIsComing()
    {
        return $this->isComing;
    }

    /**
     * @param boolean $isComing
     */
    public function setIsComing($isComing)
    {
        $this->isComing = $isComing;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
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

    /**
     * @return mixed
     */
    public function getVeto()
    {
        return $this->veto;
    }

    /**
     * @param mixed $veto
     */
    public function setVeto($veto)
    {
        $this->veto = $veto;
    }

    

}