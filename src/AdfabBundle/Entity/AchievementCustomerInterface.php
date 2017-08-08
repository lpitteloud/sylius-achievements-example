<?php

namespace AdfabBundle\Entity;

/**
 * Interface AchievementCustomerInterface
 * @package AdfabBundle\Entity
 */
interface AchievementCustomerInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return Achievement[]
     */
    public function getAchievements();
}