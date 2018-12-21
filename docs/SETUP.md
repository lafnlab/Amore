# Amore

*Amore* requires you to do some setup to get it working.

### Setup the database
This software presumes you know your way around MySQL and/or MariaDB. Create a new database for Amore to use. The database can have any name you want to give it. After creating the DB, use `sql\setup.sql` to create the tables and enter some initial information.

### conn.php
After you've setup the database, you'll need to enter the pertinent information in the `conn.php` file. If this information isn't entered, the software will not work.

### config.php
In future versions, most of the configuration information will be stored in the database. Until then, *Amore* uses a handy configuration file called config.php. While most of the variables have defaults, `$siteurl` needs to be filled in by the site admin.
