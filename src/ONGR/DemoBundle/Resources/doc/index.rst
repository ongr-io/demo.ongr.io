===========
Quick start
===========

Let's get started. We'll guide you step by step through installing and running ONGR the first time. The first installation should not need more than 1 hour.

Step 1: Requirements.
---------------------

- Your machine has to be powerful enough to run ``Vagrant`` and ``Puppet``.
- Linux/Unix or OS X based environment.
- For Linux environment you might need to enable virtualization support in your BIOS (`more info <http://askubuntu.com/a/256853>`_).
- For OS X environment you will need command line tools aka XCode.

We do not support Microsoft Windows as a development environment.
This might change in the future but for now you either need Linux/Unix based environment or OS X.

Step 2: Download ONGR
---------------------

You can download the latest release using `composer <https://getcomposer.org/download>`_ by typing:

.. code-block:: bash

    composer create-project ongr/ongr-sandbox --no-interaction

..

Or you can download it from the `archive <https://github.com/ongr-io/ongr-sandbox/releases>`_ and unpack it somewhere under your project directory. Make sure that we have the "Vagrantfile" in the your project root folder.

Step 3: Install Virtual Box
---------------------------

Either install or upgrade `virtualbox <https://www.virtualbox.org/wiki/Downloads>`_. We need VirtualBox > 4.3

Step 4: Install Vagrant
-----------------------

Either install or upgrade `vagrant <https://www.vagrantup.com/downloads.html>`_. We need Vagrant >= 1.6.5

(optional) Now we need to install the hosts updater vagrant plugin.

.. code-block:: bash

    vagrant plugin install vagrant-hostsupdater

..

   It will help to automatically update /etc/hosts file via adding your new ongr.dev host with correct IP.

And finally - ONLY_FOR_LINUX you need to install the nfs server:

.. code-block:: bash

    sudo apt-get install nfs-kernel-server

..

Step 5: Start virtual machine using Vagrant
-------------------------------------------

Let's rock. Move into your project root folder and execute:

.. code-block:: bash

    vagrant up

..

.. note:: Currently we have only Virtualbox provider support. We are working on others and soon should be docker provider ready to use.

That's it. The ONGR is alive.

If you experience any problems (e.g. vagrant tends to change the rules with each update and we might lag a bit) please
do not hesitate to `contact us <http://ongr.io/contact-us/>`_. We'll help.

Now, let's feed the donkey with some data.

Step 6: Install the demo data
-----------------------------

In case to get demo content you need to run the following commands from command line:

.. code-block:: bash

    vagrant ssh
    composer install --no-interaction
    app/console es:index:create
    app/console es:type:update --force
    app/console es:index:import --raw src/ONGR/DemoBundle/Resources/data/categories.json 
    app/console es:index:import --raw src/ONGR/DemoBundle/Resources/data/products.json 
    app/console es:index:import --raw src/ONGR/DemoBundle/Resources/data/contents.json 

..

   If composer prompts input questions just press enter.

.. note:: Command "composer install --no-interaction" is not necessary if you downloaded project using composer.

Step 7: Open your browser
-------------------------

Navigate your browser to `http://ongr.dev <http://ongr.dev/>`_
