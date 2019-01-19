<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }
    
    public function findAllPublishedOrderByNewest()
    {
      return $this->filterPublished()
        ->orderBy('a.published_at', 'DESC')
        ->getQuery()
        ->getResult()
      ;
    }

    public function findPublishedBySlug(string $slug)
    {
      return $this->filterPublished()
        ->andWhere('a.slug = :slug')
        ->setParameter('slug', $slug)
        ->getQuery()
        ->getOneOrNullResult()
      ;
    }

    private function filterPublished(QueryBuilder $qb = null)
    {
      return $this->getOrCreateQueryBuilder($qb)
        ->andWhere('a.published_at IS NOT NULL');
//      return $qb->andWhere('a.published_at IS NOT NULL');
    }
    
    private function getOrCreateQueryBuilder(QueryBuilder $qb = null)
    {
      return $qb ?: $this->createQueryBuilder('a');
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
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