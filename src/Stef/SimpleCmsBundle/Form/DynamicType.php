<?php

namespace Stef\SimpleCmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
        ));
    }
}