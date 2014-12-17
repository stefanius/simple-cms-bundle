<?php

namespace Stef\SimpleCmsBundle\Reflection;

class ReflectionService
{
    /**
     * @param $object
     * @return \ReflectionClass
     */
    public function reflect($object)
    {
        return new \ReflectionClass($object);
    }

    /**
     * @param $object
     * @return \ReflectionProperty[]
     */
    public function getProperties($object)
    {
        return $this->reflect($object)->getProperties();
    }
} 