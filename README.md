# Demo app of the ONGR bundles

Demo app will show you how the ONGR bundles could be used in particular project. Depending on what you want:
- Just to see it in action - please do a _Very quick setup_. 
- Get a hands-on experience from development side - please proceed with a _Quick setup for development_.

**WARNING**: Please keep in mind, that the `master` branch is for development. And if you want to try a stable version - we recommend you to use a latest tagged version.

If you will need any help or have any questions, don't hesitate to ask on [![Join the chat at https://gitter.im/ongr-io/support](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/ongr-io/support?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge) chat, or just come to say Hi ;).

## Very quick setup

* Step 1: Install [Kitematic from Docker](https://kitematic.com).
* Step 2: Open [Kitematic from Docker](https://kitematic.com) and search for the `ongr/demo-presentation`. When you found it, press `CREATE`.
* Step 3: When this is finished, just click on the `Web Preview` link in the right side.

## Quick setup for the development

This example is based on [Symfony framework](https://github.com/symfony/symfony-standard) project by using ONGR bundles. 
So if you want to use ONGR bundles we assume that you know how to work with [Symfony](https://github.com/symfony/symfony) framework.

To run this demo you gonna need:
* PHP >=5.5
* Elasticsearch
* **Linux/Unix** based environment or **OS X**. WARNING: sorry, currently we do not support Microsoft Windows as a development environment, but this might change in the future. For now you could try it with a _Very quick setup_ guide.

If you already have your own development environment, you can go straight to the [Step 4](#step-4) to install assets and demo data.
    
In case you don't have an environment, we have a [Vagrant](https://www.vagrantup.com) box configuration in the [testing-vm repository](https://github.com/ongr-io/testing-vm).
  
### Step 1

Clone [testing-vm repository](https://github.com/ongr-io/testing-vm) to some folder, we call it `ongr`.

```bash
git clone https://github.com/ongr-io/testing-vm.git ongr
```

### Step 2

Provision your new box. At the first time it might take about 5-15 min (depending on your internet connection).

```bash
cd ongr
vagrant up
```

### Step 3

Clone ONGR Demo to `public` folder inside previously created `ongr` folder.

```bash
git clone https://github.com/ongr-io/Demo.git public

vagrant ssh
```

**WARNING**: Do not change `public` folder name, it's hardcoded vhost location in the [testing-vm](https://github.com/ongr-io/testing-vm)

### Step 4

Run project setup. There are bunch of commands to install vendors, assets and the demo data.

```bash
composer install --no-interaction
npm install
bower install
gulp
bin/console ongr:es:index:create
bin/console ongr:es:index:import app/Resources/data/demo.json
```

### Step 5

Navigate your browser to the http://ongr.dev

**NOTE**: Please make sure that your host definition in the `/etc/hosts` is correct. _ongr.dev_ is our host example from [testing-vm](https://github.com/ongr-io/testing-vm)
