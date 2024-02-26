<?php

namespace App\Repository;

use App\Entity\EquipePoule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EquipePoule>
 *
 * @method EquipePoule|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipePoule|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipePoule[]    findAll()
 * @method EquipePoule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipePouleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipePoule::class);
    }

//    /**
//     * @return EquipePoule[] Returns an array of EquipePoule objects
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

//    public function findOneBySomeField($value): ?EquipePoule
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
