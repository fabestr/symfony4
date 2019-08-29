<?php

namespace App\Repository;

use App\Entity\Artist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artist::class);
    }

    // /**
    //  * @return Artist[] Returns an array of Artist objects
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
    public function findOneBySomeField($value): ?Artist
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    
    public function findByArtist()
    {

        //exemple de sous requete
        $q1 = $this->createQueryBuilder('x');
        $qexpr = $q1->expr();// permet d'accéder au requetes de expr()
        $subrequest = $q1->select('x.id')
                        ->where($qexpr->like('x.pays', $qexpr->literal('Ouganda')));

        //requete principal dans la quelle on integre la sous requete
        return $this->createQueryBuilder('a')
            ->select('partial a.{id,nom,style} as artist')
            ->addSelect('count(e.id) as events')
            ->innerJoin('a.events','e')
            ->where($qexpr->in('a.id', $subrequest->getDQL()))
            ->groupBy('a.id')
            ->getQuery()
            ->getResult()
        ;
    }
}

