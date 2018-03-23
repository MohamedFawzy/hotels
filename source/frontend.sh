#!/usr/bin/env bash
# update and install all required packages (no sudo required as root)
# https://gist.github.com/isaacs/579814#file-only-git-all-the-way-sh
apt-get update -yq && apt-get upgrade -yq && \
apt-get install -yq g++ libssl-dev apache2-utils curl git python make nano

# setting up npm for global installation without sudo
# http://stackoverflow.com/a/19379795/580268
MODULES="local" && \
echo prefix = ~/$MODULES >> ~/.npmrc && \
echo "export PATH=\$HOME/$MODULES/bin:\$PATH" >> ~/.bashrc && \
. ~/.bashrc && \
mkdir ~/$MODULES

# install Node.js and npm
# https://gist.github.com/isaacs/579814#file-node-and-npm-in-30-seconds-sh
mkdir ~/node-latest-install && cd $_ && \
curl http://nodejs.org/dist/node-latest.tar.gz | tar xz --strip-components=1 && \
./configure --prefix=~/$MODULES && \
make install && \ # takes a few minutes to build...
curl https://www.npmjs.org/install.sh | sh

# install common fullstack JavaScript packages globally
npm install -g yo grunt-cli bower express

# optional, check locations and packages are correct
which node; node -v; which npm; npm -v; \
npm ls -g --depth=0
