# **Amore** functions reference

This is the central document for functions used in **Amore** v0.3. Any **Amore** functions will be documented to show how they are used, while standard PHP functions will have links to the official PHP documentation.

### PHP functions
[`date`](https://www.php.net/manual/en/function.date.php) **Amore** uses PHP's `date` function in various places, including in the `functions.php` file.

[`floor`](https://www.php.net/manual/en/function.floor.php) **Amore** uses PHP's `floor` function in the `user_age` function in the `functions.php` file.

[`header`](https://www.php.net/manual/en/function.header.php) **Amore** uses PHP's `header` function in the `redirect` function in the `functions.php` file.

[`htmlspecialchars`](https://www.php.net/manual/en/function.htmlspecialchars.php) **Amore** uses PHP's `htmlspecialchars` function in various places, including in the `functions.php` file.

[`mb_substr`](https://www.php.net/manual/en/function.mb-substr.php) **Amore** uses PHP's `mb_substr` function in the `makeid` function in `functions.php` file.

[`mysqli`](https://www.php.net/manual/en/mysqli.construct.php) **Amore** uses PHP's `mysqli` function to create a database connection on every dynamic webpage.

[`mysqli_fetch_assoc`](https://www.php.net/manual/en/mysqli-result.fetch-assoc.php) **Amore** uses PHP's `mysqli_fetch_assoc` to fetch associative arrays following database queries.

[`mysqli_num_rows`](https://php.net/manual/en/mysqli-result.num-rows.php) **Amore** uses PHP's `mysqli_num_rows` to count the number of results returned in database queries.

[`mysqli_query`](https://www.php.net/manual/en/mysqli.query.php) **Amore** uses PHP's `mysqli_query` function in many places to move information to and from the database.

[`mysqli_set_charset`](https://www.php.net/manual/en/mysqli.set-charset.php) **Amore** uses PHP's `mysqli_set_charset` function to set the default character set to UTF-8 at the top of nearly every dynamic webpage.

[`preg_replace`](https://www.php.net/manual/en/function.preg-replace.php) **Amore** uses PHP's `preg_replace` function in various places, including the `short_url` function in the `functions.php` file.

[`preg_split`](https://www.php.net/manual/en/function.preg-split.php) **Amore** uses PHP's `preg_split` function in various places, including the `makeid` function in the `functions.php` file.

[`shuffle`](https://www.php.net/manual/en/function.shuffle.php) **Amore** uses PHP's `shuffle` function in the `makeid` function in the `functions.php` file.

[`stripslashes`](https://www.php.net/manual/en/function.stripslashes.php) **Amore** uses PHP's `stripslashes` function in the `nicetext` function in the `functions.php` file.

[`strtotime`](https://www.php.net/manual/en/function.strtotime.php) **Amore** uses PHP's `strtotime` function in various places, including in the `functions.php` file.

[`time`](https://www.php.net/manual/en/function.time.php) **Amore** uses PHP's `time` function in various places, including in the `functions.php` file.

[`trim`](https://www.php.net/manual/en/function.trim.php) **Amore** uses PHP's `trim` function in the `nicetext` function in the `functions.php` file.

### **Amore** functions
`atom_updated( $time )` This function gets the timestamp of the latest post and formats it in a format that is frienldy to the Atom format.

`header_message( $message )` This function shows a `<div>` near the top of the page with an important message for the user.

`makeid( $newid )` This function makes a ten character random id comprised of Arabic numerals, and Latin and Cyrillic upper and lowercase letters.

`nicetext( $text )` This function takes text from a form and makes it less likely to be used in an attack. It converts html entities, strips slashes, and removes whitespace.

`post_quantity( $posts )` This function gets the total number of posts on an instance.

`redirect( $location )` This function will redirect a browser to another page.

`short_url( $url )` This function removes the https:// or http:// from the start of a URL.

`user_age( $userage )` This function calculates a user's age based on their date of birth.

`user_post_quantity( $userid )` This function gets the total number of posts for a user.

`user_quantity( $users )` This function gets the total number of users on an instance.

`users_half_year( $sometimes_users )` This function gets the total number of users over the past six months.

`users_past_month( $active_users )` This function get the total number of users over the past month.
