<?php

namespace Stefanius\SimpleCmsBundle\BaseController;

use Stefanius\SimpleCmsBundle\Crud\DefaultCrudActions;
use Stefanius\SimpleCmsBundle\EntityMapper\Mapper;
use Stefanius\SimpleCmsBundle\EntityMapper\Mapping;
use Stefanius\SimpleCmsBundle\Reflection\ReflectionService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /**
     * @return mixed
     */
    protected function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param $repository
     * 
     * @return mixed
     */
    protected function getRepository($repository)
    {
        $em = $this->getEntityManager();

        return $em->getRepository($repository);
    }

    /**
     * @return Mapper
     */
    protected function getEntityMapper()
    {
        return $this->get("stef_simple_cms.entity_mapper");
    }

    /**
     * @param $mappingKey
     * 
     * @return Mapping
     */
    protected function getEntityMapping($mappingKey)
    {
        return $this->getEntityMapper()->getMapping($mappingKey);
    }

    /**
     * @return DefaultCrudActions
     */
    protected function getDefaultCrudActions()
    {
        return $this->get('stef_simple_cms.crud_actions');
    }

    /**
     * @return ReflectionService
     */
    protected function getReflectionService()
    {
        return $this->get('stef_simple_cms.reflection');
    }
}
