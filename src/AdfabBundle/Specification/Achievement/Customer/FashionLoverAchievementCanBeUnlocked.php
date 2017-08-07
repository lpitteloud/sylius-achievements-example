<?php

namespace AdfabBundle\Specification\Achievement\Customer;

use AdfabBundle\Specification\SpecificationInterface;

class FashionLoverAchievementCanBeUnlocked implements SpecificationInterface
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