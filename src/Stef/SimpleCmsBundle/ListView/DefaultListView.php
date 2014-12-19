<?php

namespace Stef\SimpleCmsBundle\ListView;

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
            'slug' => 'Slug',
            'created' => 'Aangemaakt',
            'modified' => 'Bewerkt'
        ];
    }

}