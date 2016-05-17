<?php

namespace Stef\SimpleCmsBundle\EntityMapper;

use Stef\SimpleCmsBundle\Manager\AbstractObjectManager;
use Symfony\Component\HttpFoundation\ParameterBag;

class Mapper 
{
    /**
     * @var ParameterBag
     */
    protected $mappings;

    /**
     * Mapper constructor.
     */
    function __construct()
    {
        $this->mappings = new ParameterBag();
    }

    /**
     * @return ParameterBag
     */
    public function getMappings()
    {
        return $this->mappings;
    }

    /**
     * @param $mappingKey
     *
     * @return Mapping
     */
    public function getMapping($mappingKey)
    {
        return $this->mappings->get($mappingKey);
    }

    /**
     * @param $className
     * @param $shortBundleName
     * @param $namespace
     * @param AbstractObjectManager $manager
     * @param string $formTypeClassName
     */
    public function addNewMapping($className, $shortBundleName, $namespace, AbstractObjectManager $manager, $formTypeClassName = 'Stef\SimpleCmsBundle\Form\DynamicType')
    {
        $key = strtolower($className);
        $mapping = new Mapping($key, $className, $shortBundleName, $namespace, $manager, $formTypeClassName);

        $this->mappings->set($key, $mapping);
    }

    /**
     * @return array
     */
    public function getMappingKeys()
    {
        return $this->mappings->keys();
    }
}
