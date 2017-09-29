<?php

namespace AdfabBundle\Specification\Achievement\Order;

use AdfabBundle\Specification\SpecificationInterface;
use Sylius\Component\Core\Model\CustomerInterface;

class CasualShopperAchievementCanBeUnlocked implements SpecificationInterface
{
    /**
     * @param $candidate
     * @return bool
     */
    public function isSatisfiedBy($candidate)
    {
        if ($candidate instanceof CustomerInterface) {
            if ($candidate->getOrders()->count() === 1) {
                return true;
            }
        }

        return false;
    }
}