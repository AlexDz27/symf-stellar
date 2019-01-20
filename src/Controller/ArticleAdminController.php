<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class ArticleAdminController extends AbstractController
{
  /**
   * @Route("/admin/article/create", name="admin_article_create")
   */
  public function create(EntityManagerInterface $em)
  {
    die('todo');
  }
}