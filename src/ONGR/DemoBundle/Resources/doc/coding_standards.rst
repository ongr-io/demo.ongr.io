================
Coding Standards
================


Introduction
------------

ONGR development follows `TDD <http://en.wikipedia.org/wiki/Test-driven_development>`_ methodology, so it's required that all code is covered with automated tests.

ONGR uses PSR-2 and `Symfony coding standards <http://symfony.com/doc/current/contributing/code/standards.html>`_ with `Symfony conventions <http://symfony.com/doc/current/contributing/code/conventions.html>`_. In addition, there are other rules we agreed on (listed below).

To check code quality for our requirements we prepared the rule set for `Code Sniffer <https://github.com/squizlabs/PHP_CodeSniffer>`_ available `here <https://github.com/ongr-io/ongr-strict-standard>`_.


Example
-------

This code example displays many of the standard's features:

.. code-block:: php

    /*
    * This file is part of the ONGR package.
    *
    * (c) NFQ <info@nfq.com>
    *
    * For the full copyright and license information, please view the LICENSE
    * file that was distributed with this source code.
    */

    namespace ONGR\FooBundle;

    use ONGR\WhateverBundle\WhateverUtility;

    namespace Acme;

    /**
    * Coding standards demonstration.
    */
    class FooBar
    {
        const SOME_CONST = 42;

        /**
         * @var FooService
         */
        private $fooBar;

        /**
         * @param string $dummy Some argument description.
         */
        public function __construct($dummy)
        {
            $this->fooBar = $this->transformText($dummy);
        }

        /**
         * Transform text in a magic way.
         *
         * @param string $dummy   Some argument description.
         * @param array  $options Optional options.
         *
         * @return string|null Transformed input.
         * @throws \RuntimeException
         */
        private function transformText($dummy, array $options = [])
        {
            $mergedOptions = array_merge(
                [
                    'some_default' => 'values',
                    'another_default' => 'more values',
                ],
                $options
            );

            if (true === $dummy) {
                return;
            }

            if ('string' === $dummy) {
                if ('values' === $mergedOptions['some_default']) {
                    return substr($dummy, 0, 5);
                }

                return ucwords($dummy);
            }

            throw new \RuntimeException(sprintf('Unrecognized dummy option "%s"', $dummy));
        }
    }

..

   Note: Don't forget to leave single empty line before license header, namespace, uses and class comment block. All uses should be listed in alphabetical order without empty lines.

Tickets and releases
--------------------

Task has been completed, if:

1. Feature is implemented.
2. New functionality is covered with automated tests.
3. Feature has been documented in documentation repository.

Release:

1. Every release must have some valuable description or list of changes (links to wiki are recommended).
2. Every commit message should contain short description of what was done in it.

   i. No need to include feature suffix. PR's are used for grouping commits into features.
   ii. It's not recommended to mention issue number (e.g. Fixed price handling, closes #123). Better to link commit hash in the issue. Otherwise, it's hard to change wrong issue number in the commit.

Documenting code
----------------

1. Use ``{@inheritDoc}`` when extending abstract methods or implementing interfaces instead of rewriting anything.
2. If method does not return any result, ``@return`` annotation must be omitted.
3. Comments must (1) start with capital letter, (2) have a single space between comment symbols and first letter and (3) must NOT include period at the end of the comment if it is one sentence. E. g. ``// This is a short comment``

4. PHPDoc comments must have single empty lines between and after ``@param`` tags block. ``@throws`` goes after and together with ``@return``. E.g.

.. code-block:: php

    /**
     * Relocates resources to memory.
     *
     * @param bool $force Force relocation.
     * @param int  $count Number of retries.
     *
     * @return int
     * @throws \Exception
     */

..

Structure
---------

1. When method ``foo`` calls methods ``bar`` and ``baz``, they should be organized in the following order in the same class: first ``foo``, then ``bar`` and ``baz`` (not ``bar``, ``baz``, ``foo``). This is because a developer is usually reading the code top-down, not bottom-up. Therefore, ``@dataProvider`` case provider should go above it's test.

Testing
-------

1. Unit tests are distributed into two types: Functional and Integration.
2. Functional tests naming and namespaces must mirror bundle structure.
3. Integration tests should be named by tested functionality. It's recommended to group integration tests into namespaces of similar functionality.

Misc.
-----

1. ONGR license header must be used for every PHP file on ONGR bundles.
2. Short array syntax should be used in PHP code.
3. Imagine class has a setter for whatever property and this property is used on other method. Then, ``\LogicException`` must be thrown if we are trying to call method with no value set (except cases when method actually can work without property value).
4. When using PSR-3 logger in a class, you must implement ``LoggerAwareInterface`` and use ``LoggerAwareTrait``.
5. When using service as a symfony container aware trait, you must use ``ContainerAwareTrait``.
6. Try to avoid using very strict dependencies such as (2.3.*). We should always stick to latest minor release (like ~2.3)

