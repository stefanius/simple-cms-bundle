<?php

namespace Stef\SimpleCmsBundle\ListView;

abstract class AbstractListView implements ListViewInterface
{
    protected $properties = [];

    protected $listHeaders = [];

    function __construct()
    {
        $this->initProperties();
        $this->initHeaders();
    }

    public function getVisibleProperties()
    {
        return $this->properties;
    }

    public function getListHeaders()
    {
        return $this->listHeaders;
    }

    abstract protected function initProperties();

    abstract protected function initHeaders();
}