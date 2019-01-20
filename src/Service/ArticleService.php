<?php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;

class ArticleService
{
  private $logger;
  private $em;
  /**
   * @var Security
   */
  private $security;

  public function __construct(LoggerInterface $logger, EntityManagerInterface $em, Security $security)
  {
    $this->logger = $logger;
    $this->em = $em;
    $this->security = $security;
  }

  public function addLike(Article $article)
  {
    $article->setLikesCount($article->getLikesCount() + 1);
    $this->em->flush();

    $this->logger->info('Article liked', [
      'user' => $this->security->getUser()
    ]);
  }
}