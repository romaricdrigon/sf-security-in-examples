<?php

namespace App\Filter;

use App\Entity\Blog;
use Doctrine\ORM\Mapping\ClassMetaData;
use Doctrine\ORM\Query\Filter\SQLFilter;

class BlogFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $entityMetadata, $alias)
    {
        if (Blog::class !== $entityMetadata->reflClass->getName()) {
            return '';
        }

        $userId = $this->getParameter('user');

        if (null === $userId) {
            throw new \Exception('User was not set!');
        }

        return $alias.'.owner_id = '.$userId; // This SQL will be injected in 'WHERE'
    }
}
