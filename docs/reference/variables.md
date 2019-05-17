#Amore variables reference

This page is a central document for variables used in *Amore*. Any *Amore* variables will be documented to show how they are used, while standard PHP variables will have links to the official PHP documentation.

`$dbconn` - This variable is used to make a database connection. It is frequently positioned at the top of the PHP file, and always stands for `new mysqli(DBHOST, DBUSER, DBPASS, DBNAME)`.

`$metadescription` - This variable is used in the functions.php file. It provides a translatable description of *Amore* software that gets displayed on pub/index.php and pub/dash/main.php
