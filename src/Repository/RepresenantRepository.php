<?php

namespace App\Repository;

use App\Entity\Represenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Represenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Represenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Represenant[]    findAll()
 * @method Represenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresenantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Represenant::class);
    }

    // /**
    //  * @return Represenant[] Returns an array of Represenant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Represenant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
