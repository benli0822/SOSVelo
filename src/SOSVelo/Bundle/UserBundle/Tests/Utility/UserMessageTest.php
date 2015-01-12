<?php
/**
 * Created by PhpStorm.
 * User: jamesRMBP
 * Date: 09/01/15
 * Time: 12:00
 */

namespace SOSVelo\Bundle\PointBundle\Tests\Utility;


use SOSVelo\Bundle\UserBundle\SOSVeloUserBundle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use SOSVelo\Bundle\UserBundle\Entity\User;




class UserMessageTest extends KernelTestCase{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();


        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
            ;

        $this->threadBuilder = static::$kernel->getContainer()->get('fos_message.composer')->newThread();
        $this->userManager = static::$kernel->getContainer()->get('fos_user.user_manager');
        $this->sender = static::$kernel->getContainer()->get('fos_message.sender');
    }


    public function testFailure()
    {

        $user1 = $this->em
            ->getRepository('SOSVeloUserBundle:User')
            ->findByUsername('admin')
        ;
        $user2 = $this->em
            ->getRepository('SOSVeloUserBundle:User')
            ->findByUsername('user')
        ;
        $user2 = $this->userManager->findUserByUsername('user');
        $user1 = $this->userManager->findUserByUsername('admin');

       // debug_zval_dump($user3 instanceof $testObj);
        //composing a message
       // $sender = $user1;





        $this->threadBuilder
            ->addRecipient($user2) // Retrieved from your backend, your user manager or ...
            ->setSender($user1)
            ->setSubject('Stof commented on your pull request #456789')
            ->setBody('123');




        //send a message
        $sender = $this->sender;
        $sender->send($this->threadBuilder->getMessage());

        $this->assertCount(1, $this->em
            ->getRepository('SOSVeloUserBundle:UserMessage')
            ->findByBody('123')
        );


    }


//    public function testAddAMessage()
//    {
//        $user1 = $this->em
//            ->getRepository('SOSVeloUserBundle:User')
//            ->find(1);
//
//        $user2 = $this->em
//            ->getRepository('SOSVeloUserBundle:User')
//            ->find(2);
//
//        //composing a message
//        $sender = $user1;
//        $threadBuilder = $this->get('fos_message.composer')->newThread();
//        $threadBuilder
//            ->addRecipient($user2) // Retrieved from your backend, your user manager or ...
//            ->setSender($sender)
//            ->setSubject('Stof commented on your pull request #456789')
//            ->setBody('You have a typo, : mondo instead of mongo. Also for coding standards ...');
//
//        //send a message
//        $sender = $this->get('fos_message.sender');
//        $sender->send($threadBuilder->getMessage());
//
////        $this->assertCount(0, $this->em
////            ->getRepository('SOSVeloUserBundle:UserMessage')
////            ->find(1));
//        $this->assertEquals(1, 0);
//    }


    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
} 