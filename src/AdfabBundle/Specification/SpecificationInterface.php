<?php

namespace AdfabBundle\Specification;

/**
 * Interface SpecificationInterface
 * @package AdfabBundle\Specification
 */
interface SpecificationInterface
{
    /**
     * @param $candidate
     * @return mixed
     */
    public function isSatisfiedBy($candidate);
}