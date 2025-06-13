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
    'tom-select' => [
        'version' => '2.4.3',
    ],
    '@orchidjs/sifter' => [
        'version' => '1.1.0',
    ],
    '@orchidjs/unicode-variants' => [
        'version' => '1.1.2',
    ],
    'tom-select/dist/css/tom-select.default.min.css' => [
        'version' => '2.4.3',
        'type' => 'css',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.13',
    ],
    'bootstrap' => [
        'version' => '5.3.6',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.6',
        'type' => 'css',
    ],
    '@fortawesome/fontawesome-free/css/all.css' => [
        'version' => '6.7.2',
        'type' => 'css',
    ],
    'tom-select/dist/css/tom-select.default.css' => [
        'version' => '2.4.3',
        'type' => 'css',
    ],
    'tom-select/dist/css/tom-select.bootstrap5.css' => [
        'version' => '2.4.3',
        'type' => 'css',
    ],
    'flatpickr' => [
        'version' => '4.6.13',
    ],
    'flatpickr/dist/flatpickr.min.css' => [
        'version' => '4.6.13',
        'type' => 'css',
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
        'version' => '1.9.0',
    ],
    '@stimulus-components/clipboard' => [
        'version' => '5.0.0',
    ],
];
