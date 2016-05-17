<?php

namespace Stef\SimpleCmsBundle\Form;

class FormFactory
{
    protected $factory;

    function __construct(\Symfony\Component\Form\FormFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param $entity
     * @param string $formType
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    public function buildDynamicFormType($entity, $formType = 'Stef\SimpleCmsBundle\Form\DynamicType')
    {
        return $this->factory->create($formType, $entity);
    }
} 