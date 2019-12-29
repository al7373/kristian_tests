<?php

namespace App\Repository;

use App\Entity\NEO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NEO|null find($id, $lockMode = null, $lockVersion = null)
 * @method NEO|null findOneBy(array $criteria, array $orderBy = null)
 * @method NEO[]    findAll()
 * @method NEO[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NEORepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NEO::class);
    }

    // /**
    //  * @return NEO[] Returns an array of NEO objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NEO
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
