<?php

namespace AdfabBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Sylius\Component\Core\Model\Customer as BaseCustomer;

/**
 * Class Customer
 * @package AdfabBundle\Entity
 */
class Customer extends BaseCustomer implements AchievementCustomerInterface
{
    /**
     * @var Achievement[]
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
     * @param string $key
     * @return bool
     */
    public function earnedAchievement($key)
    {
        $filter = Criteria::create()
            ->where(Criteria::expr()->eq('name', $key));

        $filteredAchievements = $this->achievements->matching($filter);

        if ($filteredAchievements->count() > 0) {
            return true;
        }

        return false;
    }

    /**
     * @return Achievement[]
     */
    public function getAchievements()
    {
        return $this->achievements;
    }
}