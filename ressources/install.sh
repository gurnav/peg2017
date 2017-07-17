#!/usr/bin/env bash

if [ "$#" -ne 3 ] || [ "$1" == "--help" ]; then
    echo "Usage: `basename $0` [HOST] [SITE_NAME] [MYSQL_USER]"
    exit 0
fi

# Create needed directory
echo "Create needed directory"
cd ..
mkdir uploads
mkdir uploads/contents
mkdir uploads/users
mkdir logs
mkdir public/assets/js/plugins

# Unzip and install needed files
echo "Unzip and install needed files"
unzip ressources/zip/fonts.zip -d public/assets
unzip ressources/zip/images.zip -d public/assets/
unzip ressources/zip/font-awesome.zip -d public/assets/css
mv public/assets/images/avatar.png uploads/users

# Configure conf.inc.php
echo "Configure the web app"
sed -i '2,4d' conf.inc.php
echo define("HOST", "\"$1\""); >> conf.inc.php
echo define("SITE_NAME", "\"$2\""); >> conf.inc.php

# Install PHP dependencies
echo "Install PHP dependencies"
composer install

# Install JS plugins
echo "Install JS plugins"
git clone https://github.com/spantaleev/ckeditor-imagebrowser.git public/assets/js/plugins/imagebrowser

# Install the Database
echo "Install the Database"
mysql -u $3 -p esgiGeographik < ressources/database/esgiGeographik.sql

# Give the good rights
echo "Giving good rights to files"
find app -name "*.php" -exec chmod +x {} \;
find core -name "*.php" -exec chmod +x {} \;

# Giving rights for uploads
echo "Giving rights for uploads"
chown -R www-data:www-data uploads

# Exit
echo "Installation Done ! Exiting"
exit 0
