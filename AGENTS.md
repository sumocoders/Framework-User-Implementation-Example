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
1. From the project root, clone the reference repository: `git clone https://github.com/sumocoders/Framework-User-Implementation-Example.git ./temp`. 
   And checkout the `HWIOAuthBundle-implementation` branch: `git -C ./temp checkout HWIOAuthBundle-implementation`.

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

10. Ask the user which optional features to remove (this must be settled before the Azure steps below, since it affects which files/routes those steps touch):
   - **Profile page**: remove `src/Controller/User/ProfileController.php`, `templates/user/profile.html.twig`, and the profile navigation entry in `templates/user/_profile_navigation.html.twig`
   - **Registration**: remove `src/Controller/User/RegisterController.php`, `src/Message/User/RegisterUser.php`, `src/MessageHandler/User/RegisterUserHandler.php`, `templates/user/register.html.twig`

11. Ask the user whether they want Azure Entra ID (SSO) login support. If not, skip to step 21.

12. Set up the Azure app registration(s) manually in the Azure Portal (https://portal.azure.com/) before continuing — the env vars in step 19 cannot be filled in without this:
    - Go to "App registrations" → "New registration": name it after the application, set "Supported account types" to single tenant, and add a Redirect URI (platform Web) such as `https://project.client.wip/login/check-azure`
    - Note down the **Application (client) ID** and **Directory (tenant) ID** from the created registration
    - Go to "Redirect URIs" → "Add URI" and add every environment's callback URL, e.g. `https://project.client.wip/login/check-azure` and `https://project.client.phpXX.sumocoders.eu/login/check-azure`
    - Go to "Certificates & Secrets" → "New client secret" and note down the **Value** (not the Secret ID)
    - Go to "Manage → API Permissions" → "Grant admin consent for ..."
    - Go to "Manage → App roles" and create one role per Symfony role that should be usable (Value = the Symfony role name, e.g. `ROLE_ADMIN`)
    - Go to "Microsoft Entra ID" → "Enterprise applications" → the app → "Users and groups" and assign users/groups to the roles
    - If SumoCoders-login is also wanted: repeat this whole step for a second, separate app registration in the SumoCoders tenant, with its own redirect URIs ending in `/login/check-sumocoders`

13. Install the bundle: `symfony composer require hwi/oauth-bundle`
    - If `HWI\Bundle\OAuthBundle\HWIOAuthBundle::class` is missing from `config/bundles.php`, add it: `HWI\Bundle\OAuthBundle\HWIOAuthBundle::class => ['all' => true]`

14. Copy from `./temp` into the project, preserving paths:
    - `config/packages/hwi_oauth.yaml`
    - `config/routes/hwi_oauth_routing.yaml`
    - `src/Security/OAuth/AzureUserProvider.php`
    - `src/Event/User/AzureLoginEvent.php`
    - `migrations/Version20260512135528.php`

15. In `src/Entity/User/User.php`, copy from `./temp`: the `azureObjectId` property and the methods `createFromAzureProfile()`, `linkAzureAccount()`, `unlinkAzureAccount()`, `isAzureUser()`, `getAzureObjectId()`, `syncAzureRoles()`

16. In `src/Controller/User/LoginController.php`, copy from `./temp`: the `$azureClientId` and `$sumocodersClientId` constructor arguments and the template variables that pass them to the view

17. In `templates/user/login.html.twig`, copy from `./temp`: the "Sign in with Microsoft" buttons

18. From the project root, remove the temp folder: `rm -rf ./temp`

19. In `config/packages/security.yaml`, add inside the `main` firewall:
    ```yaml
    entry_point: App\Security\CustomAuthenticator
    oauth:
        resource_owners:
            azure: /login/check-azure
            sumocoders: /login/check-sumocoders
        login_path: /login
        failure_path: /login
        oauth_user_provider:
            service: App\Security\OAuth\AzureUserProvider
    ```
    Add to `access_control` (before existing rules):
    ```yaml
    - { path: '^/login/check-azure', roles: PUBLIC_ACCESS }
    - { path: '^/login/check-sumocoders', roles: PUBLIC_ACCESS }
    - { path: '^/connect/', roles: PUBLIC_ACCESS }
    ```

20. Add to `.env.local`, filled in with the values noted down in step 12:
    ```
    ###> hwi/oauth-bundle ###
    AZURE_CLIENT_ID=
    AZURE_CLIENT_SECRET=
    AZURE_TENANT_ID=

    SUMOCODERS_CLIENT_ID=
    SUMOCODERS_CLIENT_SECRET=
    SUMOCODERS_TENANT_ID=
    ###< hwi/oauth-bundle ###
    ```

21. Run: `symfony console doctrine:migrations:migrate`

22. `AzureUserProvider.php` auto-provisions a local user for any Azure account that authenticates, regardless of email domain. Ask the user whether auto-provisioning should be restricted to one email domain. If so:
    - Add an `AZURE_ALLOWED_DOMAIN` env var (`.env` and `.env.local`)
    - In `AzureUserProvider::loadUserByOAuthUserResponse()`, before the "No match — auto-provision" block, add a case-insensitive `str_ends_with()` check of the email domain against `AZURE_ALLOWED_DOMAIN`; throw an `AccessDeniedException` on mismatch
    - Update `tests/Security/OAuth/AzureUserProviderTest.php` to cover the allowed and rejected domain cases

23. Ask the user whether local email/password login should remain available as a fallback, or whether Azure SSO is meant to be the only login method. `templates/user/login.html.twig` hides the local form entirely whenever `azure_login_enabled` is true, and Azure-provisioned users never get a local password (`User::createFromAzureProfile()` never calls `setPassword()`), so once SSO is exclusive the following become dead code. If the user confirms SSO-only, remove:
    - `src/Controller/User/ForgotPasswordController.php`, `ResetPasswordController.php`, `ResendConfirmationController.php`, `ConfirmController.php`, and their templates (`templates/user/forgot.html.twig`, `reset.html.twig`, `confirm.html.twig`, `templates/user/mails/`)
    - `src/Controller/User/Profile/PasswordController.php`, `EmailController.php`, `TwoFactorController.php`, `TwoFactorQrCodeController.php`, and their templates
    - `src/Controller/User/Admin/AddUserController.php` (users self-provision via Azure; roles come from `syncAzureRoles()`)
    - the `two_factor` block, `scheb_2fa` bundle/config/routes, and every affected `access_control` entry (`2fa_login`, `2fa_login_check`, `user_2fa`, `user_2fa_qrcode`, `user_password`, `user_resend_confirmation`, `user_confirm`, `user_reset_password`) from `security.yaml`
    - the matching test files under `tests/Controller/User/` and `tests/Entity/User/` (password/2FA/confirmation coverage)
    If local login must stay as a fallback (e.g. break-glass access), skip this step entirely.

24. Run `symfony php vendor/bin/phpstan analyse`, `vendor/bin/mago lint`, `vendor/bin/mago analyse`, and the project's test suite. Fix issues surfaced by the integration, including known ones:
    - Paginator usages missing their generic type annotation (`@var Paginator<User>` or equivalent).
    - An orphaned `RegisterType` left behind if registration was excluded in step 10.
</steps>
