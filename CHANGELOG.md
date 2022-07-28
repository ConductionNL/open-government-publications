# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2022-07-??
### Changed
- Rewrite of most components
- Start using Composer to load dependencies
- Start using Webpack to create static assets
- Start using PSR-12 as Coding Style Standard
- Fix typos and better error messages

### Removed
- Plugin constants; these are now resolvable through the container instance
- Global function 'get_open_govpub_nav_tab'
- Global function 'the_open_govpub_nav_tab'
- Global function 'get_open_govpub_source_organizations'
- Global function 'get_open_govpub_setting'
- Global function 'get_open_govpub_scheduled_time'
- Global function 'get_open_govpub_last_import_string'
- Global function 'get_open_govpub_current_import_string'
- Global function 'get_open_govpub_service_config'
- Global function 'get_open_govpub_option'
- Global function 'get_open_govpub_types_api_args'
- Global function 'get_open_govpub_search_api_args'
- Global function 'update_open_govpub_sub_option'
- Global function 'update_open_govpub_option'
- Global function 'is_govpub_import_locked'
- Global function 'is_govpub_import_check_locked'
- Global function 'delete_open_govpub_option'


## 1.0.2: 2020-09-01
### Changed
- Removal of esc_url from the curl request

## 1.0.1: 2019-10-29
### Added
- Update class

### Changed
- Grammar error

## 1.0.0: 2019-10-01
- Initial release