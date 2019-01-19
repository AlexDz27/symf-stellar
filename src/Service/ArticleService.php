<?php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class ArticleService
{
  private $logger;
  private $em;

  public function __construct(LoggerInterface $logger, EntityManagerInterface $em)
  {
    $this->logger = $logger;
    $this->em = $em;
  }

  public function addLike(Article $article)
  {
    $article->setLikesCount($article->getLikesCount() + 1);
    $this->em->flush();

    $this->logger->info('Article liked');
  }
}