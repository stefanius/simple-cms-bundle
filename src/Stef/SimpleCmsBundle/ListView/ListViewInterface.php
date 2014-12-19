<?php

namespace Stef\SimpleCmsBundle\ListView;

interface ListViewInterface
{
    public function getListHeaders();

    public function getVisibleProperties();
}