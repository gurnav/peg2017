#!/usr/bin/env python3
# -*- coding: utf-8 -*-


""" File for installing the esgi-geographic CMS """


import os
import zipfile
import shutil


print("Hello welcome to the esgi-geographic installer !")
site_name = input("First of all choose your site name : ")
host_name = input("Then please inquire your host name")

print("Downloading the project")
os.system("git clone https://github.com/gurnav/peg2017.git " + site_name)

while True:
    sub_site_str = input("Is your site a sub site ? (yes / no)")
    if sub_site_str == "yes" or sub_site_str == "no":
        sub_site = "true" if sub_site_str == "yes" else "false"
    else:
        print("Please type yes or no")

print("Creating needed directories ...")
os.mkdir(site_name + "/uploads")
os.mkdir(site_name + "/uploads/contents")
os.mkdir(site_name + "+uploads/users")
os.mkdir(site_name + "/logs")
os.mkdir(site_name + "/public/assets/js/plugins")

print("Unzipping needed files ...")
with zipfile.ZipFile(site_name + "/ressources/zip/fonts.zip", "r") as zip_ref:
    zip_ref.extractall(site_name + "/public/assets")
with zipfile.ZipFile(site_name + "/ressources/zip/images.zip", "r") as zip_ref:
    zip_ref.extractall(site_name + "/public/assets")
with zipfile.ZipFile(site_name + "/ressources/zip/font-awesome.zip", "r") as zip_ref:
    zip_ref.extractall(site_name + "/public/assets/css")
with zipfile.ZipFile(site_name + "/ressources/zip/uploads.zip", "r") as zip_ref:
    zip_ref.extractall(site_name)
shutil.copyfile(site_name + "/public/assets/images/avatar.png", "uploads/users")

print("Installing JS plugins")
os.system("git clone https://github.com/spantaleev/ckeditor-imagebrowser.git " + site_name + "public/assets/js/plugins/imagebrowser")

print("Installing PHP dependencies")
os.system("composer update -d " + site_name)

print("Installing the Database in esgiGeographik")
mysql_user = input("Inquire the mysql user : ")
mysql_pwd = input("And the password : ")
mysql_host = input("Inquire the mysql host")
os.system("mysql --user=" + mysql_user + " --password=" + mysql_pwd + " -e CREATE DATABASE esgiGeographik")
os.system("mysql --user=" + mysql_user + " --password=" + mysql_pwd + " esgiGeographik < " + site_name +  + "/ressources/database/esgiGeographik.sql")

print("Giving rights for uploads")
shutil.chown(site_name + "/uploads", "www-data", "www-data")
shutil.chown(site_name + "/uploads/users", "www-data", "www-data")
shutil.chown(site_name + "/uploads/contents", "www-data", "www-data")

print("Now inquire your gmail and the associated password")
email_admin = input("The admin email")
email_pwd = input("The admin password")

print("Creating conf.inc.php and .htaccess")
with open("conf.inc.php", "w") as conf_inc_php:
    conf_inc_php.write("""
    <?php

        define('DS', DIRECTORY_SEPARATOR);

        // Personnal configuration
        define('SUB_SITE', {});
        define('HOST', '{}');
        define('SITE_NAME', '{}');

        define('PATH_RELATIVE', DS.SITE_NAME.DS);
        define('PATH_RELATIVE_PATTERN', '\/'.SITE_NAME);

        define('BASE_URL', 'http://'.HOST.'/'.(SUB_SITE === true ? SITE_NAME.'/' : ''));
        define('ROOT', dirname(__DIR__) . PATH_RELATIVE);

        define('EMAIL_ADMIN', '{}');
        define('EMAIL_ADMIN_PASSWORD', '{}');

        define('DB_NAME', 'esgiGeographik');
        define('DB_USER', '{}');
        define('DB_PWD', '{}');
        define('DB_HOST', '{}');

        // Standard
        define('DB_PORT', '3306');
        define('DB_DRIVER', 'mysql');
        define('DB_PREFIX', 'hbv_');

        // LINK for handling upload
        define('ROUTE_DIR_CONTENTS', BASE_URL.'uploads/contents/');
        define('UPLOADS_DIR_CONTENTS', ROOT.'uploads/contents/');
        define('ROUTE_DIR_USERS', BASE_URL.'uploads/users/');
        define('UPLOADS_DIR_USERS', ROOT.'uploads/users/');

        // Others
        define('BASE_AVATAR', 'avatar.png');
        """.format(sub_site, host_name, site_name, email_admin, email_pwd,
                   mysql_user, mysql_pwd, mysql_host))

with open(".htaccess", "w") as htaccess:
    if sub_site == "true":
        rewrite_rule = "/" + site_name + "/index.php"
    else:
        rewrite_rule = "index.php"

    htaccess.write("""
    <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule . {} [L]

      # For HTTPS
      # RewriteCond %{HTTPS} off
      # RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
      # Header always set Strict-Transport-Security "max-age=63072000; includeSubdomains; preload" env=HTTPS

      # Transform .xml in .rss
      RewriteRule ^(.+).rss$ $1.xml [L]
    </IfModule>

    <IfModule mod_expires.c>

        # Enable expirations
        ExpiresActive On

        # Default directive
        ExpiresDefault "access plus 1 month"

        # My favicon
        ExpiresByType image/x-icon "access plus 1 month"

        # Images
        ExpiresByType image/gif "access plus 1 month"
        ExpiresByType image/png "access plus 1 month"
        ExpiresByType image/jpg "access plus 1 month"
        ExpiresByType image/jpeg "access plus 1 month"

        # CSS
        ExpiresByType text/css "access plus 1 month"

        # Javascript
        ExpiresByType application/javascript "access plus 1 month"

    </IfModule>

    """.format(rewrite_rule))
