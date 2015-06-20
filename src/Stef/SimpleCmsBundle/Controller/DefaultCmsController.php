<?php

namespace Stef\SimpleCmsBundle\Controller;

use Stef\SimpleCmsBundle\BaseController\BaseController;
use Symfony\Component\HttpFoundation\Request;

class DefaultCmsController extends BaseController
{
    public function createAction(Request $request, $mappingKey)
    {
        return $this->getDefaultCrudActions()->create($request, $this->getEntityMapping($mappingKey));
    }

    /**
     * @inheritdoc
     */
    public function readAction(Request $request, $mappingKey, $search)
    {
        return $this->getDefaultCrudActions()->read($request, $this->getEntityMapping($mappingKey), $this->getReflectionService() ,$search);
    }

    /**
     * @inheritdoc
     */
    public function updateAction(Request $request, $mappingKey, $id)
    {
        return $this->getDefaultCrudActions()->update($request, $this->getEntityMapping($mappingKey), $this->getRepository($this->getEntityMapping($mappingKey)->getRepoSelector()), $id);
    }

    /**
     * @inheritdoc
     */
    public function deleteAction(Request $request, $mappingKey, $id)
    {
        return $this->getDefaultCrudActions()->delete($request, $this->getEntityMapping($mappingKey), $this->getRepository($this->getEntityMapping($mappingKey)->getRepoSelector()), $id);
    }

    /**
     * @inheritdoc
     */
    public function indexAction(Request $request, $mappingKey)
    {
        $page = $request->query->get('page');
        $limit = $request->query->get('limit');

        $filter = $request->query->all();

        unset($filter['page']);
        unset($filter['limit']);
        unset($filter['filter']);

        if ($page < 1) {
            $page = 1;
        }

        if (!empty($limit) || !is_numeric($limit) || $limit < 1) {
            $limit = 15;
        }

        if (count($filter) == 0) {
            $entities = $this->getRepository($this->getEntityMapping($mappingKey)->getRepoSelector())->findBy([], [], $limit, (($page - 1) * $limit));
        } else {
            //$qb = $this->getEntityManager()->createQueryBuilder('e');
            $qb = $this->getRepository($this->getEntityMapping($mappingKey)->getRepoSelector())->createQueryBuilder('e');



            foreach ($filter as $key => $value) {
                $qb->where('e.' . $key . ' LIKE :' . $key);
                $qb->setParameter($key, $value);
            }

            $entities = $qb->getQuery()->getResult();
        }

        return $this->getDefaultCrudActions()->index($mappingKey, $entities);
    }
}