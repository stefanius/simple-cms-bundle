<?php

namespace Stef\SimpleCmsBundle\Form;

use Stef\SimpleCmsBundle\Reflection\ReflectionService;

class FormFactory
{

    protected $factory;

    protected $reflection;

    function __construct(ReflectionService $reflection, \Symfony\Component\Form\FormFactory $factory)
    {
        $this->reflection = $reflection;
        $this->factory = $factory;
    }

    /**
     * @param $entity
     * @param array $formOptionsArray
     * @return DynamicType
     */
    public function buildDynamicFormType($entity, array $formOptionsArray = array())
    {
        return $this->factory->create(DynamicType::class, $entity);
    }
} 