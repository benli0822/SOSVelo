<?php

namespace SOSVelo\Bundle\PointBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use FOS\CommentBundle\Model\VotableCommentInterface;


/**
 * PointComment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SOSVelo\Bundle\PointBundle\Entity\PointCommentRepository")
 *
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */

class PointComment extends BaseComment implements SignedCommentInterface, VotableCommentInterface
{



    /**
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\PointBundle\Entity\Point", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $point;


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\PointBundle\Entity\PointCommentThread")
     */
    protected $thread;

    /**
     * Author of the comment
     *
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\UserBundle\Entity\User")
     * @var User
     */
    protected $author;

    public function setAuthor(UserInterface $author) {
        $this->author = $author;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getAuthorName() {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }

        return $this->getAuthor()->getUsername();
    }

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $score = 0;

    /**
     * Sets the score of the comment.
     *
     * @param integer $score
     */
    public function setScore($score) {
        $this->score = $score;
    }

    /**
     * Returns the current score of the comment.
     *
     * @return integer
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * Increments the comment score by the provided
     * value.
     *
     * @param integer value
     *
     * @return integer The new comment score
     */
    public function incrementScore($by = 1) {
        $this->score += $by;
    }


    /**
     * Set point
     *
     * @param \SOSVelo\Bundle\PointBundle\Entity\Point $point
     * @return PointComment
     */
    public function setPoint(\SOSVelo\Bundle\PointBundle\Entity\Point $point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return \SOSVelo\Bundle\PointBundle\Entity\Point 
     */
    public function getPoint()
    {
        return $this->point;
    }


}
