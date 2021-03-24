<?php

namespace App\Repository;

use App\Entity\Reparation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Reparation find($id, $lockMode = null, $lockVersion = null)
 * @method null|Reparation findOneBy(array $criteria, array $orderBy = null)
 * @method Reparation[]    findAll()
 * @method Reparation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReparationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reparation::class);
    }

    public function findByVille($ville)
    {
        return $this->createQueryBuilder('p')
            ->addSelect('v')
            ->leftJoin('p.ville', 'v')
            ->andWhere('v.nom_reparation = :val')
            ->setParameter('val', $ville)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Reparation[] Returns an array of Reparation objects
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
    public function findOneBySomeField($value): ?Reparation
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
