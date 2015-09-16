# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.require_version ">= 1.6.5"
# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"
Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.network :private_network, ip: "192.168.60.10"
  config.ssh.forward_agent = true

  config.vm.hostname = "ongr.dev"
  config.hostsupdater.aliases = ["magento.ongr.dev", "oxid.ongr.dev"]

  config.vm.provider :virtualbox do |v|
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--memory", 2048]
    v.customize ["setextradata", :id, "--VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  end

  config.vm.synced_folder "./", "/var/www", type: "nfs", :mount_options => ['nolock,vers=3,udp,noatime']
  config.vm.provision "shell", path: "vagrant/install.sh"
  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "./vagrant/manifests"
    puppet.module_path    = "./vagrant/modules"
    puppet.facter = { "ssh_username" => "vagrant", "vhost" => config.vm.hostname }
    puppet.options = ["--verbose", "--debug", "--parser future"]
  end

  config.ssh.shell = "bash -l"
  config.ssh.keep_alive = true
  config.ssh.forward_agent = false
  config.ssh.forward_x11 = false
  config.vagrant.host = :detect
end
