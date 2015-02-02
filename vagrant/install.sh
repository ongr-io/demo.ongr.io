#!/bin/bash

echo "                                                                                ";
echo "  ,ad8888ba,    888b      88    ,ad8888ba,   88888888ba        88               ";
echo " d8\"'    \`\"8b   8888b     88   d8\"'    \`\"8b  88      \"8b       \"\"               ";
echo "d8'        \`8b  88 \`8b    88  d8'            88      ,8P                        ";
echo "88          88  88  \`8b   88  88             88aaaaaa8P'       88   ,adPPYba,   ";
echo "88          88  88   \`8b  88  88      88888  88\"\"\"\"88'         88  a8\"     \"8a  ";
echo "Y8,        ,8P  88    \`8b 88  Y8,        88  88    \`8b         88  8b       d8  ";
echo " Y8a.    .a8P   88     \`8888   Y8a.    .a88  88     \`8b   888  88  \"8a,   ,a8\"  ";
echo "  \`\"Y8888Y\"'    88      \`888    \`\"Y88888P\"   88      \`8b  888  88   \`\"YbbdP\"'   ";
echo "                                                                                ";
echo "                                                                                ";

# Directory in which librarian-puppet should manage its modules directory
PUPPET_DIR=/etc/puppet/
if [[ ! -d "$PUPPET_DIR" ]]; then
    mkdir -p "$PUPPET_DIR"
    echo "Created directory ~/.puppet"
fi

cp -rf "/vagrant/vagrant/Puppetfile" "$PUPPET_DIR"
cp -rf "/vagrant/vagrant/Puppetfile.lock" "$PUPPET_DIR"

echo "Installing librarian-puppet modules..."
cd "$PUPPET_DIR" && librarian-puppet install --verbose > /dev/null
