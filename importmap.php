<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    'tom-select' => [
        'version' => '2.4.5',
    ],
    '@orchidjs/sifter' => [
        'version' => '1.1.0',
    ],
    '@orchidjs/unicode-variants' => [
        'version' => '1.1.2',
    ],
    'tom-select/dist/css/tom-select.default.min.css' => [
        'version' => '2.4.5',
        'type' => 'css',
    ],
    'tom-select/dist/css/tom-select.default.css' => [
        'version' => '2.4.5',
        'type' => 'css',
    ],
    'tom-select/dist/css/tom-select.bootstrap4.css' => [
        'version' => '2.4.5',
        'type' => 'css',
    ],
    'tom-select/dist/css/tom-select.bootstrap5.css' => [
        'version' => '2.4.5',
        'type' => 'css',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.23',
    ],
    'sumocoders/Clipboard' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/clipboard_controller.js',
    ],
    'sumocoders/SidebarCollapsable' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/sidebar_collapsable_controller.js',
    ],
    'sumocoders/Toast' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/toast_controller.js',
    ],
    'sumocoders/addToast' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/js/toast.js',
    ],
    'sumocoders/cookie' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/js/cookie.js',
    ],
    'sumocoders/Theme' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/theme_controller.js',
    ],
    'sumocoders/Tooltip' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/tooltip_controller.js',
    ],
    'sumocoders/DateTimePicker' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/date_time_picker_controller.js',
    ],
    'sumocoders/Tabs' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/tabs_controller.js',
    ],
    'sumocoders/PasswordStrengthChecker' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/password_strength_checker_controller.js',
    ],
    'sumocoders/TogglePassword' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/toggle_password_controller.js',
    ],
    'sumocoders/FormCollection' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/form_collection_controller.js',
    ],
    'sumocoders/debounce' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/js/debounce.js',
    ],
    'sumocoders/ScrollToTop' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/scroll_to_top_controller.js',
    ],
    'sumocoders/Popover' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/popover_controller.js',
    ],
    'sumocoders/ajax_client' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/js/ajax_client.js',
    ],
    'sumocoders/Confirm' => [
        'path' => './vendor/sumocoders/framework-core-bundle/assets-public/controllers/confirm_controller.js',
    ],
    'bootstrap' => [
        'version' => '5.3.8',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.8',
        'type' => 'css',
    ],
    'flatpickr' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/flatpickr.css' => [
        'version' => '4.6.13',
        'type' => 'css',
    ],
    'flatpickr/dist/themes/airbnb.css' => [
        'version' => '4.6.13',
        'type' => 'css',
    ],
    'flatpickr/dist/l10n/at.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/cs.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/da.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/nl.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/et.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/fi.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/fr.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/de.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/gr.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/lv.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/lt.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/it.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/no.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/pl.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/pt.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/sk.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/sv.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/es.js' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/l10n/sl.js' => [
        'version' => '4.6.13',
    ],
    'sortablejs' => [
        'version' => '1.15.6',
    ],
    'axios' => [
        'version' => '1.13.4',
    ],
    '@stimulus-components/clipboard' => [
        'version' => '5.0.0',
    ],
    'flatpickr/dist/flatpickr.min.css' => [
        'version' => '4.6.13',
        'type' => 'css',
    ],
];
