<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

  /**
   * @IsGranted("ROLE_ADMIN")
   * @Route("/some-admin")
   */
  public function someAdmin()
  {
    return new Response('some admin response');
  }
}