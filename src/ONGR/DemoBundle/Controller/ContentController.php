<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\DemoBundle\Controller;

use ONGR\ElasticsearchBundle\Document\DocumentInterface;
use ONGR\ContentBundle\Service\ContentService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Manages content for home and info pages.
 */
class ContentController extends Controller
{
    /**
     * App index page controller.
     *
     * @return Response
     */
    public function homePageAction()
    {
        return $this->render(
            'ONGRDemoBundle::home.html.twig',
            []
        );
    }

    /**
     * Renders a document.
     *
     * @param DocumentInterface $document
     *
     * @return Response
     */
    public function documentAction($document)
    {
        return $this->render(
            'ONGRDemoBundle:Content:page.html.twig',
            $this->documentActionData($document)
        );
    }

    /**
     * Returns template data for documentAction.
     *
     * @param DocumentInterface $document
     *
     * @return array
     */
    protected function documentActionData($document)
    {
        return [
            'content' => $document,
        ];
    }

    /**
     * App page controller.
     *
     * Show page by slug identifier
     *
     * @param string $slug Page content identifier.
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function pageAction($slug)
    {
        /** @var ContentService $service */
        $service = $this->get('ongr_content.content_service');

        $document = $service->getDocumentBySlug($slug);

        if (null === $document) {
            throw $this->createNotFoundException('The content page does not exists');
        }

        return $this->documentAction($document);
    }

    /**
     * Returns template data for snippetAction.
     *
     * @param string $slug
     *
     * @return array
     */
    protected function snippetActionData($slug)
    {
        return $this->get('ongr_content.content_service')->getDataForSnippet($slug);
    }

    /**
     * Render cms body in template.
     *
     * @param string $slug
     * @param string $template
     *
     * @return Response
     */
    public function snippetAction($slug, $template)
    {
        return $this->render(
            $template,
            $this->snippetActionData($slug)
        );
    }
}
