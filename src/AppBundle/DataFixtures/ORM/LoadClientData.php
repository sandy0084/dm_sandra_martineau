<?php
/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 19/05/2017
 * Time: 14:36
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Client;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadClientData extends AbstractFixture implements OrderedFixtureInterface
{
    const PREFIX = 'clients-';

    public function load(ObjectManager $manager)
    {
        $result = [];

        $result[] = $this->createFixture('Bibou', new \DateTime('2017-02-23 10:00:00'), 'Hamster');
        $result[] = $this->createFixture('Citron', new \DateTime('2017-05-02 09:02:45'), 'Hibou');
        $result[] = $this->createFixture('Dokkhô', new \DateTime('2010-04-03 15:34:56'), 'Chien');
        $result[] = $this->createFixture('Zelda', new \DateTime('2012-12-20 17:10:43'), 'Chien');
        $result[] = $this->createFixture('Mako', new \DateTime('2016-01-10 08:32:33'), 'Castor');
        $result[] = $this->createFixture('Quenotte', new \DateTime('2014-05-30 12:23:23'), 'Lapin');
        $result[] = $this->createFixture('Kikou', new \DateTime('2002-03-14 14:56:58'), 'Cochon d\'inde');
        $result[] = $this->createFixture('SupCat', new \DateTime('2011-02-23 10:00:00'), 'Chat');
        $result[] = $this->createFixture('Timon', new \DateTime('2016-01-02 09:02:45'), 'Furet');
        $result[] = $this->createFixture('Pumba', new \DateTime('2012-07-03 15:34:56'), 'Cheval');
        $result[] = $this->createFixture('Zephyr', new \DateTime('2015-11-20 17:10:43'), 'Belette');
        $result[] = $this->createFixture('Princesse', new \DateTime('2014-06-10 08:32:33'), 'Poisson');
        $result[] = $this->createFixture('Neige', new \DateTime('2006-08-30 12:23:23'), 'Lapin');
        $result[] = $this->createFixture('Patapouf', new \DateTime('2009-03-14 14:56:58'), 'Chat');

        $this->saveAll($manager, $result);
    }

    protected function saveAll(ObjectManager $manager, array $fixtures) {

        foreach ($fixtures as $value) {
            $manager->persist($value);
        }

        $manager->flush();
    }

    protected function createFixture($nom, $createdAt, $espece) {
        $result = new Client();

        $result->setNom($nom);
        $result->setCreatedAt($createdAt);
        $result->setEspece($this->getReference(LoadEspecesData::PREFIX . $espece));
        
        return $result;
    }

    public function getOrder()
    {
        return 2000;
    }
}