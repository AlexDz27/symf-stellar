<?php

namespace App\Service;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class Markdown
{
  private $cache;
  private $markdown;
  private $logger;
  private $isDebug;

  public function __construct(
    AdapterInterface $cache,
    MarkdownInterface $markdown,
    LoggerInterface $mdLogger,
    bool $isDebug)
  {
    $this->cache = $cache;
    $this->markdown = $markdown;
    $this->logger = $mdLogger;
    $this->isDebug = $isDebug;
  }

  public function parse(string $source): string
  {
    if (stripos($source, 'ipsum') !== false) {
      $this->logger->info('They are talking about ipsum again!');
    }

    if ($this->isDebug) {
      return $this->markdown->transform($source);
    }

    $cacheItem = $this->cache->getItem('markdown_' . md5($source));
    if (!$cacheItem->isHit()) {
      $cacheItem->set($articleContent = $this->markdown->transform($source));
      $this->cache->save($cacheItem);
    }

    return $cacheItem->get();
  }
}