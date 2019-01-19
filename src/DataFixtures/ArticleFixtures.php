<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture
{
  private static $articlesTitles = [
    'Why Asteroids Taste Like Bacon',
    'Life on Planet Mercury: Tan, Relaxing and Fabulous',
    'Light Speed Travel: Fountain of Youth or Fallacy'
  ];
  private static $articlesImages = [
    'asteroid.jpeg',
    'mercury.jpeg',
    'lightspeed.png'
  ];
  private static $articleAuthors = [
    'Mike Ferengi',
    'Amy Oort',
  ];

  protected function loadFixture(ObjectManager $manager)
  {
    $this->createMany(Article::class, 10, function(Article $article, $count) {
      $article->setTitle($this->faker->randomElement(self::$articlesTitles))
        ->setContent(<<<HEREDOC
**Lorem** Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
 industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
  type and scrambled it to make a type specimen book. It has survived not only five centuries,
 but also the leap into electronic typesetting, remaining essentially unchanged.
HEREDOC
)
        ->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'))
        ->setAuthor($this->faker->randomElement(self::$articleAuthors))
        ->setLikesCount($this->faker->numberBetween(5, 100))
        ->setImagePath($this->faker->randomElement(self::$articlesImages))
      ;
    });

    $manager->flush();
  }
}