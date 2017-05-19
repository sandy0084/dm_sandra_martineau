<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends EntityRepository
{
/*    public function toto($param)
    {
        return $this->findBy([
            'name' => $param
        ], [
            'id' => 'DESC'
        ], 5);
    }

    //Trouver avec Find
    public function findSomeByName($name, $limit = 5)
    {
        return $this->findBy([
            'name' => $name
        ], [
            'id' => 'DESC'
        ], $limit);
    }

    //DQL
    public function findDQL(string $name)
    {
        $this->getEntityManager()
            ->createQuery('SELECT a FROM AppBundle:Animal a WHERE a.id>5000 AND a.name=:name')
            ->setParameters([
                'name' => $name
            ])
            ->getResult();
    }

    /**
     * Query Builder
     * @param string $name
     * @return array|Animal[]
     */
/*    public function findByName2(string $name)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.id > 5000');
        $qb->andWhere('a.name=:name')->setParameter('name', $name);

        //Limit 5
        $qb->setMaxResults(5);

        //Offset 0
        $qb->setFirstResult(0);

        return $qb->getQuery()->getResult();
    }*/

/*    //Jointure DQL
    '[...] FROM [...] INNER JOIN a.espece e [...]'

    //Jointure QB
    ->innerJoin('a.espece', 'e');*/
}

