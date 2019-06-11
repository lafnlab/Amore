# Amore database reference

This is the central document for database structure used by **Amore** v0.3. The purpose of each table and field will be described, as will the data type.

### Database name
An empty database must be created before installing **Amore**, but it can have any name the administrator wishes. All tables and fields created during the installation process have to keep the names they are given. If they are changed, **Amore** will break and will not work as well as intended. The database should have utf8mb64_general_ci collation.

### `actor_types` table
+ actor_type_id varchar(10)
+ actor_type_name tinytext

The `actor_types` table was created during the development of **Amore** v0.3. The ActivityPub [standard](https://www.w3.org/TR/activitypub/#actors) uses ActivityStreams [Actor Types](https://www.w3.org/TR/activitystreams-vocabulary/#actor-types). Actor types define whether an account is used by a person, group, organization, application, or service. This isn't implemented in many Fediverse applications, but it's interesting and has potential, so it was included in **Amore** v0.3, even if it isn't implemented yet.

### `configuration` table
 
