<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
  /**
   * @var UserPasswordEncoderInterface
   */
  private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
  {

    $this->passwordEncoder = $passwordEncoder;
  }

  public function loadFixture(ObjectManager $manager)
  {
    $this->createMany(User::class, 10, function (User $user, $count) {
      $user
        ->setEmail('stellar-' . $count . '@example.com')
        ->setFirstName($this->faker->firstName)
        ->setTwitterUsername($this->faker->userName)
        ->setPassword($this->passwordEncoder->encodePassword(
          $user,
          'engage'
        ))
      ;
    });

    $manager->flush();
  }
}
