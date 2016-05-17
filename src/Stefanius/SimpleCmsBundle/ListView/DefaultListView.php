<?php

namespace Stefanius\SimpleCmsBundle\ListView;

class DefaultListView extends AbstractListView
{
    protected function initProperties()
    {
        return [
            'title',
            'created',
            'modified'
        ];
    }

    protected function initHeaders()
    {
        return [
            'id' => 'ID',
            'title' => 'Titel',
            'created' => 'Aangemaakt',
            'modified' => 'Bewerkt'
        ];
    }

}