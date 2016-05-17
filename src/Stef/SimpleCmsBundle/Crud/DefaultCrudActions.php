<?php

namespace Stef\SimpleCmsBundle\Crud;

use Stef\SimpleCmsBundle\EntityMapper\Mapper;
use Stef\SimpleCmsBundle\EntityMapper\Mapping;
use Stef\SimpleCmsBundle\Form\FormFactory;
use Stef\SimpleCmsBundle\Form\FormOptions;
use Stef\SimpleCmsBundle\ListView\ListViewService;
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

    /**
     * @var ListViewService
     */
    protected $listViewService;

    /**
     * DefaultCrudActions constructor.
     *
     * @param Mapper $mapper
     * @param DefaultCrudRenderer $crudRenderer
     * @param FormOptions $formOptions
     * @param FormFactory $formFactory
     * @param ListViewService $listViewService
     */
    function __construct(Mapper $mapper, DefaultCrudRenderer $crudRenderer, FormOptions $formOptions, FormFactory $formFactory, ListViewService $listViewService)
    {
        $this->mapper = $mapper;
        $this->crudRenderer = $crudRenderer;
        $this->formOptions = $formOptions;
        $this->formFactory = $formFactory;
        $this->listViewService = $listViewService;
    }

    /**
     * @param $entityClassName
     *
     * @return mixed
     */
    protected function createEntity($entityClassName)
    {
        return new $entityClassName();
    }

    /**
     * @param Request $request
     * @param Mapping $mapping
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param Request $request
     * @param Mapping $mapping
     * @param ReflectionService $reflection
     * @param $search
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param Request $request
     * @param Mapping $mapping
     * @param $repository
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param Request $request
     * @param Mapping $mapping
     * @param $repository
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Request $request, Mapping $mapping, $repository, $id)
    {
        $entity = $repository->findOneById($id);

        $mapping->getManager()->removeAndFlush($entity);

        return $this->crudRenderer->cmsRedirect($mapping->getMappingKey());
    }

    /**
     * @param $mappingKey
     * @param $entities
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($mappingKey, $entities)
    {
        return $this->crudRenderer->renderIndexView([
            'entities' => $entities,
            'mappingKey' => $mappingKey,
            'mappingKeys' => $this->mapper->getMappingKeys(),
            'listView' => $this->listViewService->getView($mappingKey)
        ]);
    }
}
