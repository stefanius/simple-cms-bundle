<?php

namespace Stef\SimpleCmsBundle\ListView;

class ListViewService
{
    protected $listViews = [];

    /**
     * @param string $key
     * @param ListViewInterface $listView
     */
    public function addView($key, ListViewInterface $listView)
    {
        $this->listViews[$key] = $listView;
    }

    /**
     * @param $key
     *
     * @return ListViewInterface
     */
    public function getView($key)
    {
        if (array_key_exists($key, $this->listViews)) {
            return $this->listViews[$key];
        }

        return $this->listViews['default'];
    }
}