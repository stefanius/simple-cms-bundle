<?php

namespace Stef\SimpleCmsBundle\Crud;

use Stef\SimpleCmsBundle\EntityMapper\Mapper;
use Stef\SimpleCmsBundle\EntityMapper\Mapping;
use Stef\SimpleCmsBundle\Form\FormFactory;
use Stef\SimpleCmsBundle\Form\FormOptions;
use Stef\SimpleCmsBundle\Reflection\ReflectionService;
use Symfony\Component\HttpFoundation\Request;

class DefaultCrudActions
{
    /**
     * @var FormOptions
     */
    protected $formOptions;

    /**
     * @var DefaultCrudRenderer
     */
    protected $crudRenderer;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var Mapper
     */
    protected $mapper;

    function __construct(Mapper $mapper, DefaultCrudRenderer $crudRenderer, FormOptions $formOptions, FormFactory $formFactory)
    {
        $this->mapper = $mapper;
        $this->crudRenderer = $crudRenderer;
        $this->formOptions = $formOptions;
        $this->formFactory = $formFactory;
    }

    /**
     * @param $entityClassName
     * @return mixed
     */
    protected function createEntity($entityClassName)
    {
        return new $entityClassName();
    }

    public function create(Request $request, Mapping $mapping)
    {
        $entity = $this->createEntity($mapping->getFullClassName());
        $form = $this->formFactory->buildDynamicFormType($entity, $this->formOptions->getOptions($mapping->getMappingKey()));

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $mapping->getManager()->persistAndFlush($entity);

                return $this->crudRenderer->cmsRedirect($mapping->getMappingKey());
            }
        }

        return $this->crudRenderer->renderCreateView([
            'form' => $form->createView(),
            'mappingKey' => $mapping->getMappingKey(),
            'mappingKeys' => $this->mapper->getMappingKeys()
        ]);
    }

    public function read(Request $request, Mapping $mapping, ReflectionService $reflection, $search)
    {
        $entity = $mapping->getManager()->read($search);
        $reflected = $reflection->getProperties($entity);

        return $this->crudRenderer->renderReadView([
            'entity' => $entity,
            'reflected' => $reflected,
            'mappingKey' => $mapping->getMappingKey(),
            'mappingKeys' => $this->mapper->getMappingKeys()
        ]);
    }

    public function update(Request $request, Mapping $mapping, $repository, $id)
    {
        $entity = $repository->findOneById($id);

        $form = $this->formFactory->buildDynamicFormType($entity, $this->formOptions->getOptions($mapping->getMappingKey()));

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $entity->setId($id);
                $mapping->getManager()->flush();

                return $this->crudRenderer->cmsRedirect($mapping->getMappingKey());
            }
        }

        return $this->crudRenderer->renderUpdateView([
            'form' => $form->createView(),
            'mappingKey' => $mapping->getMappingKey(),
            'mappingKeys' => $this->mapper->getMappingKeys(),
            'entity' => $entity
        ]);
    }

    public function delete(Request $request, Mapping $mapping, $repository, $id)
    {
        $entity = $repository->findOneById($id);

        $mapping->getManager()->removeAndFlush($entity);

        return $this->crudRenderer->cmsRedirect($mapping->getMappingKey());
    }

    public function index($mappingKey, $entities)
    {
        return $this->crudRenderer->renderIndexView([
            'entities' => $entities,
            'mappingKey' => $mappingKey,
            'mappingKeys' => $this->mapper->getMappingKeys()
        ]);
    }
} 