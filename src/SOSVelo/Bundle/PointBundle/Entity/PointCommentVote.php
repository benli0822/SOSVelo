<?php
/**
 * Created by PhpStorm.
 * User: jamesRMBP
 * Date: 07/01/15
 * Time: 10:33
 */
namespace SOSVelo\Bundle\PointBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Vote as BaseVote;
use FOS\CommentBundle\Model\SignedVoteInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class PointCommentVote extends BaseVote implements SignedVoteInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Comment of this vote
     *
     * @var Comment
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\PointBundle\Entity\PointComment")
     */
    protected $comment;

    /**
     * Author of the vote
     *
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\UserBundle\Entity\User")
     * @var User
     */
    protected $voter;

    /**
     * Sets the owner of the vote
     *
     * @param string $user
     */
    public function setVoter(UserInterface $voter)
    {
        $this->voter = $voter;
    }

    /**
     * Gets the owner of the vote
     *
     * @return UserInterface
     */
    public function getVoter()
    {
        return $this->voter;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


}
