<?php

namespace Stefanius\SimpleCmsBundle\Reflection;

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
        $props = $this->reflect($object)->getProperties();

        $filteredProps = [];

        foreach ($props as $prop) {
            if ($this->reflect($object)->hasMethod('get' . $prop->getName())) {
                $filteredProps[] = $prop;
            }  elseif($this->reflect($object)->hasMethod('is' . $prop->getName())) {
                $filteredProps[] = $prop;
            }
        }

        return $filteredProps;
    }
} 