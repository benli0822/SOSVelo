<?php

namespace SOSVelo\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SOSVelo\Bundle\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $admin = new User();
        $admin->setEmail("admin@mail.com");
        $admin->setUsername("admin");
        $admin->setPlainPassword("admin");
        $admin->setSuperAdmin(true);

        $manager->persist($admin);
        $manager->flush();

        $user1 = new User();
        $user1->setEmail("user1@mail.com");
        $user1->setUsername("user");
        $user1->setPlainPassword("user");

        $manager->persist($user1);
        $manager->flush();
    }

}
