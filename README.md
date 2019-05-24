# eZ Flow Migration Toolkit
A set of tools that helps migrate data from legacy eZ Flow extension _(eZ Publish 4.x/5.x)_ to eZ "Studio" landing page management _(eZ Platform Enterprise 1.x)_. If you have Page field (ezflow) content and an eZ Enterprise subscription, you can use a script to migrate your Page content to eZ Studio Landing Page.

# Documentation
See [Migrating legacy Page field (ezflow) to eZ Studio Landing Page](https://doc.ezplatform.com/en/1.13/migrating/migrating_from_ez_publish_platform/#migrating-legacy-page-field-ezflow-to-new-page-enterprise) for more information.

For help text: `app/console ezflow:migrate --help`

# Todo: Migration to v2

This packge does not yet allow migration to 2.x (Page builder) directly, to do that you'll need to migrate in two stages:
1. From eZ Flow to 1.7LTS _(Landig Pages)_, using this package.
2. From 1.13LTS to 2.5LTS _(Page builder)_ using [ezsystems/ezplatform-page-migration](https://github.com/ezsystems/ezplatform-page-migration) package.
