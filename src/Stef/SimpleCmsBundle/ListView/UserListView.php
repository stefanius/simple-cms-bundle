<?php

namespace Stef\SimpleCmsBundle\ListView;

class UserListView extends AbstractListView
{
    protected function initProperties()
    {
        return [
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