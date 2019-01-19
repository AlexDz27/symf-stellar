<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
  /** @var ObjectManager  */
  private $manager;

  /** @var Generator  */
  protected $faker;

  public function load(ObjectManager $manager)
  {
    $this->manager = $manager;
    $this->faker = Factory::create();

    $this->loadFixture($manager);
  }
  
  abstract protected function loadFixture(ObjectManager $manager);

  protected function createMany(string $className, int $count, callable $factoryCb)
  {
    for ($i = 0; $i <= $count; $i++) {
      $entity = new $className();
      $factoryCb($entity, $i);

      $this->manager->persist($entity);
      // store for usage later as App\Entity\ClassName_#COUNT#
      $this->addReference($className . '_' . $i, $entity);
    }
  }
}