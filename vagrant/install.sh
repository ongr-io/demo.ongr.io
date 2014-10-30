#!/bin/bash
# Directory in which librarian-puppet should manage its modules directory
PUPPET_DIR=/etc/puppet/
if [[ ! -d "$PUPPET_DIR" ]]; then
    mkdir -p "$PUPPET_DIR"
    echo "Created directory ~/.puppet"
fi

cp -rf "/vagrant/vagrant/Puppetfile" "$PUPPET_DIR"
cp -rf "/vagrant/vagrant/Puppetfile.lock" "$PUPPET_DIR"

cd "$PUPPET_DIR" && librarian-puppet install --verbose
