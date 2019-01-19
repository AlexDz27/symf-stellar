<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
  /**
   * @Route("/test/testing", name="test_testing")
   */
  public function testing()
  {
    $msg = 'Hi! asokdasko';

    return $this->render('test/index.html.twig', ['msg' => $msg]);
  }

  /**
   * @Route("/test/happy-message", name="test_happy_message")
   */
  public function happyMessage(MessageGenerator $messageGenerator)
  {
    $message = $messageGenerator->getHappyMessage();

    return new Response($message);
  }
}