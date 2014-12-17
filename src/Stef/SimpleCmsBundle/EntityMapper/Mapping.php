<?php

namespace Stef\SimpleCmsBundle\EntityMapper;


use Stef\SimpleCmsBundle\Manager\AbstractObjectManager;

class Mapping {

    /**
     * i.e. 'News'
     *
     * @var string
     */
    protected $className;

    /**
     * i.e. Stef/SimpleCmsBundle/Entity
     *
     * @var string
     */
    protected $namespace;

    /**
     * i.e. Stef/SimpleCmsBundle/Entity/News
     *
     * @var string
     */
    protected $fullClassName;

    /**
     * i.e. StefSimpleCmsBundle
     *
     * @var string
     */
    protected $shortBundle;

    /**
     * i.e. StefSimpleCmsBundle:News
     *
     * @var string
     */
    protected $repoSelector;

    /**
     * @var AbstractObjectManager
     */
    protected $manager;

    /**
     * @var string
     */
    protected $mappingKey;

    function __construct($mappingKey, $className, $shortBundle, $namespace, AbstractObjectManager $manager)
    {
        $this->className = trim($className, '\\');
        $this->shortBundle = $shortBundle;
        $this->namespace = trim($namespace, '\\');
        $this->manager = $manager;
        $this->mappingKey = $mappingKey;

        $this->fullClassName = $this->namespace . '\\' . $this->className;
        $this->repoSelector = $this->shortBundle . ':' . $this->className;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getFullClassName()
    {
        return $this->fullClassName;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getRepoSelector()
    {
        return $this->repoSelector;
    }

    /**
     * @return string
     */
    public function getShortBundle()
    {
        return $this->shortBundle;
    }

    /**
     * @return AbstractObjectManager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @return string
     */
    public function getMappingKey()
    {
        return $this->mappingKey;
    }
} 