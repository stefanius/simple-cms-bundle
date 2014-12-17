<?php

namespace Stef\SimpleCmsBundle\BaseController;

use Stef\SimpleCmsBundle\Crud\DefaultCrudActions;
use Stef\SimpleCmsBundle\EntityMapper\Mapper;
use Stef\SimpleCmsBundle\EntityMapper\Mapping;
use Stef\SimpleCmsBundle\Form\FormOptions;
use Stef\SimpleCmsBundle\Reflection\ReflectionService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

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
     * @return Mapping
     */
    protected function getEntityMapping($mappingKey)
    {
        return $this->getEntityMapper()->getMapping($mappingKey);
    }

    /**
     * @return FormOptions
     */
    protected function getFormOptions()
    {
        return $this->get('stef_simple_cms.form_options');
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