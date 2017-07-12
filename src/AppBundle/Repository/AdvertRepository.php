<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use AppBundle\Entity\Project;
use AppBundle\Entity\User;


/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return array
     */
    public function getAllAdverts()
    {
        $qb = $this->createQueryBuilder('a')
            ->select(['a', 'address', 'category', 'project', 'user'])
            ->innerJoin('a.address', 'address')
            ->innerJoin('a.category', 'category')
            ->innerJoin('a.project', 'project')
            ->innerJoin('a.user', 'user')
            ->getQuery();

        $query = $qb->getResult();
        return $query;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getAdvertsByUser(User $user)
    {
        $qb = $this->createQueryBuilder('a')
            ->select(['a'])
            ->innerJoin('a.images', 'images')
            ->where('a.user = :user');
        $query = $qb->getQuery()
            ->setParameter('user', $user->getId());

        return $query->getResult();
    }

    public function searchAdverts($project, $category, $minPrice, $maxPrice, $postCode)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->innerJoin('a.images', 'images')
            ->innerJoin('a.address', 'address');

        $hasParameters = false;

        if (!empty($project)) {
            $qb = $this->setQueryParameters(
                $project,
                [
                    "condition" => "a.project = :project",
                    "objName" => "project"
                ],
                $qb,
                $hasParameters);
            $hasParameters = true;
        }
        if (!empty($category)) {
            $qb = $this->setQueryParameters(
                $category,
                [
                    "condition" => "a.category = :category",
                    "objName" => "category"
                ],
                $qb,
                $hasParameters);
            $hasParameters = true;
        }
        if (!empty($minPrice)) {
            $qb = $this->setQueryParameters(
                $minPrice,
                [
                    "condition" => "a.price > :minPrice",
                    "objName" => "minPrice"
                ],
                $qb,
                $hasParameters);
            $hasParameters = true;
        }
        if (!empty($maxPrice)) {
            $qb = $this->setQueryParameters(
                $maxPrice,
                [
                    "condition" => "a.price < :maxPrice",
                    "objName" => "maxPrice"
                ],
                $qb,
                $hasParameters);
            $hasParameters = true;
        }
        if (!empty($postCode)) {
            $qb = $this->setQueryParameters(
                $postCode,
                [
                    "condition" => "a.postcode = :postcode",
                    "objName" => "postcode"
                ],
                $qb,
                $hasParameters);
            $hasParameters = true;
        }
        $query = $qb->getQuery();

        return $query->getResult();
    }

    private function setQueryParameters($obj, $options, $qb, $hasParams)
    {
        if ($hasParams) {
            $qb->andWhere($options['condition']);
        } else {
            $qb->where($options['condition']);
        }
        $qb->setParameter($options['objName'], $obj);

        return $qb;
    }
}
