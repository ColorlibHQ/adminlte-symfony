# Releasing

`colorlibhq/adminlte-symfony` is distributed via [Packagist](https://packagist.org).
There is **no build step** — the git tag *is* the release. Packagist serves a git
archive (slimmed by `.gitattributes` `export-ignore`).

## One-time setup

1. Create the repo and push:
   ```bash
   gh repo create ColorlibHQ/adminlte-symfony --public --source=. --remote=origin --push
   ```
2. Register on Packagist: submit `https://github.com/ColorlibHQ/adminlte-symfony`
   at <https://packagist.org/packages/submit>, **or** install the
   [Packagist GitHub App](https://github.com/apps/packagist) on the repo so new
   tags auto-publish (recommended — matches the Laravel port).

## Cutting a release

1. Make sure the suite is green and the changelog is updated:
   ```bash
   composer check          # php-cs-fixer + phpstan + phpunit
   ```
2. Update `CHANGELOG.md` (move "Unreleased" → the new version).
3. Tag and push (SemVer, `v` prefix to match the other ports):
   ```bash
   git tag v0.2.0
   git push origin main --tags
   ```
4. Packagist publishes the new version automatically within seconds. Verify at
   <https://packagist.org/packages/colorlibhq/adminlte-symfony>.

## Notes

- The package requires PHP 8.4+ and Symfony 8.1+; CI (`.github/workflows/tests.yml`)
  runs the full `composer check` on PHP 8.4 and 8.5.
- `composer.json` has **no `version` field** on purpose — Composer derives it from
  the git tag.
