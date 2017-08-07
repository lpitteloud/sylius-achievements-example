<?php

namespace AdfabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Achievement
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $earnedAt;

    /**
     * @var AchievementUserInterface
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AchievementUserInterface", inversedBy="achievements")
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