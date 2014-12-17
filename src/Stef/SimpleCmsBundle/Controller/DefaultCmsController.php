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
        $entities = $this->getRepository($this->getEntityMapping($mappingKey)->getRepoSelector())->findAll();

        return $this->getDefaultCrudActions()->index($mappingKey, $entities);
    }
}