<?php

namespace AdfabBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\User\Model\User as BaseUser;

class User extends BaseUser implements AchievementUserInterface
{
    /**
     * @var Achievement[]
     *
     * @ORM\OneToMany(targetEntity="AdfabBundle\Entity\Achievement", mappedBy="user")
     * @ORM\OrderBy({"earnedAt" = "DESC"})
     */
    private $achievements;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->achievements = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Achievement $achievement
     * @return bool
     */
    public function earnedAchievement(Achievement $achievement)
    {
        if ($this->achievements->contains($achievement)) {
            return true;
        }

        return false;
    }

    /**
     * @param Achievement $achievement
     * @return $this
     */
    public function addAchievement(Achievement $achievement)
    {
        if (!$this->earnedAchievement($achievement)) {
            $this->achievements->add($achievement);
        }

        return $this;
    }

    /**
     * @param Achievement $achievement
     * @return $this
     */
    public function removeAchievement(Achievement $achievement)
    {
        if ($this->earnedAchievement($achievement)) {
            $this->achievements->remove($achievement);
        }

        return $this;
    }

    /**
     * @return Achievement[]
     */
    public function getAchievements()
    {
        return $this->achievements;
    }
}