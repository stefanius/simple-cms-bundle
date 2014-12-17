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
        $dynamic = new DynamicType();
        $dynamic->setFields($this->readAllPropertiesFromEntity($entity));
        $dynamic->setName('test');
        $dynamic->setFormOptionsArray($formOptionsArray);

        return $this->factory->create($dynamic, $entity);;
    }

    protected function readAllPropertiesFromEntity($entity)
    {
        $normalized = [];
        $props = $this->reflection->getProperties($entity);

        foreach ($props as $prop) {
            $normalized[$prop->getName()]['name'] = $prop->getName();
            $normalized[$prop->getName()]['modifiers'] = $prop->getModifiers();
            $normalized[$prop->getName()]['doc_comment'] = $prop->getDocComment();
        }

        return $normalized;
    }
} 