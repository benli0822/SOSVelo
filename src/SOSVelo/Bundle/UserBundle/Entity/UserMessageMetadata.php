<?php
/**
 * Created by PhpStorm.
 * User: jamesRMBP
 * Date: 09/01/15
 * Time: 09:10
 */

namespace SOSVelo\Bundle\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;




/**
 * @ORM\Entity
 */
class UserMessageMetadata extends BaseMessageMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="SOSVelo\Bundle\UserBundle\Entity\UserMessage",
     *   inversedBy="metadata"
     * )
     * @var \FOS\MessageBundle\Model\MessageInterface
     */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\UserBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $participant;
}