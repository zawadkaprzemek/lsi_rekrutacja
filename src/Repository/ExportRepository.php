<?php

namespace App\Repository;

use App\Entity\Export;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Export>
 *
 * @method Export|null find($id, $lockMode = null, $lockVersion = null)
 * @method Export|null findOneBy(array $criteria, array $orderBy = null)
 * @method Export[]    findAll()
 * @method Export[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Export::class);
    }

    //    /**
    //     * @return Export[] Returns an array of Export objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Export
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    public function getDistinctPlaces()
    {
        return $this->createQueryBuilder('e')
            ->select('e.place')
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    public function filterExports(\DateTime $dateFrom, \DateTime $dateTo, ?string $place = null)
    {
        $dateFrom->setTime(0, 0,);
        $dateTo->setTime(23, 59, 99);
        $qb = $this->createQueryBuilder('e')
            ->where('e.dateTime between :from AND :to')
            ->setParameters(new ArrayCollection(array(
                    new Parameter('from', $dateFrom),
                    new Parameter('to', $dateTo),
                )
            ));

        if ($place) {
            $qb->andWhere('e.place = :place')
                ->setParameter('place', $place);
        }

        return $qb->getQuery()->getResult();

    }
}
