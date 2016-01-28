<?php

namespace AppBundle\Controller;

use AppBundle\Document\Content;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContentController extends Controller
{
    public function showAction(Content $document)
    {
        return $this->render(
            'content/show.html.twig',
            [
                'content' => $document,
            ]
        );
    }
}
