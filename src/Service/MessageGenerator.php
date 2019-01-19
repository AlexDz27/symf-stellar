<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class MessageGenerator
{
  private $logger;
  private $firstMessage;

  public function __construct(LoggerInterface $logger, $firstMessage)
  {
    $this->logger = $logger;
    $this->firstMessage = $firstMessage;
  }
  
  public function getHappyMessage()
  {
    $this->logger->info($this->firstMessage);
    $this->logger->info('About to find a happy message!');
    $messages = [
      'You did it! You updated the system! Amazing!',
      'That was one of the coolest updates I\'ve seen all day!',
      'Great work! Keep going!',
    ];

    $index = array_rand($messages);

    return $messages[$index];
  }
}