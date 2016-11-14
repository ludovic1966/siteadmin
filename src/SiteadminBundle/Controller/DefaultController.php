<?php

namespace SiteadminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteadminBundle:Default:index.html.twig');
    }
}
