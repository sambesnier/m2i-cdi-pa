<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use AppBundle\Entity\Project;
use AppBundle\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param int $page
     * @return Paginator
     */
    public function getAllAdverts($page = 1)
    {
        $qb = $this->createQueryBuilder('a')
            ->select(['a', 'address', 'category', 'project', 'user'])
            ->innerJoin('a.address', 'address')
            ->innerJoin('a.category', 'category')
            ->innerJoin('a.project', 'project')
            ->innerJoin('a.user', 'user')
            ->getQuery();

        $maxResults = 10;

        $firstResult = ($page - 1) * $maxResults;
        $qb->setFirstResult($firstResult)->setMaxResults($maxResults);

        $paginator = new Paginator($qb);

        if (($paginator->count() <= $firstResult) && $page != 1) {
            throw new NotFoundHttpException("La page demandée n'existe pas");
        }

        return $paginator;
    }

    /**
     * @param User $user
     * @return Paginator
     */
    public function getAdvertsByUser(User $user, $page = 1)
    {
        $qb = $this->createQueryBuilder('a')
            ->select(['a'])
            ->innerJoin('a.images', 'images')
            ->where('a.user = :user');
        $query = $qb->getQuery()
            ->setParameter('user', $user->getId());

        $maxResults = 10;

        $firstResult = ($page - 1) * $maxResults;
        $query->setFirstResult($firstResult)->setMaxResults($maxResults);

        $paginator = new Paginator($query);

        if (($paginator->count() <= $firstResult) && $page != 1) {
            throw new NotFoundHttpException("La page demandée n'existe pas");
        }

        return $paginator;
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
