<?php

namespace Stef\SimpleCmsBundle\Form;


class FormOptions {

    protected $options = [];

    /**
     * @param string $entityName
     * @param string $fieldName
     * @param array $options
     * @param null $fieldType
     */
    public function addOptions($entityName, $fieldName, array $options, $fieldType = null)
    {
        $this->options[$entityName][$fieldName]['settings'] = $options;
        $this->options[$entityName][$fieldName]['fieldType'] = $fieldType;
    }

    /**
     * @param $entityName
     * @return array
     */
    public function getOptions($entityName)
    {
        if (array_key_exists($entityName, $this->options)) {
            return $this->options[$entityName];
        } else {
            return [];
        }
    }
} 