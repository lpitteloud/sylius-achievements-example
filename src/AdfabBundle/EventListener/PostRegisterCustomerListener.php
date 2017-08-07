<?php

namespace AdfabBundle\EventListener;

use AdfabBundle\Entity\Achievement;
use AdfabBundle\Specification\Achievement\Customer\FashionLoverAchievementCanBeUnlocked;
use Doctrine\ORM\EntityManager;
use Sylius\Component\Core\Model\CustomerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

/**
 * Class PostRegisterCustomerListener
 * @package AdfabBundle\EventListener
 */
class PostRegisterCustomerListener
{
    /**
     * @var
     */
    private $em;

    /**
     * @var
     */
    private $fashionLoverKey;

    /**
     * PostRegisterCustomerListener constructor.
     * @param EntityManager $em
     * @param $fashionLoverKey
     */
    public function __construct(EntityManager $em, $fashionLoverKey)
    {
        $this->em = $em;
        $this->fashionLoverKey = $fashionLoverKey;
    }

    /**
     * @param GenericEvent $event
     */
    public function unlockAchievement(GenericEvent $event)
    {
        $customer = $event->getSubject();
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        Assert::notNull($user);

        $specification = new FashionLoverAchievementCanBeUnlocked($this->fashionLoverKey);
        if ($specification->isSatisfiedBy($user) && !$user->earnedAchievement($this->fashionLoverKey)) {
            $achievement = new Achievement();
            $achievement->setName($this->fashionLoverKey);
            $achievement->setUser($user);

            $this->em->persist($achievement);
            $this->em->flush();
        }
    }
}