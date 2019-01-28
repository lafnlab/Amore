The default user interface of *Amore* is setup using American English (en_US), however it is also being coded with internationalization (i18n)/localization (l10n) in mind.

*Amore* comes with amore.pot, which is a translation template file. It contains all the translatable strings in *Amore v0.2* and can be used to create translations for other locales/languages.

The locale files must be called amore.po for the software to find them. The will be found in:

pub/locale/*locale_name*/LC_MESSAGES/amore.po

Future versions of *Amore* will either create amore.mo files or supply them. 
