<?php
/**
 * Created by PhpStorm.
 * User: sandy
 * Date: 19/05/2017
 * Time: 14:17
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Maladie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMaladiesData extends AbstractFixture implements OrderedFixtureInterface
{
    const PREFIX = 'maladies-';

    private static $references = [];

    public function load(ObjectManager $manager)
    {
        $result = [];

        $result[] = $this->createFixture('Cancer de la truffe', 'Ablation de la zone atteinte');
        $result[] = $this->createFixture('Cirrhose des moustaches', 'Tremper les moustaches dans un bain d\'acide sulfurique');
        $result[] = $this->createFixture('Crise cardiaque', 'Arrêter d\'avoir peur');
        $result[] = $this->createFixture('Tuberculose du poil', 'Incurable');
        $result[] = $this->createFixture('Fracture de la queue', 'Plâtre');
        $result[] = $this->createFixture('Migraine', 'Faire de longues siestes');
        $result[] = $this->createFixture('Carrie', 'Arrêter de manger des bonbons');

        $this->saveAll($manager, $result);

    }

    protected function saveAll(ObjectManager $manager, array $fixtures) {
        foreach ($fixtures as $value) {
            $manager->persist($value);
        }

        $manager->flush();
    }

    protected function createFixture(string $nom, string $traitement) {
        $result = new Maladie();

        $result->setNom($nom);
        $result->setTraitement($traitement);

        $reference = self::PREFIX . strtolower($nom);
        $this->addReference($reference, $result);
        self::$references[] = strtolower($nom);
        return $result;
    }

    public function getOrder()
    {
        return 3000;
    }

    public static function getReferences() {
        return self::$references;
    }
}