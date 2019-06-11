# Amore database reference

This is the central document for database structure used by **Amore** v0.3. The purpose of each table and field will be described, as will the data type.

### Database name
An empty database must be created before installing **Amore**, but it can have any name the administrator wishes. All tables and fields created during the installation process have to keep the names they are given. If they are changed, **Amore** will break and will not work as well as intended. The database should have utf8mb64_general_ci collation.

### `actor_types` table
+ actor_type_id varchar(10)
+ actor_type_name tinytext

The `actor_types` table was created during the development of **Amore** v0.3. The ActivityPub [standard](https://www.w3.org/TR/activitypub/#actors) uses ActivityStreams [Actor Types](https://www.w3.org/TR/activitystreams-vocabulary/#actor-types). Actor types define whether an account is used by a person, group, organization, application, or service. This isn't implemented in many Fediverse applications, but it's interesting and has potential, so it was included in **Amore** v0.3, even if it isn't implemented yet.

The `actor_type_id` is superfluous since all of the items in `actor_type_name` are unique.

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

The `list_with_dating_media` field is not currently used, and may or may be utilized in future versions. The [dating.media](https://dating.media) domain was purchased before the software was given the name **Amore**, so there is uncertainty around what to do with it. 
