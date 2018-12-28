The default user interface of *Amore* is setup using American English, however it is also being coded with internationalization (i18n) and localization (l10n) in mind.

The PHP function `gettext` can find strings with inside `_('Some random string')`, but it can't get data from a database, so those will end up in different .pot files.
