<?php

namespace AdfabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var Customer
     */
    private $customer;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * PrePersist event.
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
     * @param AchievementCustomerInterface $customer
     * @return $this
     */
    public function setCustomer(AchievementCustomerInterface $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return AchievementCustomerInterface
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}