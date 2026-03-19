# Changelog

All notable changes to `laravel-collection-macros` will be documented in this file.

## v1.4.3 - 2026-03-19

### Code quality improvements and expanded test coverage

- Fix `CompareCount` `@return` docblock to use conditional type reflecting both `$shouldZip` paths
- Move `OnlyStrings` `$isStringable` closure out of returned `Closure` to avoid recreation on every call
- Improve `Positive` docblock to clarify semantic meaning
- Add `--memory-limit=512M` to PHPStan `analyse` script to prevent crashes
- Set `minimum-stability` to `stable` in `composer.json`
- Add tests for empty collections in `CompareCount`, `RecursiveToArray`, `MapToCollection`, `MapToCollectionFrom`
- Add `maxDepth` edge case tests (0 and 1) for `RecursiveToArrayFrom` and `MapToCollectionFrom`

## v1.4.2 - 2026-03-17

Add Laravel 13 to CI test matrix

## v1.4.1 - 2026-03-17

- Add Laravel 13 compatibility
- Update `illuminate/*` constraints to include `^13.0`
- Update `orchestra/testbench` constraint to include `^11.0`

## v1.4.0 - 2026-01-25

### What's New

#### New Macros

- **`compareCount`** - Compares the count of the collection with another countable and optionally zips them together
- **`onlyInts`** - Filters the collection to only integer values
- **`onlyStrings`** - Filters the collection to only string values with optional Stringable object conversion

#### Code Quality

- Added PHPStan (level 8) with Larastan for static analysis
- Added code coverage with pcov and Codecov integration
- Added PHPStan and Codecov badges to README

#### Improvements

- Added `$maxDepth` parameter to `mapToCollectionFrom` and `recursiveToArrayFrom` to prevent stack overflow on deeply nested structures (default: 512)
- Complete PHPDoc blocks for all macros with accurate descriptions and parameter documentation
- Comprehensive README with all 15 macros documented including parameter tables

#### Bug Fixes

- Fixed `Helper::count()` logic to use early returns
- Fixed `FirstAndLastKeyTest` calling wrong method

#### Internal

- Consolidated `IsArrayable` class into `Helper` class
- Added CLAUDE.md for AI assistance

## v1.3.0 - 2026-01-02

### Added

The following macro:

- explode

## v1.2.0 - 2026-01-02

### Added

The following macros:

- even
- firstAndLast
- firstAndLastKey
- odd

## v1.1.0 - 2025-12-29

### Added

The following macros:

- implodeToStringable
- joinToStringable

## v1.0.0 - 2025-12-28

- Initial release

### Added

The following macros:

- mapToCollection
- mapToCollectionFrom
- positive
- recursiveToArray
- recursiveToArray
