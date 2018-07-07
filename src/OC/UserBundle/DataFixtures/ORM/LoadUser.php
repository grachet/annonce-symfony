<?php

namespace OC\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {

    $listNames = array('guest', 'guillaume');

    foreach ($listNames as $name) {

      $user = new User;


      $user->setUsername($name);
        $user->setEmail($name);
      $user->setPlainPassword($name);
        $user->setEnabled(true);


      $user->setSalt('');

      $user->setRoles(array('ROLE_USER'));


      $manager->persist($user);
    }


    $manager->flush();
  }
}
