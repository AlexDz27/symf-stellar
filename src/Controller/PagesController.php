<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
  /**
   * @Route("/", name="home")
   */
  public function home(ArticleRepository $repository)
  {
    $articles = $repository->findAllPublishedOrderByNewest();

    return $this->render('pages/home.html.twig', [
      'articles' => $articles
    ]);
  }
}