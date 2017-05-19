<?php
/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 19/05/2017
 * Time: 15:53
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Rdv;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRdvData extends AbstractFixture implements OrderedFixtureInterface
{
    const PREFIX = 'species-';

    private static $references = [];

    public function load(ObjectManager $manager)
    {
        $result = [];

        $result[] = $this->createFixture('serpent', 500);
        $result[] = $this->createFixture('grosminet', 50000);
        $result[] = $this->createFixture('chien', 500);
        $result[] = $this->createFixture('cochondinde', 15);
        $result[] = $this->createFixture('souris', 5);
        $result[] = $this->createFixture('rat', 10);

        $this->saveAll($manager, $result);
    }

    protected function saveAll(ObjectManager $manager, array $fixtures) {
        foreach ($fixtures as $value) {
            $manager->persist($value);
        }

        $manager->flush();
    }

    protected function createFixture(string $name, float $price) {
        $result = new Rdv();

        $result->setName($name);
        $result->setPrice($price);

        $reference = self::PREFIX . strtolower($name);
        $this->addReference($reference, $result);
        self::$references[] = strtolower($name);
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