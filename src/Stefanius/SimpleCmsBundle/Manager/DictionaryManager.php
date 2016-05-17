<?php

namespace Stefanius\SimpleCmsBundle\Manager;

use Doctrine\Entity;
use Stefanius\SimpleCmsBundle\Entity\Dictionary;
use Stefanius\Slugifier\Manipulators\SlugManipulator;
use Symfony\Component\HttpFoundation\ParameterBag;

class DictionaryManager extends AbstractObjectManager
{
    protected $repoName = 'StefSimpleCmsBundle:Dictionary';

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
        $dictionary = new Dictionary();

        $dictionary->setTitle($data->get('title'));
        $dictionary->setBody($data->get('body'));
        $dictionary->setSlug($this->slugifier->manipulate($dictionary->getTitle()));

        return $dictionary;
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
     * 
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