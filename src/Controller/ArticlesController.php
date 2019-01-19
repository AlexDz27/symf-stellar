<?php

namespace App\Controller;

use App\Service\Markdown as MarkdownHelper;
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
    return new Response('OMG! My first article already! WOOO!');
  }

  /**
   * @Route("/articles/{slug}", name="article_show")
   */
  public function show($slug, MarkdownHelper $markdownHelper)
  {
    $comments = [
      'I ate a normal rock once. It did NOT taste like bacon! 1',
      'I ate a normal rock once. It did NOT taste like bacon! 2',
      'I ate a normal rock once. It did NOT taste like bacon! 3',
    ];

    $articleContent = <<<HEREDOC
**Lorem Ipsum** is simply [dummy text](https://example.com) of the printing and typesetting industry.
 Lorem Ipsum has been the industry's standard dummy text ever since the
  1500s, when an unknown printer took a galley of type and scrambled it to make
   a type specimen book. It has survived not only five centuries,
 but also the leap into electronic typesetting, remaining essentially unchanged.
HEREDOC;

    $articleContent = $markdownHelper->parse($articleContent);

    return $this->render('articles/show.html.twig',
      [
        'slug' => $slug,
        'title' => ucwords(str_replace('-', ' ', $slug)),
        'articleContent' => $articleContent,
        'comments' => $comments
      ]
    );
  }

  /**
   * @Route("/articles/{slug}/like", name="article_liked", methods={"POST"})
   */
  public function articleLiked($slug, LoggerInterface $logger)
  {
    // TODO - actually heart/unheart the article!

    $logger->info('Article liked');


    return new JsonResponse(['likes' => rand(5, 100)]);
  }
}