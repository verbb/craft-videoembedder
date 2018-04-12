# Video Embedder Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 1.0.9 - 2018-04-12
### Added
- Added `getVideoId` variable
### Changed
- Code cleanup
- Updated functions to return an empty string if the URL returns null for any reason. (#5, #6)
- Craft 3.0.0 release is required, no longer supporting RC versions

## 1.0.8 - 2018-03-07
### Added
- Added `getTitle` variable
- Added `getDescription` variable
- Added `getType` variable
- Added `getAspectRatio` variable
- Added `getProviderName` variable

## 1.0.7 - 2018-03-07
### Changed
- Change `Embed` parameters to `choose_bigger_image` rather than picking it based off pixel dimensions

## 1.0.6 - 2018-02-20
### Changed
- Code cleanup
- Thumbnail images now remove `http:` or `https:` from the URL to prevent mixed security

## 1.0.5 - 2018-02-19
### Added
- Added new `embed` variable
### Changed
- Added new parameters to pass along with the `getEmbedUrl` variable
- Updated thumbnail function to simplify after adding the [Embed](https://github.com/oscarotero/Embed) library

## 1.0.4 - 2018-01-29
### Changed
- Updated path and repo name to fit within new recommended guidelines [as discussed here](https://craftcms.stackexchange.com/questions/23535/craft-3-plugin-backwards-compatibility-and-maintenance-for-2-x).

## 1.0.3 - 2017-12-13
### Changed
- Updated to require `craftcms/cms ^3.0.0-RC1` (Thanks @brandonkelly)

## 1.0.2 - 2017-08-07
### Added
- Fixed composer `handle` which caused a crash.

## 1.0.1 - 2017-08-05
### Added
- Added `getVideoThumbnail` variable.

## 1.0.0 - 2017-08-05
### Added
- Initial release
