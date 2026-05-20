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

2. Install packages: `symfony composer require 2fa scheb/2fa-backup-code scheb/2fa-totp scheb/2fa-trusted-device endroid/qr-code`
   - If `Scheb\TwoFactorBundle\SchebTwoFactorBundle::class` is missing from `config/bundles.php`, add it: `Scheb\TwoFactorBundle\SchebTwoFactorBundle::class => ['all' => true]`

3. Copy from `./temp` into the project, preserving paths:
   - `config/packages/scheb_2fa.yaml`
   - `config/routes/scheb_2fa.yaml`

4. In `config/packages/security.yaml`, add inside the firewall definition:
```yaml
   two_factor:
       auth_form_path: 2fa_login
       check_path: 2fa_login_check
       trusted_parameter_name: _trusted
```
   Add to `access_control`:
```yaml
   - { route: '2fa_login', roles: IS_AUTHENTICATED_2FA_IN_PROGRESS }
   - { route: '2fa_login_check', roles: IS_AUTHENTICATED_2FA_IN_PROGRESS }
   - { route: 'user_2fa', roles: ROLE_USER }
   - { route: 'user_2fa_qrcode', roles: ROLE_USER }
   - { route: 'user_password', roles: ROLE_USER }
   - { route: 'user_profile', roles: ROLE_USER }
```

5. Copy from `./temp`, preserving directory structure:
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

6. Copy `src/EventListener` from `./temp` into the project's `src/` directory.

7. Copy all files from `./temp/src/Migrations/` into `src/Migrations/`, then run: `symfony console doctrine:migrations:migrate`

8. From the project root, remove the temp folder: `rm -rf ./temp`

9. Ask the user which optional features to remove, then apply:
   - No profile page: remove `src/Controller/User/ProfileController.php`, `templates/user/profile.html.twig`, and the profile navigation entry in `templates/user/_profile_navigation.html.twig`
   - No registration: remove `src/Controller/User/RegisterController.php`, `src/Message/User/RegisterUser.php`, `src/MessageHandler/User/RegisterUserHandler.php`, `templates/user/register.html.twig`
</steps>
