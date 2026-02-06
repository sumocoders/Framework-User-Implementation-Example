# User management implementation

How to use this in your own project:

### Install the required packages

* scheb/2fa-backup-code
* scheb/2fa-bundle
* scheb/2fa-totp
* endroid/qr-code

You can install them via composer:

```symfony composer require 2fa scheb/2fa-backup-code scheb/2fa-totp endroid/qr-code```

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
                auth_form_path: 2fa_login    # The route name you have used in the routes.yaml
                check_path: 2fa_login_check  # The route name you have used in the routes.yaml
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
