# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Breaking

- Using `getSession()` or `removeSession()` will now throw a `Folded\Exceptions\SessionKeyNotFoundException` instead of a `OutOfRangeException` if the key is not found in the session.

## [0.1.1] 2020-09-15

### Fixed

- Flashing a data will now correctly remove it next time you try to get it again.

## [0.1.0] 2020-09-11

### Added

- First working version.
