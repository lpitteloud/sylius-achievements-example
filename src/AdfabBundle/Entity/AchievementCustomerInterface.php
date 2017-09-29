<?php

namespace AdfabBundle\Entity;

/**
 * Interface AchievementCustomerInterface
 * @package AdfabBundle\Entity
 */
interface AchievementCustomerInterface
{
    /**
     * @param string $key
     * @return bool
     */
    public function earnedAchievement($key);

    /**
     * @return Achievement[]
     */
    public function getAchievements();
}