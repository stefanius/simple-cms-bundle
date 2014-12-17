<?php

namespace Stef\SimpleCmsBundle\Manager;

use Doctrine\Entity;
use Stef\SimpleCmsBundle\Entity\News;
use Stef\SlugManipulation\Manipulators\SlugManipulator;
use Symfony\Component\HttpFoundation\ParameterBag;

class NewsManager extends AbstractObjectManager {

    protected $repoName = 'StefSimpleCmsBundle:News';

    /**
     * @var SlugManipulator
     */
    protected $slugifier;

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