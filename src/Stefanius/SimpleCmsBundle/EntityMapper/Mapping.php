<?php

namespace Stefanius\SimpleCmsBundle\EntityMapper;

use Stefanius\SimpleCmsBundle\Manager\AbstractObjectManager;

class Mapping
{
    /**
     * i.e. 'News'
     *
     * @var string
     */
    protected $className;

    /**
     * i.e. Stefanius/SimpleCmsBundle/Entity
     *
     * @var string
     */
    protected $namespace;

    /**
     * i.e. Stefanius/SimpleCmsBundle/Entity/News
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

    /**
     * @var string
     */
    protected $formTypeClassName;

    function __construct($mappingKey, $className, $shortBundle, $namespace, AbstractObjectManager $manager, $formTypeClassName = 'Stefanius\SimpleCmsBundle\Form\DynamicType')
    {
        $this->className = trim($className, '\\');
        $this->shortBundle = $shortBundle;
        $this->namespace = trim($namespace, '\\');
        $this->manager = $manager;
        $this->mappingKey = $mappingKey;
        $this->formTypeClassName = $formTypeClassName;

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

    /**
     * @return string
     */
    public function getFormTypeClassName()
    {
        return $this->formTypeClassName;
    }
}
