<?php

namespace AdfabBundle\Entity;

/**
 * Class Achievement
 * @package AdfabBundle\Entity
 */
class Achievement
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $earnedAt;

    /**
     * @var User
     */
    private $user;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setEarnedAtValue()
    {
        $this->earnedAt = new \DateTime('UTC');
    }

    /**
     * @return \DateTime
     */
    public function getEarnedAt()
    {
        return $this->earnedAt;
    }

    /**
     * @param AchievementUserInterface $user
     * @return $this
     */
    public function setUser(AchievementUserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return AchievementUserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}