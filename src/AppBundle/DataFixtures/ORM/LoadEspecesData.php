<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Espece;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadEspecesData extends AbstractFixture implements OrderedFixtureInterface
{
    const PREFIX = 'especes-';

    private static $references = [];

    public function load(ObjectManager $manager)
    {
        $result = [];

        $result[] = $this->createFixture('Chien');
        $result[] = $this->createFixture('Chat');
        $result[] = $this->createFixture('Lapin');
        $result[] = $this->createFixture('Cochon d\'Inde');
        $result[] = $this->createFixture('Souris');
        $result[] = $this->createFixture('Furet');
        $result[] = $this->createFixture('Cheval');
        $result[] = $this->createFixture('Castor');
        $result[] = $this->createFixture('Hamster');
        $result[] = $this->createFixture('Hibou');
        $result[] = $this->createFixture('Poisson');
        $result[] = $this->createFixture('Belette');

        $this->saveAll($manager, $result);

    }

    protected function saveAll(ObjectManager $manager, array $fixtures) {
        foreach ($fixtures as $value) {
            $manager->persist($value);
        }

        $manager->flush();
    }

    protected function createFixture(string $libelle) {
        $result = new Espece();

        $result->setLibelle($libelle);

        $reference = self::PREFIX . strtolower($libelle);
        $this->addReference($reference, $result);
        self::$references[] = strtolower($libelle);
        return $result;
    }

    public function getOrder()
    {
        return 2000;
    }
    
    public static function getReferences() {
        return self::$references;
    }
}
