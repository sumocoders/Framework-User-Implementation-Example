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

7. Copy all files from `./temp/migrations/` into `migrations/`, then run: `symfony console doctrine:migrations:migrate`

8. From the project root, remove the temp folder: `rm -rf ./temp`

9. If the user wants Azure Entra ID (SSO) login support, perform all of the following sub-steps; otherwise skip to step 10:
   a. Install the bundle: `symfony composer require hwi/oauth-bundle`
      - If `HWI\Bundle\OAuthBundle\HWIOAuthBundle::class` is missing from `config/bundles.php`, add it: `HWI\Bundle\OAuthBundle\HWIOAuthBundle::class => ['all' => true]`
   b. Copy from `./temp` into the project, preserving paths:
      - `config/packages/hwi_oauth.yaml`
      - `config/routes/hwi_oauth_routing.yaml`
      - `src/Security/OAuth/AzureUserProvider.php`
      - `src/Event/User/AzureLoginEvent.php`
      - `migrations/Version20260512135528.php`
   c. In `src/Entity/User/User.php`, copy from `./temp`: the `azureObjectId` property and the methods `createFromAzureProfile()`, `linkAzureAccount()`, `unlinkAzureAccount()`, `isAzureUser()`, `getAzureObjectId()`, `syncAzureRoles()`
   d. In `src/Controller/User/LoginController.php`, copy from `./temp`: the `$azureClientId` and `$sumocodersClientId` constructor arguments and the template variables that pass them to the view
   e. In `templates/user/login.html.twig`, copy from `./temp`: the "Sign in with Microsoft" buttons
   f. From the project root, remove the temp folder: `rm -rf ./temp`
   g. In `config/packages/security.yaml`, add inside the `main` firewall:
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
   h. Add to `.env.local`:
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
   i. Run: `symfony console doctrine:migrations:migrate`

10. Ask the user which optional features to remove, then apply:

   **Profile page**: remove `src/Controller/User/ProfileController.php`, `templates/user/profile.html.twig`, and the profile navigation entry in `templates/user/_profile_navigation.html.twig`

   **Registration**: remove `src/Controller/User/RegisterController.php`, `src/Message/User/RegisterUser.php`, `src/MessageHandler/User/RegisterUserHandler.php`, `templates/user/register.html.twig`
</steps>
