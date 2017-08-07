<?php

namespace AdfabBundle\Entity;

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