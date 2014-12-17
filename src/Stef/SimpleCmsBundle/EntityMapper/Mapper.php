<?php

namespace Stef\SimpleCmsBundle\EntityMapper;

use Stef\SimpleCmsBundle\Manager\AbstractObjectManager;
use Symfony\Component\HttpFoundation\ParameterBag;

class Mapper {

    /**
     * @var ParameterBag
     */
    protected $mappings;

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
     * @return Mapping
     */
    public function getMapping($mappingKey)
    {
        return $this->mappings->get($mappingKey);
    }

    public function addNewMapping($className, $shortBundleName, $namespace, AbstractObjectManager $manager)
    {
        $key = strtolower($className);
        $mapping = new Mapping($key, $className, $shortBundleName, $namespace, $manager);

        $this->mappings->set($key, $mapping);
    }

    public function getMappingKeys()
    {
        return $this->mappings->keys();
    }
} 