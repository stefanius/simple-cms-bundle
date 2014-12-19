<?php

namespace Stef\SimpleCmsBundle\ListView;

class NewsListView extends AbstractListView
{
    protected function initProperties()
    {
        return [
            'id',
            'title',
            'slug',
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