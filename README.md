# User management implementation

How to use:
* Copy each `User` folder from the respective `src/` folder into your own project.
* Copy `template/user` into your own project.
* Copy the `config/packages/security.yaml` into your own project.
* Copy the MySQL migration and run it.
* Copy the translations.
* Make sure you have following packages in your project:
    * symfony/validator
    * symfony/messenger
    * symfony/mailer
    * symfony/rate-limiter
  
* Check the config folder, mostly:
  * services.yaml
  * routes.yml (logout route)
  * packages/translation.yaml
  * bundles.php (TwigExtraBundle moet geactiveerd zijn)

To do:
* Remove originUsername from core bundle usermenu.html.twig
* Remove link to route "profile" from core bundle usermenu.html.twig
