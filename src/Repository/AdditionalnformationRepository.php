<?php

namespace App\Repository;

use App\Entity\Additionalnformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Additionalnformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Additionalnformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Additionalnformation[]    findAll()
 * @method Additionalnformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdditionalnformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Additionalnformation::class);
    }

    // /**
    //  * @return Additionalnformation[] Returns an array of Additionalnformation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Additionalnformation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
