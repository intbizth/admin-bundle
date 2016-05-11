<?php

namespace Intbizth\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController
{
    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @param EngineInterface $templatingEngine
     */
    public function __construct(EngineInterface $templatingEngine)
    {
        $this->templatingEngine = $templatingEngine;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->templatingEngine->renderResponse('admin:Dashboard:index.html.twig');
    }
}
