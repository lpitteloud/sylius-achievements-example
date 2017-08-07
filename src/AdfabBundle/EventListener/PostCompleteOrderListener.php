<?php

namespace AdfabBundle\EventListener;

use AdfabBundle\Entity\Achievement;
use AdfabBundle\Specification\Achievement\Order\CasualShopperAchievementCanBeUnlocked;
use AdfabBundle\Specification\Achievement\Order\FashionistaAchievementCanBeUnlocked;
use AdfabBundle\Specification\Achievement\Order\SerialShopperAchievementCanBeUnlocked;
use Doctrine\ORM\EntityManager;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

/**
 * Class PostCompleteOrderListener
 * @package AdfabBundle\EventListener
 */
class PostCompleteOrderListener
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var
     */
    private $casualShopperKey;

    /**
     * @var
     */
    private $fashionistaKey;

    /**
     * @var
     */
    private $serialShopperKey;

    /**
     * PostCompleteOrderListener constructor.
     * @param EntityManager $em
     * @param $casualShopperKey
     * @param $fashionistaKey
     * @param $serialShopperKey
     */
    public function __construct(EntityManager $em, $casualShopperKey, $fashionistaKey, $serialShopperKey)
    {
        $this->em = $em;
        $this->casualShopperKey = $casualShopperKey;
        $this->fashionistaKey = $fashionistaKey;
        $this->serialShopperKey = $serialShopperKey;
    }

    /**
     * @param GenericEvent $event
     */
    public function unlockAchievement(GenericEvent $event)
    {
        $order = $event->getSubject();
        Assert::isInstanceOf($order, OrderInterface::class);

        $user = $order->getUser();
        Assert::notNull($user);

        $specification = new CasualShopperAchievementCanBeUnlocked($this->casualShopperKey);
        if ($specification->isSatisfiedBy($user) && !$user->earnedAchievement($this->casualShopperKey)) {
            $achievement = new Achievement();
            $achievement->setName($this->casualShopperKey);
            $achievement->setUser($user);

            $this->em->persist($achievement);
        }

        $specification = new FashionistaAchievementCanBeUnlocked($this->fashionistaKey);
        if ($specification->isSatisfiedBy($user) && !$user->earnedAchievement($this->fashionistaKey)) {
            $achievement = new Achievement();
            $achievement->setName($this->fashionistaKey);
            $achievement->setUser($user);

            $this->em->persist($achievement);
        }

        $specification = new SerialShopperAchievementCanBeUnlocked($this->serialShopperKey);
        if ($specification->isSatisfiedBy($user) && !$user->earnedAchievement($this->serialShopperKey)) {
            $achievement = new Achievement();
            $achievement->setName($this->serialShopperKey);
            $achievement->setUser($user);

            $this->em->persist($achievement);
        }

        $this->em->flush();
    }
}