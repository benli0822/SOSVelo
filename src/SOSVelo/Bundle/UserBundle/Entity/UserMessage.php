<?php
/**
 * Created by PhpStorm.
 * User: jamesRMBP
 * Date: 09/01/15
 * Time: 09:09
 */

namespace SOSVelo\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\MessageBundle\Entity\Message as BaseMessage;

/**
 * @ORM\Entity(repositoryClass="SOSVelo\Bundle\UserBundle\Entity\UserMessageRepository")
 */
class UserMessage extends BaseMessage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="SOSVelo\Bundle\UserBundle\Entity\UserMessageThread",
     *   inversedBy="messages"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\UserBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="SOSVelo\Bundle\UserBundle\Entity\UserMessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata
     */
    protected $metadata;
}