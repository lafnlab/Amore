# **Amore** v0.3 quick start guide

This Quick Start Guide for **Amore** v0.3 covers the requirements, setup, and installation process. For more detailed information about administering an **Amore** website, please read the [Administrator's Manual](admin-manual.md).

### Requirements
**Amore** v0.3 was written on a laptop computer running Linux Mint 19, using MariaDB 10.1.40 for the database, PHP 7.2 for the language, and nginx 1.14 for the web server. The [testing instance](https://blackh3art.media.dating) is in a hosted environment running Ubuntu Server with Apache 2.2.x, PHP 7.2, and MySQL 5.6.

The requirements to run **Amore** are:
+ PHP 7.2
+ MariaDB 10.1 or MySQL 5.6
+ Apache 2.2 or nginx 1.14

It may be possible to run **Amore** with other versions of PHP and MariaDB/MySQL, or with other web servers instead of Apache and nginx, however these have not been tested.

### Pre-installation tasks
Before installing **Amore**, we need information about the database:

+ Hostname
+ Username
+ Password
+ Database name

The database needs to be setup before installing **Amore**. It's recommended that we use an empty database (one with no tables). The database does not need to be named `amore`; that is just a suggestion.

Next, unzip the **Amore** file and move the `amore` folder to a place where your web server will find it. In Linux Mint, this will be in the `/var/www` directory.

***NOTE***: The web server needs to be set to read **Amore's** `pub/` directory as the website root directory. ***This is very important***. For security reason, we do not want random users to be able to read above the `pub/` directory.

### Installation
The installation process for **Amore** v0.3 is modeled after the famously easy installation process of WordPress.

After following the pre-installation steps above, open a browser and go to your website. It should direct you to the install page. Enter the information in the form, then click on the START SUBMIT button.

The next page asks for the name of the website, the username for the first user, and the password for the first user. After entering the required information, click on the CREATE USER button.

Following that, we're instructed to move `conn.php` out of `pub/` and into the `amore/` directory, then to click on a link to go to the login page. The user can login with the credentials they supplied and start their new instance of **Amore**.

### Next steps
The next step is to read the [Administrator's Manual](admin-manual.md) for information on configuring **Amore** v0.3.
