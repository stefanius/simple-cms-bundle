<?php

namespace Stefanius\SimpleCmsBundle\ListView;

interface ListViewInterface
{
    public function getListHeaders();

    public function getVisibleProperties();
}