<?php

namespace Stefanius\SimpleCmsBundle\Form;

use Stefanius\SimpleCmsBundle\Reflection\ReflectionService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DynamicType extends AbstractType
{
    /**
     * @var array
     */
    protected $fields = [];

    protected $name;

    /**
     * @var array
     */
    protected $formOptionsArray = [];

    /**
     * @param array $fields
     */
    public function setFields($fields = [])
    {
        $this->fields = $fields;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param array $formOptionsArray
     */
    public function setFormOptionsArray($formOptionsArray)
    {
        $this->formOptionsArray = $formOptionsArray;
    }

    protected function defaultFormOptions(array $options)
    {
        if (!array_key_exists('id', $options)) {
            $options['id'] = 'DISABLE';
        }

        if (!array_key_exists('created', $options)) {
            $options['created'] = 'DISABLE';
        }

        if (!array_key_exists('modified', $options)) {
            $options['modified'] = 'DISABLE';
        }

        return $options;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->fields = $this->getFields($options['data']);
        $formOptions = $this->defaultFormOptions($this->formOptionsArray);

        foreach ($this->fields as $field) {
            $this->addFieldToFormBuilder($builder, $formOptions, $field);
        }
    }

    protected function addFieldToFormBuilder(FormBuilderInterface $builder, array $options, $field)
    {
        if (!array_key_exists($field['name'], $options)) {
            $builder->add($field['name']);

            return;
        }

        if ($options[$field['name']] === 'DISABLE') {
            return;
        }

        $settings = $options[$field['name']]['settings'];
        $fieldType = null;

        if (array_key_exists('fieldType', $options[$field['name']])) {
            $fieldType = $options[$field['name']]['fieldType'];
        }

        $builder->add($field['name'], $fieldType, $settings);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
        ));
    }

    protected function getFields($entity)
    {
        $reflection = new ReflectionService();

        $fields = [];
        $props = $reflection->getProperties($entity);

        foreach ($props as $prop) {
            $fields[$prop->getName()]['name'] = $prop->getName();
            $fields[$prop->getName()]['modifiers'] = $prop->getModifiers();
            $fields[$prop->getName()]['doc_comment'] = $prop->getDocComment();
        }

        return $fields;
    }

}