<?php

namespace AdfabBundle\Specification\Achievement\Order;

use AdfabBundle\Specification\SpecificationInterface;

class FashionistaAchievementCanBeUnlocked implements SpecificationInterface
{
    /**
     * @param $candidate
     * @return bool
     */
    public function isSatisfiedBy($candidate)
    {
        return true;
    }
}