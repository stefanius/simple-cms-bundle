<?php

namespace Stefanius\SimpleCmsBundle\Controller;

use Stefanius\SimpleCmsBundle\BaseController\BaseController;

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
