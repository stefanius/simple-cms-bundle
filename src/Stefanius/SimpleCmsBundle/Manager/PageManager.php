<?php

namespace Stefanius\SimpleCmsBundle\Manager;

use Doctrine\Entity;
use Stefanius\SimpleCmsBundle\Entity\News;
use Stefanius\Slugifier\Manipulators\SlugManipulator;
use Symfony\Component\HttpFoundation\ParameterBag;

class PageManager extends AbstractObjectManager
{
    /**
     * @var SlugManipulator
     */
    protected $slugifier;

    protected $repoName = 'StefSimpleCmsBundle:Page';

    /**
     * @param SlugManipulator $slugifier
     */
    public function setSlugifier(SlugManipulator $slugifier)
    {
        $this->slugifier = $slugifier;
    }

    /**
     * @param ParameterBag $data
     *
     * @return Entity
     */
    public function create(ParameterBag $data)
    {
        $news = new News();

        $news->setTitle($data->get('title'));
        $news->setBody($data->get('body'));
        $news->setPicture($data->get('picture'));
        $news->setSlug($this->slugifier->manipulate($news->getTitle() . '-' . rand(100 , 999)));

        return $news;
    }

    /**
     * @param $entity
     */
    public function persist($entity)
    {
        if (is_null($entity->getSlug()) || empty($entity->getSlug())) {
            $entity->setSlug($this->slugifier->manipulate($entity->getTitle() . '-' . rand(100 , 999)));
        }

        parent::persist($entity);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function read($key)
    {
        $entity = parent::read($key);

        if ($entity === null) {
            $entity = $this->om->getRepository($this->repoName)->findOneBySlug($key);
        }

        return $entity;
    }
}
