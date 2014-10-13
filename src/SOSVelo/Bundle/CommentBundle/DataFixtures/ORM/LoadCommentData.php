<?php //

namespace SOSVelo\Bundle\CommentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SOSVelo\Bundle\CommentBundle\Entity\Comment;

class LoadCommentData implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
    }

}
