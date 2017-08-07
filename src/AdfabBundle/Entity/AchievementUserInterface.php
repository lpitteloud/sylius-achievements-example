<?php

namespace AdfabBundle\Entity;

/**
 * Interface AchievementUserInterface
 * @package AdfabBundle\Entity
 */
interface AchievementUserInterface
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