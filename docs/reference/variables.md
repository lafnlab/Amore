#Amore variables reference

This page is a central document for variables used in *Amore*. Any *Amore* variables will be documented to show how they are used, while standard PHP variables will have links to the official PHP documentation.

`$dbconn` - This variable is used to make a database connection. It is frequently positioned at the top of a PHP file, and is always assigned as `new mysqli(DBHOST, DBUSER, DBPASS, DBNAME)`.

`$metadescription` - This variable is used in the `functions.php` file. It provides a translatable description of *Amore* software that gets displayed on `pub/index.php`.

`$newid` - This variable is used in the `functions.php` file where it is the argument for the `makeid` function.

`$chars` - is a string of characters that includes numbers, and upper and lower case letters in the Latin and Cyrillic alphabets. It is used in the `makeid` function in the `functions.php` file.

`$tmp` - is an array to hold the result of a `preg_split` applied to `$chars`. It is used in the `makeid` function in the `functions.php` file.

`$tmp2` - is a string to hold the result of a shuffled and joined `$tmp`. It is used in the `makeid` function in the `functions.php` file.

`$text` - This variable is the argument for the `nicetext` function in the `functions.php` file.

`$message` - This variable is argument used in the `header_message` function in the `functions.php` file.

`$msg` - is a variable used in the `header_message` function in the `functions.php` file. It is used to hold a concatenated string that is returned to where the function was called. The string is a `<div>` to provide a message near the top of the rendered page.

`$location` - This variable is the argument for the `redirect` function in the `functions.php` file.

`$userage` - This variable is the argument used by the `user_age` function in the `functions.php` file.

`$url` - This variable is the argument used by the `short_url` function in the `functions.php` file.

`$users` - This variable is the argument for the `user_quantity` function in the `functions.php` file.

`$userqq` - is a variable used in the `user_quantity` function in the `functions.php` file. It is a string assigned as `"SELECT * FROM users"`.

`$userqquery` - is a variable used in the `user_quantity` function in the `functions.php` file. It is used to call `myslqi_query` for `$userqq`.

`$userqty` - is a variable used in the `user_quantity` function in the `functions.php` file. It is used to perform `mysqli_num_rows` on `$userqquery`.

`$sometimes_users` - This variable is the argument for the `users_half_year` function in the `functions.php` page.

`$usershalfyear` - is a variable used in the `users_half_year` function in the `functions.php` file. It is an integer set to `0` that gets incremented while the function is running.

`$usershalfyearq` - is a variable used in the `users_half_year` function in the `functions.php` file. It is a string assigned as `"SELECT * FROM users"`.

`$usershalfyearquery` - is a variable used in the `users_half_year` function in the `functions.php` file. It is used to call `myslqi_query` for `$usershalfyearq`.

`$usershalfyearopt` - is a variable used in the `users_half_year` function in the `functions.php` file. It is used to perform `mysqli_fetch_assoc` on `$usershalfyearquery`.

`$lastlogin` - is a variable used in the `users_half_year` and `users_past_month` functions in the `functions.php` file. It is used to hold a string containing the time and date of a user's last login.

`$now` - is a variable used in the `users_half_year` and `users_past_month` functions in the `functions.php` file. It is used to hold a string containing the current time and date.
