<?php

namespace Stef\SimpleCmsBundle\Manager;

use Doctrine\Entity;
use Stef\SimpleCmsBundle\Entity\Dictionary;
use Stef\SlugManipulation\Manipulators\SlugManipulator;
use Symfony\Component\HttpFoundation\ParameterBag;

class DictionaryManager extends AbstractObjectManager {

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