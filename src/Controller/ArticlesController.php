<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\ArticleService;
use App\Service\Markdown as MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends AbstractController
{
  private $isDebug;

  public function __construct(bool $isDebug)
  {
    $this->isDebug = $isDebug;
  }

  /**
   * @Route("/articles/")
   *
   * @return Response
   */
  public function index()
  {
    return $this->redirectToRoute('home');
  }

  /**
   * @Route("/articles/{slug}", name="article_show")
   */
  public function show(Article $article)
  {
    $comments = [
      'I ate a normal rock once. It did NOT taste like bacon! 1',
      'I ate a normal rock once. It did NOT taste like bacon! 2',
      'I ate a normal rock once. It did NOT taste like bacon! 3',
    ];

    return $this->render('articles/show.html.twig',
      [
        'article' => $article,
        'comments' => $comments
      ]
    );
  }

  /**
   * @Route("/articles/{slug}/like", name="article_liked", methods={"POST"})
   */
  public function articleLiked(Article $article, ArticleService $service)
  {
    $service->addLike($article);

    return new JsonResponse(['likes' => $article->getLikesCount()]);
  }
}