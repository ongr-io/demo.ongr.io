<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\DemoBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * Exception listener.
 *
 * @package ONGR\DemoBundle\EventListener
 */
class ExceptionListener
{
    /**
     * Handles exceptions.
     *
     * @param GetResponseForExceptionEvent $event
     *
     * @throws NotFoundHttpException
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // Get exception object from the received event.
        $exception = $event->getException();

        // HttpKernel::handleException() sends 500 Internal Server error, when vendor's library returns an exception.
        // Handle requests having non 404 status code.
        if ($exception->getCode() !== 404 || !$exception instanceof HttpExceptionInterface) {
            throw new NotFoundHttpException('Something is missing');
        }
    }
}
