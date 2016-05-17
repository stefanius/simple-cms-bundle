<?php

namespace Stef\SimpleCmsBundle\Controller;

use Stef\SimpleCmsBundle\BaseController\BaseController;

class IndexController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('StefSimpleCmsBundle::layout.base.html.twig', [
            'mappingKeys' => $this->getEntityMapper()->getMappingKeys()
        ]);
    }
}
