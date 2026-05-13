# User management implementation

How to use this in your own project:

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

* Copy the migrations from `migrations/` into your own project.
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

---

## Azure SSO (optional)

This project includes optional Azure Entra ID (SSO) support via `hwi/oauth-bundle`.
Users can log in with their Microsoft account alongside — or instead of — local email/password accounts.

### Create an application in Azure

* Go to **[Azure Portal](https://portal.azure.com/)**
* Search for "App registrations"
* Click "New registration"
  * Name: the name of the application, e.g. the URL of the web application
  * Supported account types: select "Accounts in this organizational directory only (... only - Single tenant)"
  * Redirect URI — you will need to add extra URLs later on:
    * Platform: Web, URL: `https://<project>.wip/login/check-azure`
  * You will be redirected to the newly created app registration
  * Note down the **Application (client) ID** and **Directory (tenant) ID**
* Click "Redirect URIs" → "Add URI" and add all required URLs, then save. E.g.:
  * `https://<project>.wip/login/check-azure`
  * `https://<project>.phpXX.sumocoders.eu/login/check-azure`
* Click "Certificates & Secrets" → "New client secret"
  * Description: the URL of the web application
  * Expires: 12 months, or as long as you are comfortable with
  * Click "Add"
  * Note down the **Value** (the secret itself — the Secret ID is not needed)
* Provide the following to your integrator:
  * Application (client) ID
  * Directory (tenant) ID
  * Client secret Value

Full article: **[Register a Microsoft Entra app and create a service principal](https://learn.microsoft.com/en-us/entra/identity-platform/howto-create-service-principal-portal)**

### Allow the application to be used

When this is done, you still need to allow the users to use this application:

* Go to **[Azure Portal](https://portal.azure.com/)**
* Search for "App registrations"
* Select the newly created application
* Select "Manage → API Permissions" on the left
* Click "Grant admin consent for ..."

Full article: **[Grant tenant-wide admin consent to an application](https://learn.microsoft.com/en-us/azure/active-directory/manage-apps/grant-admin-consent?pivots=portal)**

### Configure the roles

* Go to the **[Azure Portal](https://portal.azure.com/)**
* Search for "App registrations"
* Select your application
* Click "Manage → App roles" on the left
* Create a role for each role in your application:
  * Display name: a readable label, e.g. "Admin"
  * Allowed member types: Both
  * Value: the Symfony role name, e.g. `ROLE_ADMIN`
  * Enable this app role: yes

Full article: **[Add app roles to your application and receive them in the token](https://learn.microsoft.com/en-us/azure/active-directory/develop/howto-add-app-roles-in-azure-ad-apps)**

### Give users a role

* Go to the **[Azure Portal](https://portal.azure.com/)**
* Search for "Microsoft Entra ID"
* Click "Manage → Enterprise applications" on the left
* Select your created application
* Select "Manage → Users and groups" on the left
* Add users/groups with the correct role

Full article: **[Assign users and groups to roles](https://learn.microsoft.com/en-us/azure/active-directory/develop/howto-add-app-roles-in-azure-ad-apps#assign-users-and-groups-to-roles)**

### Configure the application

#### Install the bundle

```
symfony composer require hwi/oauth-bundle
```

This will normally register the bundle automatically. If not, add it to `config/bundles.php`:

```php
HWI\Bundle\OAuthBundle\HWIOAuthBundle::class => ['all' => true],
```

#### Copy the files from this project

* `config/packages/hwi_oauth.yaml`
* `config/routes/hwi_oauth_routing.yaml`
* `src/Security/OAuth/AzureUserProvider.php`
* `src/Event/User/AzureLoginEvent.php`
* The `azure_object_id` parts from `src/Entity/User/User.php`:
  `azureObjectId` property, `createFromAzureProfile()`, `linkAzureAccount()`, `unlinkAzureAccount()`, `isAzureUser()`, `getAzureObjectId()`, `syncAzureRoles()`
* The `$azureClientId` and `$sumocodersClientId` constructor arguments and template variables from `src/Controller/User/LoginController.php`
* The "Sign in with Microsoft" buttons from `templates/user/login.html.twig`
* The `migrations/Version20260512135528.php` migration

#### Add the env variables

Add the following to your `.env.local` file:

```
###> hwi/oauth-bundle ###
AZURE_CLIENT_ID=
AZURE_CLIENT_SECRET=
AZURE_TENANT_ID=
AZURE_ALLOWED_EMAIL_DOMAIN=   # e.g. sumocoders.be — leave empty to allow any domain

SUMOCODERS_CLIENT_ID=
SUMOCODERS_CLIENT_SECRET=
SUMOCODERS_TENANT_ID=
###< hwi/oauth-bundle ###
```

#### Update security.yaml

Add the `oauth` block to your main firewall and the public access routes:

```yaml
firewalls:
    main:
        # ... existing config ...
        entry_point: App\Security\CustomAuthenticator
        oauth:
            resource_owners:
                azure: /login/check-azure
                sumocoders: /login/check-sumocoders
            login_path: /login
            failure_path: /login
            oauth_user_provider:
                service: App\Security\OAuth\AzureUserProvider

access_control:
    - { path: '^/login/check-azure', roles: PUBLIC_ACCESS }
    - { path: '^/login/check-sumocoders', roles: PUBLIC_ACCESS }
    - { path: '^/connect/', roles: PUBLIC_ACCESS }
    # ... existing rules ...
```


#### Run the migration

The `azure_object_id` column is added via a dedicated migration so projects that do not need Azure SSO can skip it:

```
symfony console doctrine:migrations:migrate
```

### SumoCoders login (optional)

To allow SumoCoders developers to log in with their `@sumocoders.be` accounts, a second Azure app registration is needed in the SumoCoders tenant. This is separate from the client's app registration.

Add the following redirect URIs to the SumoCoders app registration in the Azure Portal:

* `https://<project>.wip/login/check-sumocoders`
* `https://<project>.phpXX.sumocoders.eu/login/check-sumocoders`

> Replace `<project>` with the project name.

Add the credentials to `.env.local`:

```
SUMOCODERS_CLIENT_ID=
SUMOCODERS_CLIENT_SECRET=
SUMOCODERS_TENANT_ID=
```

The "Sign in with Microsoft (SumoCoders)" button appears automatically on the login page when `SUMOCODERS_CLIENT_ID` is set. Leave it empty to hide the button.
