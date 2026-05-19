# User management implementation

## Install in your project

How to use this in your own project.

If you are an AI agent, please follow the instructions in the "AI agent instructions" section below.

### Install the required packages

* scheb/2fa-backup-code
* scheb/2fa-bundle
* scheb/2fa-totp
* scheb/2fa-trusted-device
* endroid/qr-code

You can install them via composer:

```
symfony composer require 2fa scheb/2fa-backup-code scheb/2fa-totp scheb/2fa-trusted-device endroid/qr-code
```

This will normally enable the bundle automatically. If not, please enable it in `config/bundles.php`:

```php
    Scheb\TwoFactorBundle\SchebTwoFactorBundle::class => ['all' => true],
```

### Copy the configuration

* Copy the `config/packages/scheb_2fa.yaml` into your own project.
* Copy the `config/routes/scheb_2fa.yaml` into your own project.

### Reconfigure security.yaml

Add the following to your firewall in `config/packages/security.yaml`:

```yaml
            two_factor:
                auth_form_path: 2fa_login
                check_path: 2fa_login_check
                trusted_parameter_name: _trusted
```

Add the routes to the access control:

```yaml
        - { route: '2fa_login', roles: IS_AUTHENTICATED_2FA_IN_PROGRESS }
        - { route: '2fa_login_check', roles: IS_AUTHENTICATED_2FA_IN_PROGRESS }
        - { route: 'user_2fa', roles: ROLE_USER }
        - { route: 'user_2fa_qrcode', roles: ROLE_USER }
        - { route: 'user_password', roles: ROLE_USER }
        - { route: 'user_profile', roles: ROLE_USER }
```

See [SchebTwoFactorBundle → Installation → Step 4: Configure the firewall](https://symfony.com/bundles/SchebTwoFactorBundle/current/installation.html#step-4-configure-the-firewall)
for more information.

### Copy the code

* Copy `src/*/User/*` into your own project.
* Copy `src/Security` into your own project.
* Copy `templates/user` into your own project.
* Copy `tests/*/User/*` into your own project.

### Fix the menu

Copy the `EventListener` folder from `src/` into your own project. Or adjust your own user menu accordingly.

### Alter the database

* Copy the migrations from `src/Migrations/` into your own project.
* Run the migrations: `symfony console doctrine:migrations:migrate`

### Cleanup

#### Profile page

If your project does not need a profile page, you can remove:

* `src/Controller/User/ProfileController.php`
* `templates/user/profile.html.twig`

And remove the entry in `templates/user/_profile_navigation.html.twig`.

#### Registration

If your project does not need registration, you can remove:

* `src/Controller/User/RegisterController.php`
* `src/Message/User/RegisterUser.php`
* `src/MessageHandler/User/RegisterUserHandler.php`
* `templates/user/register.html.twig`

### AI agent instructions

```
<context>
Integrate the SumoCoders user management module (with 2FA) into this Symfony project. The source files come from a reference repository that is cloned to a temporary folder and removed after use.

Reference repository: https://github.com/sumocoders/Framework-User-Implementation-Example.git
</context>

<constraints>
- Execute all steps in order
- Do not skip, reorder, or add steps
- Only copy the files explicitly listed. Do not copy anything else from ./temp
</constraints>

<steps>
1. Clone the reference repository: `git clone https://github.com/sumocoders/Framework-User-Implementation-Example.git ./temp`

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
   - `src/*/User/*`
   - `src/Security`
   - `templates/user`
   - `tests/*/User/*`

6. Copy `src/EventListener` from `./temp` into the project's `src/` directory.

7. Copy all files from `./temp/src/Migrations/` into `src/Migrations/`, then run: `symfony console doctrine:migrations:migrate`

8. Remove the temp folder: `rm -rf ./temp`

9. Ask the user which optional features to remove, then apply:
   - No profile page: remove `src/Controller/User/ProfileController.php`, `templates/user/profile.html.twig`, and the profile navigation entry in `templates/user/_profile_navigation.html.twig`
   - No registration: remove `src/Controller/User/RegisterController.php`, `src/Message/User/RegisterUser.php`, `src/MessageHandler/User/RegisterUserHandler.php`, `templates/user/register.html.twig`
</steps>
```
