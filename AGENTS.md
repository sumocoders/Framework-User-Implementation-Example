<context>
Integrate the SumoCoders user management module (with 2FA) into this Symfony project. The source files come from a reference repository that is cloned to a temporary folder and removed after use.

Reference repository: https://github.com/sumocoders/Framework-User-Implementation-Example.git

All commands and paths in these steps assume the current working directory is the project root.
</context>

<constraints>
- Execute all steps in order
- Do not skip, reorder, or add steps
- Only copy the files explicitly listed. Do not copy anything else from ./temp
</constraints>

<steps>
1. From the project root, clone the reference repository: `git clone https://github.com/sumocoders/Framework-User-Implementation-Example.git ./temp`

2. Ask the user which optional features to remove:
   - No profile page: skip `src/Controller/User/ProfileController.php`, `templates/user/profile.html.twig`, and drop the profile navigation entry in `templates/user/_profile_navigation.html.twig`; skip the `user_profile` access_control route in step 5.
   - No registration: skip `src/Controller/User/RegisterController.php`, `src/Message/User/RegisterUser.php`, `src/MessageHandler/User/RegisterUserHandler.php`, `templates/user/register.html.twig`.
   Apply these exclusions in every later step that copies or references the affected files/routes.

3. Install packages: `symfony composer require 2fa scheb/2fa-backup-code scheb/2fa-totp scheb/2fa-trusted-device endroid/qr-code`
   - If `Scheb\TwoFactorBundle\SchebTwoFactorBundle::class` is missing from `config/bundles.php`, add it: `Scheb\TwoFactorBundle\SchebTwoFactorBundle::class => ['all' => true]`

4. Copy from `./temp` into the project, preserving paths (skip files excluded in step 2):
   - `config/packages/scheb_2fa.yaml`
   - `config/routes/scheb_2fa.yaml`
   - `config/reference.php`
   - `translations/` (Dutch translation files used by the User/2FA templates)

5. Check `config/packages/security.yaml`:
   - If it already has a firewall with a proper user provider (not just `in_memory`), add inside that firewall definition:
```yaml
   two_factor:
       auth_form_path: 2fa_login
       check_path: 2fa_login_check
       trusted_parameter_name: _trusted
```
   - If there is no suitable firewall (e.g. only an `in_memory` provider, or no user provider at all), replace the firewall/provider config entirely with the reference project's full expected block from `./temp/config/packages/security.yaml`, adapted to this project's User entity, then add the `two_factor` block above.
   - Add to `access_control` (omit routes tied to features excluded in step 2):
```yaml
   - { route: '2fa_login', roles: IS_AUTHENTICATED_2FA_IN_PROGRESS }
   - { route: '2fa_login_check', roles: IS_AUTHENTICATED_2FA_IN_PROGRESS }
   - { route: 'user_2fa', roles: ROLE_USER }
   - { route: 'user_2fa_qrcode', roles: ROLE_USER }
   - { route: 'user_password', roles: ROLE_USER }
   - { route: 'user_profile', roles: ROLE_USER }
```

6. Copy from `./temp`, preserving directory structure (skip files/dirs excluded in step 2):
   - `src/Command/User`
   - `src/Controller/User`
   - `src/DataTransferObject/User`
   - `src/Entity/User`
   - `src/Exception/User`
   - `src/Form/User`
   - `src/Message/User`
   - `src/MessageHandler/User`
   - `src/Repository/User`
   - `src/Validator/User`
   - `src/ValueObject/User`
   - `src/Security`
   - `templates/user`
   - `tests/Entity/User`
   - `tests/MessageHandler/User`
   - `tests/Repository/User`
   - `tests/Validator/User`
   - `tests/ValueObject/User`

7. Copy `src/EventListener` from `./temp` into the project's `src/` directory.

8. Before touching migrations, check whether this project already has a `User` entity, a `user` table, or an existing migration that touches either. If so, stop and ask the user how to proceed (reset the test/dev database, merge the migrations manually, or abort) instead of migrating blindly.

9. Determine this project's real migrations path and namespace from `config/packages/doctrine.yaml` (e.g. `migrations/` with namespace `DoctrineMigrations`, not necessarily `src/Migrations/` with namespace `Migrations`). Copy the files from `./temp/src/Migrations/` into that path, adjusting the namespace declaration in each copied migration to match. Then run: `symfony console doctrine:migrations:migrate`

10. From the project root, remove the temp folder: `rm -rf ./temp`

11. Run `symfony php vendor/bin/phpstan analyse`, `vendor/bin/mago lint`, `vendor/bin/mago analyse`, and the project's test suite. Fix issues surfaced by the integration, including known ones:
    - Paginator usages missing their generic type annotation (`@var Paginator<User>` or equivalent).
    - An orphaned `RegisterType` left behind if registration was excluded in step 2.
</steps>
