<?php

namespace App\Repository;

use App\Entity\NEO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

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

		public function findFastest(bool $isHazardous = false)
		{
			$qb = $this->_em->createQueryBuilder();
			$qb
				->select('neo')
				->from(NEO::class, 'neo')
      	->where($qb->expr()->eq('neo.is_hazardous', ':h'))
      	->setParameter('h', $isHazardous)
			;
			$qb
				->orderBy('neo.speed', 'DESC')
				->setFirstResult(0)
				->setMaxResults(1)
			;
			return $qb->getQuery()->getOneOrNullResult();
		}

		public function bestYear(bool $isHazardous = false)
		{
			$rsm = new ResultSetMapping();
			$rsm->addScalarResult("year", "best_year");
			$query = $this->_em->createNativeQuery("SELECT YEAR(date) AS year, COUNT(id) AS count FROM neo GROUP BY year ORDER BY count DESC LIMIT 1", $rsm);
			return $query->getOneOrNullResult();
		}

		public function bestMonth(bool $isHazardous = false)
		{
			$rsm = new ResultSetMapping();
			$rsm->addScalarResult("month", "best_month");
			$query = $this->_em->createNativeQuery("SELECT MONTH(date) AS month, COUNT(id) AS count FROM neo GROUP BY month ORDER BY count DESC LIMIT 1", $rsm);
			return $query->getOneOrNullResult();
		}
}
