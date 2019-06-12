# Amore database reference

This is the central document for database structure used by **Amore** v0.3. The purpose of each table and field will be described, as will the data type.

### Database name
An empty database must be created before installing **Amore**, but it can have any name the administrator wishes. All tables and fields created during the installation process have to keep the names they are given. If they are changed, **Amore** will break and will not work as well as intended. The database should have utf8mb64_general_ci collation.

### `actor_types` table
+ actor_type_id varchar(10)
+ actor_type_name tinytext

The `actor_types` table was created during the development of **Amore** v0.3. The ActivityPub [standard](https://www.w3.org/TR/activitypub/#actors) uses ActivityStreams [Actor Types](https://www.w3.org/TR/activitystreams-vocabulary/#actor-types). Actor types define whether an account is used by a person, group, organization, application, or service. This isn't implemented in many Fediverse applications, but it's interesting and has potential, so it was included in **Amore** v0.3, even if it isn't implemented yet.

The `actor_type_id` field may not remain in future versions, since all of the names are unique and could serve as the primary key.

The `actor_type_name` field will remain in future versions of **Amore**.

The table is created and filled by `pub/dash/admin/schema.php` during **Amore** installation.

### `configuration` table
+ primary_key varchar(10)
+ website_url tinytext
+ website_name tinytext
+ website_description text
+ default_locale tinytext
+ open_registrations tinyint(1) NULL DEFAULT 0 COMMENT *The default setting is no*
+ admin_account tinytext COMMENT *This will be the first account created.*
+ admin_email tinytext
+ posts_are_called tinytext
+ post_is_called tinyint
+ reposts_are_called tinytext
+ repost_is_called tinytext
+ users_are_called tinytext
+ user_is_called tinytext
+ favorites_are_called tinytext
+ favorite_is_called tinytext
+ dislikes_are_called tinytext
+ dislike_is_called tinytext
+ max_post_length smallint(6) DEFAULT 500
+ banned_user_names text
+ deleted_user_names text
+ allow_user_age_privacy varchar(10)
+ allow_user_gender_privacy varchar(10)
+ allow_user_sexuality_privacy varchar(10)
+ allow_user_relationship_status_privacy varchar(10)
+ allow_user_location_privacy varchar(10)
+ allow_user_nationality_privacy varchar(10)
+ allow_user_time_zone_privacy varchar(10)
+ display_home_page_login_form tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_users_quantity tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_posts_quantity tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_statistics_link tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_about_link tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_privacy_policy_link tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_site_description tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_meta_description tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_admin_info tinyint(1) NULL COMMENT *The default setting is yes.*
+ display_home_page_timeline tinyint(1) NULL COMMENT *The default setting is yes.*
+ list_with_the_federation_info tinyint(1) NULL COMMENT *The default setting is yes.*
+ list_with_fediverse_network tinyint(1) NULL COMMENT *The default setting is yes.*
+ list_with_amore_social tinyint(1) NULL COMMENT *The default setting is yes.*
+ list_with_dating_media tinyint(1) NULL COMMENT *The default setting is yes.*

The `configuration` table was created as an alternative to the `config.php` file used in the previous versions of **Amore**. The advantage of using a table is that the website configuration can be done more easily using a webpage.

This table, as with the rest of the **Amore** code, is a work-in-progress. Some fields are being used, while others aren't. Some will appear in future versions of **Amore**, while others won't.

The `primary_key` field is used in some queries, but is sort of useless, since there is only one website being configured. It will probably be removed in future versions.

The `website_url` field is used a lot in links on the website and it will remain in future versions of **Amore**.

The `website_name` field is frequently used in the titles of webpages and it will remain in future versions of **Amore**.

The `website_description` field is used on the home page, and also appears in the website's HTML metadata. Search engines sometimes display this metadata, so it is fairly important. It will remain in future versions.

The `default_locale` field is used, but is currently useless. The only locale for **Amore** v0.3 is currently `en_US`. If other locales are created, then this field will be more useful. It wil remain in future versions.

The `open_registrations` is mainly used on the home page, to determine whether it should show a login form or a registration form. It will remain in future versions.

The `admin_account` field gets filled during the installation process, but it is not used otherwise. The field will be more useful in the future, and will remain in future versions.

The `admin_email` field gets filled during the installation process, but it is not used otherwise. The field will be more useful in the future, and will remain in future versions.

The `posts_are_called` field is used on the home page and will remain in future versions.

The `post_is_called` field is used on the home page and will remain in future versions.

The `reposts_are_called` field is used and will remain in future versions.

The `repost_is_called` field is used and will remain in future versions.

The `users_are_called` field is used on the home page and will remain in future versions.

The `user_is_called` field is used on the home page and will remain in future versions.

The `favorites_are_called` field is used and will remain in future versions.

The `favorite_is_called` field is used and will remain in future versions.

The `dislikes_are_called` field is used and will remain in future versions.

The `dislike_is_called` field is used and will remain in future versions.

The `max_post_length` field is not used in **Amore** v0.3, but will likely be used in future versions. It will remain in future versions.

The `banned_user_names` field is used and will remain in future versions.

The `deleted_user_names` field is used and will remain in future versions.

The `allow_user_age_privacy` field is a misleading name. The field is used to allow users to set the privacy level for their age. This hasn't been fully implemented in **Amore** v0.3, but will likely remain in future versions, though it may be renamed.

The `allow_user_gender_privacy` field is a misleading name. The field is used to allow users to set the privacy level for their gender. This hasn't been fully implemented in **Amore** v0.3, but will likely remain in future versions, though it may be renamed.

The `allow_user_sexuality_privacy` field is a misleading name. The field is used to allow users to set the privacy level for their sexuality. This hasn't been fully implemented in **Amore** v0.3, but will likely remain in future versions, though it may be renamed.

The `allow_user_relationship_status_privacy` field is a misleading name. The field is used to allow users to set the privacy level for their relationship status. This hasn't been fully implemented in **Amore** v0.3, but will likely remain in future versions, though it may be renamed.

The `allow_user_location_privacy` field is a misleading name. The field is used to allow users to set the privacy level for their location. This hasn't been fully implemented in **Amore** v0.3, but will likely remain in future versions, though it may be renamed.

The `allow_user_nationality_privacy` field is a misleading name. The field is used to allow users to set the privacy level for their nationality. This hasn't been fully implemented in **Amore** v0.3, but will likely remain in future versions, though it may be renamed.

The `allow_user_time_zone_privacy` field is a misleading name. The field is used to allow users to set the privacy level for their time zone. This hasn't been fully implemented in **Amore** v0.3, but will likely remain in future versions, though it may be renamed.

The `display_home_page_login_form` field is used to determine whether a login form should be shown on the home page. If `open_registrations` is set to yes, it will show a registration form instead. This field is not currently used, but will be utilized in future versions.

The `display_home_page_users_quantity` field is used to determine whether the number of users should appear on the home page. This field is not currently used, but will be utilized in future versions.

The `display_home_page_posts_quantity` field is used to determine whether the number of posts should appear on the home page. This field is not currently used, but will be utilized in future versions.

The `display_home_page_statistics_link` field is used to determine whether a link to the statistics page should appear on the home page. This field is not currently used, but will be utilized in future versions.

The `display_home_page_about_link` field is used to determine whether a link to the about page should appear on the home page. This field is not currently used, but will be utilized in future versions.

The `display_home_page_privacy_policy_link` field is used to determine whether a link to the privacy policy should appear on the home page. This field is not currently used, but will be utilized in future versions.

The `display_home_page_site_description` field is used to determine whether the website description should appear on the home page. This field is not currently used, but will be utilized in future versions.

The `display_home_page_meta_description` field is used to determine whether the description of **Amore** software should appear on the home page. This field is not currently used, but will be utilized in future versions.

The `list_with_the_federation_info` field is not currently used, but will be utilized in future versions. [the-federation.info](https://the-federation.info) is a directory of websites connected to the Fediverse. Websites can request to be added to the list.

The `list_with_fediverse_network` field is not currently used, but will be utilized in future versions. [fediverse.network](https://fediverse.network) is a directory of websites connected to the Fediverse. Websites can request to be added to the list.

The `list_with_amore_social` field is not currently used, but will be utilized in future versions. [amore.social](https://amore.social) ~~is~~ will be the primary website of **Amore** and will include a list of websites that use its software. Websites that use **Amore** software can ask to be added to the list.

The `list_with_dating_media` field is not currently used, and may or may not be utilized in future versions. The [dating.media](https://dating.media) domain was purchased before the software was given the name **Amore**, so there is uncertainty around what to do with it.

The table is created by `pub/dash/admin/schema.php` and partially filled with some default information during **Amore** installation.

### `currencies` table
+ currency_id varchar(10)
+ currency_name tinytext
+ currency_iso tinytext
+ currency_symbol varchar(15) DEFAULT ¤
+ currency_digital tinyint(1)

The `currency_id` field may not remain in future versions of **Amore**, since the `currency_name` contains unique items and could also serve as the table's primary key.

The `currency_name` field will remain in future versions of **Amore**.

The `currency_iso` field will remain in future versions, as it is a good backup if a currency does not have a symbol.

The `currency_symbol` field will remain in future versions, as the symbols are frequently used to identify a currency in prices.

The `currency_digital` field will remain in future versions to make it easier to determine if a currency is digital.

The table itself may or may not be included in future versions of **Amore**. It isn't currently used for anything and might be more suitable as a plugin rather than part of the core program.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `eye_colors` table
+ `eye_color_id` varchar(10)
+ `eye_color_name` tinytext

The `eye_color_id` field may not remain in future versions of **Amore**, since the `eye_color_name` contains unique items and could also serve as the table's primary key.

The `eye_color_name` field will remain in future versions of **Amore**.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `genders` table
+ `gender_id` varchar(10)
+ `gender_name` tinytext

The `gender_id` field may not remain in future versions of **Amore**, since the `gender_name` contains unique items and could also serve as the table's primary key.

The `gender_name` field will remain in future versions of **Amore**.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `hair_colors` table
+ `hair_color_id` varchar(10)
+ `hair_color_name` tinytext

The `hair_color_id` field may not remain in future versions of **Amore**, since the `hair_color_name` contains unique items and could also serve as the table's primary key.

The `hair_color_name` field will remain in future versions of **Amore**.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `locales` table
+ `locale_id` varchar(10)
+ `locale_language` tinytext
+ `locale_country` tinytext

The `locale_id` field may not remain in future versions, since the `locale_language` and `locale_country` fields can be combined to make a primary key.

The `locale_language` field will remain in future versions.

The `locale_country` field will remain in future versions.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `locations` table
+ `location_id` varchar(10)
+ `location_name` tinytext
+ `location_parent` varchar(60)

The `location_id` field will be used in future versions, though it may change if there is a standard code for individual locations.

The `location_name` field will be in future versions.

The `location_parent` field will remain in future versions, though it may change as well. It currently allows a location to have multiple parents. For example, [Ceuta](https://en.wikipedia.org/wiki/Ceuta) can be considered part of Africa and part of Spain.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `nationalities` table
+ `nationality_id` varchar(10)
+ `nationality_name` tinytext

The `nationality_id` field may not remain in future versions of **Amore**, since the `nationality_name` contains unique items and could also serve as the table's primary key.

The `nationality_name` field will remain in future versions of **Amore**.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `posts` table
+ `post_id` varchar(10)
+ `post_by` varchar(10)
+ `post_timestamp` datetime
+ `post_text` text
+ `post_privacy_level` varchar(10) DEFAULT 6ьötХ5áзÚZ COMMENT *Default privacy level is for Everyone.*
+ `post_shares` text
+ `post_likes` text
+ `post_dislikes` text
+ `post_flagged` tinyint(1) DEFAULT 0
+ `post_flagged_by` varchar(10)
+ `post_flagged_on` datetime
+ `post_deleted_by` varchar(10)
+ `post_deleted_on` datetime

The `post_id` field will remain in future versions, though it may change format.

The `post_by` field will remain in future versions because it's important to know which account authored a post.

The `post_timestamp` field will remain in future versions as it's important to know when a post was created to fit it in a **timeline**.

The `post_text` field will remain, because it is the primary content of each post.

The `post_privacy_level` will probably remain in future versions. Privacy levels are planned, but not currently implemented. If there is a better way of dealing with privacy levels, this field may be removed from future versions.

The `post_shares` field ~~is~~ will be an unordered collection of ActivityPub accounts that have shared/reposted a post. It will remain in future versions of **Amore**.

The `post_likes` field ~~is~~ will be an unordered collection of ActivityPub accounts that have liked a post. It will remain in future versions of **Amore**.

The `post_dislikes` field ~~is~~ will be an unordered collection of ActivityPub accounts that have disliked a post. It will remain in future versions of **Amore**, even though it isn't in the ActivityPub standard.

The `post_flagged` field will remain in future versions. If this is not set to 0, a post is sent to the moderation queue to be moderated.

The `post_flagged_by` field will remain in future versions. It may be important to know who flagged a post so the moderator or admin can follow up with them.

The `post_flagged_on` field will remain in future versions. It is used to determine how high it ranks in the moderation queue. Posts should be moderated on a "first-come-first-served" basis.

The `post_deleted_by` field will remain in future versions. It is mainly for record keeping purposes.

The `post_deleted_on` field will remain in future versions. It can be used on an ActivityPub [Tombstone](https://www.w3.org/TR/activitypub/#delete-activity-outbox).

The table is created by `pub/dash/admin/schema.php` during the installation process.

### `privacy_levels` table
+ `privacy_level_id` varchar(10)
+ `privacy_level_name` tinytext

The `privacy_level_id` field may not remain in future versions of **Amore**, since the `privacy_level_name` contains unique items and could also serve as the table's primary key.

The `privacy_level_name` field will remain in future versions of **Amore**.

The table is created and filled by `pub/dash/admin/schema.php` during the installation process.

### `relationship_statuses` table
+ `relationship_status_id` varchar(10)
+ `relationship_status_name` tinytext

The `relationship_status_id` field may not remain in future versions of **Amore**, since the `relationship_status_name` contains unique items and could also serve as the table's primary key.

The `relationship_status_name` field will remain in future versions of **Amore**.

The table is created and filled by `pub/dash/admin/schema.php` during the installation process.

### `sexualities` table
+ `sexuality_id` varchar(10)
+ `sexuality_name` tinytext

The `sexuality_id` field may not remain in future versions of **Amore**, since the `sexuality_name` contains unique items and could also serve as the table's primary key.

The `sexuality_name` field will remain in future versions of **Amore**.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `spoken_languages` table
+ `spoken_language_id` varchar(10)
+ `spoken_language_name` tinytext

The `spoken_language_id` field may not remain in future versions of **Amore**, since the `spoken_language_name` contains unique items and could also serve as the table's primary key.

The `spoken_language_name` field will remain in future versions of **Amore**.

The table is created by `pub/dash/admin/schema.php` during the installation process.

### `time_zones` table
+ `time_zone_id` varchar(10)
+ `time_zone_name` tinytext
+ `time_zone_offset` tinytext
+ `time_zone_DST_offset` tinytext

The `time_zone_id` field may not remain in future versions of **Amore**, since the `time_zone_name` contains unique items and could also serve as the table's primary key.

The `time_zone_name` field will remain in future versions of **Amore**.

The `time_zone_offset` field will remain in future versions of **Amore**. It can be used for setting the time of a user's post.

The `time_zone_DST_offset` field will remain in future versions of **Amore**. It can be used for setting the time of a user's post.

The table is created by `pub/dash/admin/schema.php` and is filled by `pub/dash/admin/data-fill.php` during the installation process.

### `users` table
+ `user_id` varchar(10)
+ `user_name` tinytext
+ `user_display_name` tinytext COMMENT *This is the same as the ActivityPub preferredUsername*
+ `user_pass` tinytext
+ `user_email` tinytext
+ `user_date_of_birth` date
+ `user_date_of_birth_privacy` varchar(10)
+ `user_level` varchar(10)
+ `user_actor_type` varchar(10)
+ `user_outbox` text
+ `user_inbox` text
+ `user_liked` text
+ `user_disliked` text
+ `user_follows` text
+ `user_followers` text
+ `user_priv_key` text
+ `user_pub_key` text
+ `user_avatar` tinytext
+ `user_gender` varchar(10)
+ `user_gender_privacy` varchar(10)
+ `user_sexuality` varchar(10)
+ `user_sexuality_privacy` varchar(10)
+ `user_relationship_status` varchar(10)
+ `user_relationship_status_privacy` varchar(10)
+ `user_eye_color` varchar(10)
+ `user_hair_color` varchar(10)
+ `user_location` varchar(10)
+ `user_location_privacy` varchar(10)
+ `user_nationality` varchar(10)
+ `user_nationality_privacy` varchar(10)
+ `user_locale` varchar(10)
+ `user_spoken_language` varchar(60)
+ `user_time_zone` varchar(10)
+ `user_time_zone_privacy` varchar(10)
+ `user_bio` tinytext
+ `user_is_suspended` datetime
+ `user_suspended_on` datetime
+ `user_suspended_by` varchar(10)
+ `user_is_banned` tinyint(4)
+ `user_banned_on` datetime
+ `user_banned_by` varchar(10)
+ `user_created` datetime
+ `user_last_login` datetime

The `user_id` field will remain in future versions of **Amore**, though it may change format because most other programs don't play well with non-ASCII characters.

The `user_name` field will remain in future versions. It is how users are identified on each instance.

The `user_display_name` field will remain in future versions. It is how users prefer to be identified.

The `user_pass` field will remain in future versions as it is how we can be sure that users are who they say they are.

The `user_email` field will remain in future versions. It is not currently used, but it will be in future versions.

The `user_date_of_birth` field will remain in future versions. Admins may wish to, or may be required to, prevent minors from creating accounts.

The `user_date_of_birth_privacy` field will probably remain in future versions. It is not currently used, but may be in the future.

The `user_level` field will remain in future versions. Users are given certain rights depending on what level they are.

The `user_actor_type` field will remain in future versions. It is an ActivityStreams standard that is used by ActivityPub.

The `user_outbox` field will remain in future versions. It is an [ordered collection](https://www.w3.org/TR/activitystreams-vocabulary/#dfn-orderedcollection) of posts created by the user.

The `user_inbox`  field will remain in future versions. It is an ordered collection of posts received by the user.

The `user_liked` field will remain in future versions. It is a collection of ActivityPub objects that a user likes.

The `user_disliked` field will remain in future versions. It is a collection of ActivityPub objects that a user does not like. This is not part of the ActivityPub standard, but probably should be.

The `user_follows` field will remain in future versions. It is a collection of ActivityPub accounts that a user follows.

The `user_followers` field will remain in future versions. It is a collection of ActivityPub accounts that follow a user.

The `user_priv_key` field will probably remain in future versions of **Amore**. **Amore** is not currently setup to use cryptography keys, but they are required by ActivityPub.

The `user_pub_key` field will probably remain in future versions of **Amore**. **Amore** is not currently setup to use cryptography keys, but they are required by ActivityPub.

The `user_avatar` field will remain in future versions. It is not currently used, but will contain a path/URL for the user's avatar.

The `user_gender` field will remain in future versions. Genders can be important for some dating apps/websites.

The `user_gender_privacy` field will remain in future versions. It allows users to set a privacy level for their gender.

The `user_sexuality` field will remain in future versions. Sexualities can be important for some dating apps/websites.

The `user_sexuality_privacy` field will remain in future versions. It allows users to set a privacy level for their sexuality.

The `user_relationship_status` field will remain in future versions. A person's relationship status can be important for some dating apps/websites.

The `user_relationship_status_privacy` field will remain in future versions. It allows users to set a privacy level for their relationship status.

The `user_eye_color` field will remain in future versions. Physical characteristics may be important to some dating app users.

The `user_hair_color` field will remain in future versions. Physical characteristics may be important to some dating app users.

The `user_location` field will remain in future versions. A person's location can be important for some dating apps/websites.

The `user_location_privacy` field will remain in future versions. It allows users to set a privacy level for their location.

The `user_nationality` field will remain in future versions. A person's nationality can be important for some dating apps/websites.

The `user_nationality_privacy` field will remain in future versions. It allows users to set a privacy level for their nationality.

The `user_locale` field will remain in future versions. Users will use it to set the language they want to use for the website.

The `user_spoken_language` field will remain in future versions. The languages spoken by a user is potentially useful on some dating sites.

The `user_time_zone` field will remain in future versions. A person's time zone can be important for some dating apps/websites. It is also useful to **Amore** to figure out when they post.

The `user_time_zone_privacy` field will remain in future versions. It allows users to set a privacy level for their time zone.

The `user_bio` field will remain in future versions. It is a brief description of the user written by themselves.

The `user_is_suspended` field will remain, but may be renamed. The field is meant to hold the date and time when a user's suspension ends.

The `user_suspended_on` field will remain in future versions. It is meant to note the beginning date and time of their suspension.

The `user_suspended_by` field will remain in future versions. It is meant to note the administrator that suspended a user.

The `user_is_banned` field will remain in future versions. It is a simple boolean that shows whether a user is banned or not.

The `user_banned_on` field will remain in future versions. It is meant to note when a user was banned.

The `user_banned_by` field will remain in future versions. It is meant to note the administrator that banned a user.

The `user_created` field will remain in future versions. It is the date and time when a user first created their account. It is useful for calculating how long a user has been a member of a website.

The `user_last_login` field will remain in future versions. It is the date and time of the user's most recent login. It is used to calculate how many users have logged in over the past month and over the past six months.

### `user_levels` table
+ `user_level_id` varchar(10)
+ `user_level_name` tinytext

The `user_level_id` field may not remain in future versions of **Amore**, since the `user_level_name` contains unique items and could also serve as the table's primary key.

The `user_level_name` field will remain in future versions of **Amore**.

The table is created and filled by `pub/dash/admin/schema.php` during the installation process.
