<?php

namespace AdfabBundle\EventListener;

use AdfabBundle\Entity\Achievement;
use AdfabBundle\Specification\Achievement\Order\CasualShopperAchievementCanBeUnlocked;
use AdfabBundle\Specification\Achievement\Order\FashionistaAchievementCanBeUnlocked;
use AdfabBundle\Specification\Achievement\Order\SerialShopperAchievementCanBeUnlocked;
use Doctrine\ORM\EntityManager;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Order\Model\Order;
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

        $customer = $order->getCustomer();
        Assert::notNull($customer);

        $specification = new CasualShopperAchievementCanBeUnlocked($this->casualShopperKey);
        if (!$customer->earnedAchievement($this->casualShopperKey) && $specification->isSatisfiedBy($customer)) {
            $achievement = new Achievement();
            $achievement->setName($this->casualShopperKey);
            $achievement->setCustomer($customer);

            $this->em->persist($achievement);
        }

        $specification = new FashionistaAchievementCanBeUnlocked($this->fashionistaKey);
        if (!$customer->earnedAchievement($this->fashionistaKey) && $specification->isSatisfiedBy($customer)) {
            $achievement = new Achievement();
            $achievement->setName($this->fashionistaKey);
            $achievement->setCustomer($customer);

            $this->em->persist($achievement);
        }

        $specification = new SerialShopperAchievementCanBeUnlocked($this->serialShopperKey);
        if (!$customer->earnedAchievement($this->serialShopperKey) && $specification->isSatisfiedBy($customer)) {
            $achievement = new Achievement();
            $achievement->setName($this->serialShopperKey);
            $achievement->setCustomer($customer);

            $this->em->persist($achievement);
        }

        $this->em->flush();
    }
}