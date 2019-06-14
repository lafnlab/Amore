# **Amore** v0.3 Administrator's manual

This Administrator's Manual for **Amore** v0.3 is meant to provide information on how to perform administrative tasks in the software. This manual is intended for use with version 0.3 of **Amore** and may not be appropriate for other versions.

### Configuration
After installing **Amore**, it's recommended that the administrator take some time configuring the website to make it more useful and usable. The configuration has been divided into three areas: general, home page, and privacy.

##### General
The general configuration webpage has some settings that should be configured first.

+ The *Site name* field should already be filled in, while the rest of the fields are blank, have placeholder text, or have some default data.
+ The *URL* field has some placeholder text that needs to be replaced with the actual URL of the website. Some links may not work without it.
+ The *Description* field also has some placeholder text. It's highly suggested that this be filled out with unique description of the website. It can influence how the website appears in search engines.
+ The *Default locale* is currently set to `en-US`, which is the only locale currently available.
+ The *Membership* checkbox is important. If it is unchecked, nobody can register on their own, but would need to have their accounts created by an administrator. For security reasons it is left unchecked, but whenever the website is up-and-running well it is strongly suggested that this be checked so people can join.
+ The *Admin account* field is probably blank. This isn't currently used in **Amore**, so it is safe to leave empty.
+ The *Admin email* field is also probably blank. It also isn't used by **Amore** at the moment, so it is safe to leave blank.
+ The *Post is called* field is blank. **Amore** uses it on the statistics page, so if you would like it to refer to a *post* as something else, enter it here.
+ The *Posts are called* field is blank. **Amore** uses it on the statistics page, so if you would like it to refer to *posts* as something else, enter it here.
+ The *Repost is called* field is blank. **Amore** uses it on the statistics page, so if you would like it to refer to a *repost* as something else, enter it here.
+ The *Reposts are called* field is blank. **Amore** uses it on the statistics page, so if you would like it to refer to *reposts* as something else, enter it here.
+ The *Favorite is called* field is blank. **Amore** uses it with the posts, so if you would like it to refer to a *favorite* as something else, enter it here.
+ The *Favorites are called* field is blank. **Amore** uses it with the posts, so if you would like it to refer to *favorites* as something else, enter it here.
+ The *Dislike is called* field is blank. **Amore** uses it with the posts, so if you would like it to refer to a *dislike* as something else, enter it here.
+ The *Dislikes are called* field is blank. **Amore** uses it with the posts, so if you would like it to refer to *dislikes* as something else, enter it here.
+ The *User is called* field is blank. **Amore** uses it on the statistics page, so if you would like it to refer to a *user* as something else, enter it here.
+ The *Users are called* field is blank. **Amore** uses it on the statistics page, so if you would like it to refer to *users* as something else, enter it here.
+ The *Maximum characters per post* field is set to 500 by default. This isn't currently used, so it can be blank, left as the default, or set to something else.

When the fields are set as desired, click on the Update button. They can always be changed later if needed.

##### Home Page
The home page configuration webpage is intended to allow the site admin to decide what items would appear on the website's home page. These settings don't currently work, but they will in future versions of **Amore**.

##### Privacy
The privacy configuration webpage is intended to allow the site admin to decide if users can set privacy settings for some parts of their profiles. These settings don't currently work, but they will in future versions. of **Amore**.

### Users
Administrators on most websites with users typically have to perform some tasks related to user management. The functions supported by **Amore** are described below.

##### Add a user
The ability to add a new user is an important one. This is especially true if a website has closed registrations, but it's also true if an administrator wants to create a special account or if a user is having a difficult time creating an account of their own.

+ The *Username* field is how the name of their account and how **Amore** identifies them. It will be their "@" name (e.g. @username). This field is required.
+ The *Display name* field is the name that will appear in their profile. This might be their real name or something else. It is mainly for the benefit of the users.
+ The *Passphrase* field is also required to create an account, and it has rules regarding length and complexity.
+ The *Verify passphrase* field is also required, so we can be sure it wasn't entered incorrectly.
+ The *Email* field isn't required. It currently isn't used in **Amore** though it will be in the future.
+ The *User level* field is used, but **Amore** currently only recognizes whether someone is an Administrator or not. The other options are not used at the moment.
+ The *Account type* field is not currently used, but it will be in the future. It is based on the activityStreams [Actor types](https://www.w3.org/TR/activitystreams-core/#actors).

##### Edit a user
Administrators have the ability to edit user profiles. This should be done only when users are unable to edit their own profiles.

##### Suspend a user
Administrators can suspend users for length of time. At the moment, this is very basic. The administrator picks a date that the suspension can be lifted and **Amore** enters the date in the database. The suspension will be lifted at 00:00:01 on the morning of the given date.

##### Ban a user
Administrators can ban users. When a user is banned, all of their posts are removed, their passphrase is scrambled so they cannot login, their username is added to the list of banned user names, and their profile is cleared except for the username, the scrambled passphrase, the date they were banned, and who banned them.

This process keeps the usernames from being claimed by someone else.

##### Delete a user
Administrators can delete users from the system. Unlike banning, this allows the usernames to be used again. This should only be done in rare circumstances.

##### Passphrase reset
Administrators can reset user passphrases. At the moment, there is no good way to authenticate users, so each website will have to determine how to handle this on their own. For this reason, passphrase resets should not be done unless the administrator knows the user.

##### My profile
All users have the ability to perform certain tasks on their own profiles.

###### Edit profile
All users have the ability to edit their own profiles, and should be encouraged to do so. While the user profiles in **Amore** v0.3 contain limited information compared to other dating platforms, they are more extensive when compared with other Fediverse platforms. This information will only be readable if someone visits a user's profile. It isn't readable by other platforms.

###### Delete profile
All users have the ability to delete their profiles from **Amore**. If a user deletes their profile, their posts will be deleted, their username will be added to the deleted users list, and their profiles will be deleted from the `users` table.

###### Change passphrase
All users have the ability to change their passphrase in **Amore**. Users may need or want to change their passphrase for any number of reasons, and it is a useful function to have. 

### Posts

##### Create a post

##### Like or dislike a post

##### Flag a post

##### Moderation queue

###### Delete a post

###### Approve a post

### Metadata
