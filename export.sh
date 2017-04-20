#!/bin/bash
if [ ! `id -u` == 0 ]; then
    echo "Please run as root"
    exit 1
fi

sudo resume export --theme paper Jason-Wright-Resume.pdf
sudo resume export --theme elegant index.html

