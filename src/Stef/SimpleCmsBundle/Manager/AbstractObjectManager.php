<?php

namespace Stef\SimpleCmsBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Entity;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractObjectManager {

    /**
     * @var ObjectManager
     */
    protected $om;

    protected $repoName = null;

    /**
     * @param ObjectManager $om
     */
    function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * @param $entity
     */
    public function persist($entity) {
        $this->om->persist($entity);
    }

    /**
     * @param $entity
     */
    public function remove($entity) {
        $this->om->remove($entity);
    }

    public function flush() {
        $this->om->flush();
    }

    /**
     * @param $entity
     */
    public function persistAndFlush($entity) {
        $this->persist($entity);
        $this->flush();
    }

    /**
     * @param $entity
     */
    public function removeAndFlush($entity) {
        $this->remove($entity);
        $this->flush();
    }

    /**
     * Create, store (persist in database) return an Enity
     *
     * @param ParameterBag $data
     *
     * @return Entity
     */
    public function createAndStore(ParameterBag $data) {
        $entity = $this->create($data);
        $this->persistAndFlush($entity);

        return $entity;
    }

    /**
     * Create and return an Enity
     *
     * @param ParameterBag $data
     *
     * @return Entity
     */
    abstract public function create (ParameterBag $data);

    /**
     * @param $key
     * @return mixed
     */
    public function read($key)
    {
        $entity = $this->om->getRepository($this->repoName)->findOneById($key);

        return $entity;
    }

    public function getLatestEntries($maxResults)
    {
        $qb = $this->om->getRepository($this->repoName)->createQueryBuilder('e');

        $qb->select('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults($maxResults);

        return $qb->getQuery()->getResult();
    }

    public function getAllRecords()
    {
        $qb = $this->om->getRepository($this->repoName)->createQueryBuilder('e');

        $qb->select('e');

        return $qb->getQuery()->getResult();
    }

    public function simpleQueryBuilding(array $params)
    {
        $qb = $this->om->getRepository($this->repoName)->createQueryBuilder('e');

        $qb->select('e');

        if (array_key_exists('where', $params)) {
            $qb->where($params['where']);
        }

        if (array_key_exists('param', $params)) {
            $qb->setParameter($params['param'][0], $params['param'][1]);
        }

        if (array_key_exists('orderby', $params)) {
            $qb->orderBy($params['orderby']);
        }

        return $qb->getQuery()->getResult();
    }
}