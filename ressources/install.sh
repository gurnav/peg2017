#!/bin/bash

if [ "$#" -ne 4 ] || [ "$1" == "--help" ]; then
    echo "Usage: `basename $0` [HOST] [SITE_NAME] [MYSQL_USER] [MYSQL_PWD]"
    exit 0
fi

host=$1
site_name=$2
mysql_user=$3
mysql_pwd=$4


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
cp public/assets/images/avatar.png uploads/users

# Configure conf.inc.php
# echo "Configuring the web app"
# sed -i '2,4d' conf.inc.php
# echo define("HOST", "\"${host}\"") >> conf.inc.php
# echo define("SITE_NAME", "\"${site_name}\"") >> conf.inc.php

# Install PHP dependencies
echo "Installing PHP dependencies"
composer install

# Install JS plugins
echo "Installing JS plugins"
git clone https://github.com/spantaleev/ckeditor-imagebrowser.git public/assets/js/plugins/imagebrowser

# Install the Database
echo "Installing the Database"
mysql --user="${mysql_user}" --password="${mysql_pwd}" esgiGeographik < ressources/database/esgiGeographik.sql

# Give the good rights
echo "Giving good rights to files"
find . -name "*.php" -exec chmod +x {} \;
find app -name "*.php" -exec chmod +x {} \;
find core -name "*.php" -exec chmod +x {} \;

# Giving rights for uploads
echo "Giving rights for uploads"
chown -R www-data:www-data uploads

# Exit
echo "Installation Done ! Exiting"
exit 0
