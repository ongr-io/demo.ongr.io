===========
Quick start
===========

Let's get started. We'll guide you step by step through installing and running ONGR for the first time. The first installation should not take more than 1 hour.

Step 1: Requirements.
---------------------

- Your machine has to be powerful enough to run ``Vagrant`` and ``Puppet``.
- Linux/Unix or OS X based environment.
- For Linux environment you might need to enable virtualization support in your BIOS (`more info <http://askubuntu.com/a/256853>`_).
- For OS X environment you will need command line tools aka XCode.

We do not support Microsoft Windows as a development environment.
This might change in the future but for now you either need Linux/Unix based environment or OS X.

Step 2: Install Virtual Box
---------------------------

Either install or upgrade `virtualbox <https://www.virtualbox.org/wiki/Downloads>`_. We need VirtualBox > 4.3

Step 3: Install Vagrant
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

Step 4: Download ONGR
---------------------

To download all ONGR sandbox files, clone this repository with the following command:

.. code-block:: bash

    git clone --recursive https://github.com/ongr-io/ongr-sandbox.git

..

Step 5: Start the virtual machine using Vagrant
-------------------------------------------

Let's rock. Move into your vagrant folder:

.. code-block:: bash

	cd ongr-sandbox/vagrant

..

and execute:

.. code-block:: bash

    vagrant up

..

.. note:: Currently only the Virtualbox provider is supported. 

That's it. The ONGR is alive.

If you experience any problems (e.g. vagrant tends to change the rules with each update and we might lag a bit) please
do not hesitate to `contact us <http://ongr.io/contact-us/>`_. We'll help.

Now, let's feed the donkey with some data.

Step 6: Install the demo data
-----------------------------

In order to get demo content you need to run the following commands from the command line:

.. code-block:: bash

    vagrant ssh
    composer install -n
    app/console assetic:dump
    app/console ongr:es:index:create
    app/console ongr:es:type:update --force
    app/console ongr:es:index:import --raw src/ONGR/DemoBundle/Resources/data/categories.json
    app/console ongr:es:index:import --raw src/ONGR/DemoBundle/Resources/data/products.json
    app/console ongr:es:index:import --raw src/ONGR/DemoBundle/Resources/data/contents.json

..

   If composer prompts input questions just press enter.

Step 7: Open your browser
-------------------------

Navigate your browser to `http://ongr.dev <http://ongr.dev/>`_
