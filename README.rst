=========
ONGR Demo
=========
ONGR is a platform based on Symfony 2 framework which stands in front of your application and withstands high load of concurrent users.

It is a separate system from your original application where you re-implement or move view and frontend related code to ONGR for high-performance content delivery. Product and other data is still managed by original backend and then continuously synchronized with new platform for cache and display.

If you find some issues or great ideas how to improve the project, please create an issue in GitHub. Also everyone are more than welcome to contribute using pull requests. More information is in `contributing page </Resources/doc/contributing.rst>`_.


Intro
-----

- `Quick start </src/ONGR/DemoBundle/Resources/doc/quick_start.rst>`_
- `Contributing </src/ONGR/DemoBundle/Resources/doc//contributing.rst>`_


ONGR Components
---------------

ONGR uses and provides full support for `Elasticsearch Bundle <https://github.com/ongr-io/ElasticsearchBundle>`_.

- `Router Bundle <https://github.com/ongr-io/ElasticsearchBundle>`_
- `Content bundle <https://github.com/ongr-io/ContentBundle>`_
- `Filter manager <https://github.com/ongr-io/FilterManagerBundle>`_

   More are coming.. ;)
