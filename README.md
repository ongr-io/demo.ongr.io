# Demo of ONGR bundles

This is the showcase of how can be used the ONGR bundles.

> WARNING: `master` branch is for development, if you want to try out a stable version we recommend to use a latest tagged version.

If you have any questions, don't hesitate to ask them on [![Join the chat at https://gitter.im/ongr-io/support](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/ongr-io/support?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
 chat, or just come to say Hi ;).

[![Latest Stable Version](https://poser.pugx.org/ongr-io/Demo/v/stable)](https://packagist.org/packages/ongr-io/Demo)
[![Total Downloads](https://poser.pugx.org/ongr-io/Demo/downloads)](https://packagist.org/packages/ongr-io/Demo)
[![Latest Unstable Version](https://poser.pugx.org/ongr-io/Demo/v/unstable)](https://packagist.org/packages/ongr-io/Demo)
[![License](https://poser.pugx.org/ongr-io/Demo/license)](https://packagist.org/packages/ongr-io/Demo)


## Quick setup

This is nothing more than usual [Symfony](https://github.com/symfony/symfony-standard) project. 
So if you want to use ONGR bundles we assume that you know how to work with [Symfony](https://github.com/symfony/symfony) framework.

To run this demo you gonna need:
* PHP >=5.5
* Elasticsearch
    
In case you don't have an environment we have a [Vagrant](https://www.vagrantup.com) box configuration in the [testing-vm repository](https://github.com/ongr-io/testing-vm).

> We do not support Microsoft Windows as a development environment. This might change in the future but for now you either need **Linux/Unix** based environment or **OS X**.
  
### Step 1

Clone [testing-vm repository](https://github.com/ongr-io/testing-vm) to some folder, we call it `ongr`.

```bash
git clone https://github.com/ongr-io/testing-vm.git ongr
```

### Step 2

Provision your new box. 

> First time it will take about 5-15 min (depending on your internet connection).

```bash
cd ongr
vagrant up
```

### Step 3

Clone ONGR Demo to `public` folder inside previously created `ongr` folder.

```bash
git clone https://github.com/ongr-io/Demo.git public
```

> WARNING: Do not change `public` folder name. It's hardcoded vhost location in the [testing-vm](https://github.com/ongr-io/testing-vm)

### Step 4

Run project setup. There are bunch of commands to install vendors, assets and the demo data.

```bash
vagrant ssh
composer install -n
npm install
bower install
gulp
app/console ongr:es:index:create
app/console ongr:es:index:import --raw src/ONGR/DemoBundle/Resources/data/ongr.json
```

> If composer prompts input questions just press enter.

### Step 5

Navigate your browser to http://ongr.dev
