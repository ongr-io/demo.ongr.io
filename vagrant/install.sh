#!/bin/bash

sudo apt-get update
sudo apt-get upgrade -y

if [ ! -x /usr/bin/git ]; then
    sudo apt-get -y install git
    sudo apt-get -y install ruby-dev
fi

if [ ! -x /usr/bin/librarian-puppet ]; then
    sudo gem install librarian-puppet --no-ri --no-rdoc
else
    sudo gem update librarian-puppet --no-ri --no-rdoc
fi

if [ -x /usr/local/bin/librarian-puppet ]; then
  cd /vagrant/vagrant/ && librarian-puppet install --verbose
fi

