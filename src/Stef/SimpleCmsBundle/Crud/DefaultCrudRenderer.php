<?php

namespace Stef\SimpleCmsBundle\Crud;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class DefaultCrudRenderer {

    /**
     * @var TwigEngine
     */
    protected $templating;

    /**
     * @var Router
     */
    protected $router;

    function __construct(TwigEngine $templating, Router $router)
    {
        $this->templating = $templating;
        $this->router = $router;
    }

    public function renderReadView(array $parameters = array())
    {
        return $this->render('StefSimpleCmsBundle:Cms:read.html.twig', $parameters);
    }

    public function renderUpdateView(array $parameters = array())
    {
        return $this->render('StefSimpleCmsBundle:Cms:update.html.twig', $parameters);
    }

    public function renderDeleteView($form)
    {
        // TODO: Implement renderDeleteView() method.
    }

    public function renderCreateView(array $parameters = array())
    {
        return $this->render('StefSimpleCmsBundle:Cms:create.html.twig', $parameters);
    }

    public function renderIndexView(array $parameters = array())
    {
        return $this->render('StefSimpleCmsBundle:Cms:index.html.twig', $parameters);
    }

    public function cmsRedirect($mappingKey)
    {
        return $this->redirect($this->generateUrl('stef_simple_cms_bundle_index', ['mappingKey' => $mappingKey]));
    }

    /* Methods below this line are copied (and modified if needed) from the Symfony Controller class. */

    /**
     * Renders a view.
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A response instance
     *
     * @return Response A Response instance
     */
    protected function render($view, array $parameters = array(), Response $response = null)
    {
        return $this->templating->renderResponse($view, $parameters, $response);
    }

    /**
     * Returns a RedirectResponse to the given URL.
     *
     * @param string  $url    The URL to redirect to
     *
     * @return RedirectResponse
     */
    protected  function redirect($url)
    {
        return new RedirectResponse($url, 302);
    }

    /**
     * Generates a URL from the given parameters.
     *
     * @param string         $route         The name of the route
     * @param mixed          $parameters    An array of parameters
     * @param bool|string    $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     */
    protected function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }
} 