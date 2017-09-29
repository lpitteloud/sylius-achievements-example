<?php

namespace AdfabBundle\Specification\Achievement\Order;

use AdfabBundle\Specification\SpecificationInterface;
use Doctrine\Common\Collections\Criteria;
use Sylius\Component\Core\Model\CustomerInterface;

class SerialShopperAchievementCanBeUnlocked implements SpecificationInterface
{
    const ORDERS_MIN_COUNT = 3;

    /**
     * @param $candidate
     * @return bool
     */
    public function isSatisfiedBy($candidate)
    {
        if ($candidate instanceof CustomerInterface) {
            $from = new \DateTime('UTC');
            $from->sub(new \DateInterval('P3M'));

            $filter = Criteria::create()
                ->where(Criteria::expr()->gt('createdAt', $from))
                ->andWhere(Criteria::expr()->eq('checkoutState', 'completed'));

            $filteredOrders = $candidate->getOrders()->matching($filter);

            if ($filteredOrders->count() > self::ORDERS_MIN_COUNT) {
                return true;
            }
        }

        return false;
    }
}