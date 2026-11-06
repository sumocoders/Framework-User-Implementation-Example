<?php

// This file is auto-generated and is for apps only. Bundles SHOULD NOT rely on its content.

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Config\Loader\ParamConfigurator as Param;

/**
 * This class provides array-shapes for configuring the services and bundles of an application.
 *
 * Services declared with the config() method below are autowired and autoconfigured by default.
 *
 * This is for apps only. Bundles SHOULD NOT use it.
 *
 * Example:
 *
 *     ```php
 *     // config/services.php
 *     namespace Symfony\Component\DependencyInjection\Loader\Configurator;
 *
 *     return App::config([
 *         'services' => [
 *             'App\\' => [
 *                 'resource' => '../src/',
 *             ],
 *         ],
 *     ]);
 *     ```
 *
 * @psalm-type ImportsConfig = list<string|array{
 *     resource: string,
 *     type?: string|null,
 *     ignore_errors?: bool|'not_found',
 * }>
 * @psalm-type ParametersConfig = array<string, scalar|\UnitEnum|array<scalar|\UnitEnum|array<mixed>|Param|null>|Param|null>
 * @psalm-type ArgumentsType = list<mixed>|array<string, mixed>
 * @psalm-type CallType = array<string, ArgumentsType>|array{0:string, 1?:ArgumentsType, 2?:bool}|array{method:string, arguments?:ArgumentsType, returns_clone?:bool}
 * @psalm-type TagsType = list<string|array<string, array<string, mixed>>> // arrays inside the list must have only one element, with the tag name as the key
 * @psalm-type CallbackType = string|array{0:string|ReferenceConfigurator,1:string}|\Closure|ReferenceConfigurator|ExpressionConfigurator
 * @psalm-type DeprecationType = array{package: string, version: string, message?: string}
 * @psalm-type DefaultsType = array{
 *     public?: bool,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 * }
 * @psalm-type InstanceofType = array{
 *     shared?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     factory?: CallbackType,
 *     properties?: array<string, mixed>,
 *     configurator?: CallbackType,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 * }
 * @psalm-type DefinitionType = array{
 *     class?: string,
 *     file?: string,
 *     parent?: string,
 *     shared?: bool,
 *     synthetic?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     abstract?: bool,
 *     deprecated?: DeprecationType,
 *     factory?: CallbackType,
 *     configurator?: CallbackType,
 *     arguments?: ArgumentsType,
 *     properties?: array<string, mixed>,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     decorates?: string,
 *     decorates_tag?: string,
 *     decoration_within?: string|list<string>,
 *     decoration_around?: string|list<string>,
 *     decoration_inner_name?: string,
 *     decoration_priority?: int,
 *     decoration_on_invalid?: 'exception'|'ignore'|null,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 *     from_callable?: CallbackType,
 * }
 * @psalm-type AliasType = string|array{
 *     alias: string,
 *     public?: bool,
 *     deprecated?: DeprecationType,
 * }
 * @psalm-type PrototypeType = array{
 *     resource: string,
 *     namespace?: string,
 *     exclude?: string|list<string>,
 *     parent?: string,
 *     shared?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     abstract?: bool,
 *     deprecated?: DeprecationType,
 *     factory?: CallbackType,
 *     arguments?: ArgumentsType,
 *     properties?: array<string, mixed>,
 *     configurator?: CallbackType,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 * }
 * @psalm-type StackType = array{
 *     stack: list<DefinitionType|AliasType|PrototypeType|array<class-string, ArgumentsType|null>>,
 *     public?: bool,
 *     deprecated?: DeprecationType,
 *     decorates?: string,
 *     decorates_tag?: string,
 *     decoration_within?: string|list<string>,
 *     decoration_around?: string|list<string>,
 *     decoration_inner_name?: string,
 *     decoration_priority?: int,
 *     decoration_on_invalid?: 'exception'|'ignore'|null,
 * }
 * @psalm-type ServicesConfig = array{
 *     _defaults?: DefaultsType,
 *     _instanceof?: array<class-string, InstanceofType>,
 *     ...<string, DefinitionType|AliasType|PrototypeType|StackType|ArgumentsType|null>
 * }
 * @psalm-type ExtensionType = array<mixed>|scalar|\UnitEnum|Param|null
 * @psalm-type RouterConfig = bool|array{
 *     enabled?: bool|Param, // Default: false
 *     resource?: scalar|Param|null, // Default: null
 *     type?: scalar|Param|null,
 *     default_uri?: scalar|Param|null, // The default URI used to generate URLs in a non-HTTP context. // Default: null
 *     http_port?: scalar|Param|null, // Default: 80
 *     https_port?: scalar|Param|null, // Default: 443
 *     strict_requirements?: scalar|Param|null, // Set to true to throw an exception when a parameter does not match the requirements. Set to false to disable exceptions when a parameter does not match the requirements (and return null instead). Set to null to disable parameter checks against requirements. Defaults to true in debug mode and to null otherwise.
 *     utf8?: bool|Param, // Default: true
 * }
 * @psalm-type CacheConfig = array{
 *     prefix_seed?: scalar|Param|null, // Used to namespace cache keys when using several apps with the same shared backend. // Default: "_%kernel.project_dir%.%kernel.container_class%"
 *     app?: scalar|Param|null, // App related cache pools configuration. Cannot be combined with "default_provider". // Default: "cache.adapter.filesystem"
 *     system?: scalar|Param|null, // System related cache pools configuration. // Default: "cache.adapter.system"
 *     directory?: scalar|Param|null, // Default: "%kernel.share_dir%/pools/app"
 *     default_provider?: scalar|Param|null, // DSN of the backend to use for "cache.app"; the adapter is deduced from it. Replaces "app", which cannot be set alongside it.
 *     default_psr6_provider?: scalar|Param|null,
 *     default_redis_provider?: scalar|Param|null, // Default: "redis://localhost"
 *     default_valkey_provider?: scalar|Param|null, // Default: "valkey://localhost"
 *     default_memcached_provider?: scalar|Param|null, // Default: "memcached://localhost"
 *     default_doctrine_dbal_provider?: scalar|Param|null, // Default: "database_connection"
 *     default_pdo_provider?: scalar|Param|null, // Default: null
 *     default_mongodb_provider?: scalar|Param|null, // Default: "mongodb://localhost/app"
 *     pools?: array<string, array{ // Default: []
 *         adapters?: Param|string|list<scalar|Param|null>,
 *         tags?: scalar|Param|null, // Default: null
 *         public?: bool|Param, // Default: false
 *         default_lifetime?: scalar|Param|null, // Default lifetime of the pool.
 *         provider?: scalar|Param|null, // Overwrite the setting from the default provider for this adapter.
 *         early_expiration_message_bus?: scalar|Param|null,
 *         clearer?: scalar|Param|null,
 *         marshaller?: scalar|Param|null, // The marshaller service to use for this pool.
 *     }>,
 * }
 * @psalm-type AssetConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     strict_mode?: bool|Param, // Throw an exception if an entry is missing from the manifest.json. // Default: false
 *     version_strategy?: scalar|Param|null, // Default: null
 *     version?: scalar|Param|null, // Default: null
 *     version_format?: scalar|Param|null, // Default: "%%s?%%s"
 *     json_manifest_path?: scalar|Param|null, // Default: null
 *     base_path?: scalar|Param|null, // Default: ""
 *     base_urls?: Param|string|list<scalar|Param|null>,
 *     packages?: array<string, array{ // Default: []
 *         strict_mode?: bool|Param, // Throw an exception if an entry is missing from the manifest.json. // Default: false
 *         version_strategy?: scalar|Param|null, // Default: null
 *         version?: scalar|Param|null,
 *         version_format?: scalar|Param|null, // Default: null
 *         json_manifest_path?: scalar|Param|null, // Default: null
 *         base_path?: scalar|Param|null, // Default: ""
 *         base_urls?: Param|string|list<scalar|Param|null>,
 *     }>,
 * }
 * @psalm-type ValidationConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     enable_attributes?: bool|Param, // Default: true
 *     static_method?: Param|string|list<scalar|Param|null>,
 *     translation_domain?: scalar|Param|null, // Default: "validators"
 *     email_validation_mode?: "html5"|"html5-allow-no-tld"|"strict"|Param, // Default: "html5"
 *     mapping?: array{
 *         paths?: list<scalar|Param|null>,
 *     },
 *     not_compromised_password?: bool|array{
 *         enabled?: bool|Param|null, // When disabled, compromised passwords will be accepted as valid. Defaults to false when "framework.test" is enabled, to true otherwise. // Default: null
 *         endpoint?: scalar|Param|null, // API endpoint for the NotCompromisedPassword Validator. // Default: null
 *     },
 *     disable_translation?: bool|Param, // Default: false
 *     property_metadata_existence_check?: bool|Param, // When enabled, validateProperty() and validatePropertyValue() throw an exception if no metadata is found for the given property. // Default: false
 *     auto_mapping?: array<string, array{ // Default: []
 *         services?: list<scalar|Param|null>,
 *     }>,
 * }
 * @psalm-type TranslationConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     fallbacks?: Param|string|list<scalar|Param|null>,
 *     logging?: bool|Param, // Default: false
 *     formatter?: scalar|Param|null, // Default: "translator.formatter.default"
 *     cache_dir?: scalar|Param|null, // Default: "%kernel.cache_dir%/translations"
 *     default_path?: scalar|Param|null, // The default path used to load translations. // Default: "%kernel.project_dir%/translations"
 *     paths?: list<scalar|Param|null>,
 *     pseudo_localization?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         accents?: bool|Param, // Default: true
 *         expansion_factor?: float|Param, // Default: 1.0
 *         brackets?: bool|Param, // Default: true
 *         parse_html?: bool|Param, // Default: false
 *         localizable_html_attributes?: list<scalar|Param|null>,
 *     },
 *     providers?: array<string, array{ // Default: []
 *         dsn?: scalar|Param|null,
 *         domains?: array<string, scalar|Param|null>,
 *         locales?: list<scalar|Param|null>,
 *     }>,
 *     globals?: array<string, Param|string|array{ // Default: []
 *         value?: mixed,
 *         message?: string|Param,
 *         parameters?: array<string, scalar|Param|null>,
 *         domain?: string|Param,
 *     }>,
 * }
 * @psalm-type MessengerConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     routing?: array<string, Param|string|list<scalar|Param|null>>,
 *     serializer?: array{
 *         default_serializer?: scalar|Param|null, // Service id to use as the default serializer for the transports. // Default: "messenger.transport.native_php_serializer"
 *         signing_secret?: Param|string|list<scalar|Param|null>,
 *         symfony_serializer?: array{
 *             service?: scalar|Param|null, // Service id of the Symfony serializer behind the messenger.transport.symfony_serializer service, e.g. "serializer.api" for the named serializer "api". // Default: null
 *             format?: scalar|Param|null, // Serialization format for the messenger.transport.symfony_serializer service (which is not the serializer used by default). // Default: "json"
 *             context?: array<string, mixed>,
 *         },
 *     },
 *     transports?: array<string, Param|string|array{ // Default: []
 *         dsn?: scalar|Param|null,
 *         serializer?: scalar|Param|null, // Service id of a custom serializer to use. // Default: null
 *         sign?: bool|Param, // Whether to sign every message sent to this transport with its trust level, and to refuse any message received from it that is unsigned, or signed as unverified when this is not a failure transport. Handlers with the "sign" option require it on the transports their messages come from. // Default: false
 *         claim_check?: array{
 *             cache_pool?: scalar|Param|null, // Service id of the dedicated cache pool used to store claims. Pools declared under "framework.cache.pools" must define a "default_lifetime".
 *             max_size?: int|Param, // Maximum encoded message size in bytes before using a claim check.
 *         },
 *         options?: array<string, mixed>,
 *         failure_transport?: scalar|Param|null, // Transport name to send failed messages to (after all retries have failed). // Default: null
 *         outbox?: scalar|Param|null, // Name or DSN of the transport that stores the messages inside the current database transaction; consume that transport to forward them to this one. A value that is not the name of a configured transport is a DSN, used to create the "orders.outbox" transport for an "orders" transport. // Default: null
 *         inbox?: bool|array{ // Records the handled messages in a database table, in the transaction of their handlers, so that a redelivered message is not handled twice. Needs the "identity_stamps" option and a middleware that runs the handlers in a transaction.
 *             enabled?: bool|Param, // Default: false
 *             connection?: scalar|Param|null, // Name of the Doctrine DBAL connection of that transaction, the default connection when not set. // Default: null
 *             table_name?: scalar|Param|null, // Default: "messenger_inbox"
 *             retention?: int|Param, // Number of seconds a record is kept, which must exceed the time the transport can take to redeliver a message. // Default: 604800
 *         },
 *         retry_strategy?: Param|string|array{
 *             service?: scalar|Param|null, // Service id to override the retry strategy entirely. // Default: null
 *             max_retries?: int|Param, // Default: 3
 *             delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *             multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: this delay = (delay * (multiple ^ retries)). // Default: 2
 *             max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *             jitter?: float|Param, // Randomness to apply to the delay (between 0 and 1). // Default: 0.1
 *         },
 *         cooldown_strategy?: Param|bool|string|array{ // Stops consuming this transport for a while after its messages fail. With the default strategy, each worker counts its own failures.
 *             enabled?: bool|Param, // Default: false
 *             service?: scalar|Param|null, // Service id to override the cooldown strategy entirely. // Default: null
 *             failure_threshold?: int|Param, // Number of failures in a row that start a cooldown. // Default: 5
 *             delay?: int|Param, // Duration in ms of the first cooldown (or the initial value when multiplier is used). // Default: 1000
 *             multiplier?: float|Param, // If greater than 1, the cooldown will grow exponentially for each further failure in a row: this delay = (delay * (multiplier ^ (failures - failure_threshold))). // Default: 2
 *             max_delay?: int|Param, // Max duration in ms of a cooldown (0 = infinite). // Default: 60000
 *             jitter?: float|Param, // Randomness to apply to the duration (between 0 and 1). // Default: 0.1
 *         },
 *         rate_limiter?: scalar|Param|null, // Rate limiter name to use when processing messages. // Default: null
 *         priority?: int|Param, // Order in which "messenger:consume --all" consumes this transport, higher comes first. // Default: 0
 *     }>,
 *     failure_transport?: scalar|Param|null, // Transport name to send failed messages to (after all retries have failed). // Default: null
 *     stop_worker_on_signals?: Param|int|string|list<scalar|Param|null>,
 *     reject_redelivered_messages?: bool|Param, // Whether redeliveries should be rejected and retried through a new message instead of being handled directly. This mostly makes sense for AMQP, which redelivers messages that were neither acknowledged nor rejected. Disabling it avoids losing a message when the retry or the failure transport is unreachable, at the risk of a redelivery loop that blocks the queue. // Default: true
 *     deduplication?: array{
 *         lock_factory?: scalar|Param|null, // The service ID of the lock factory used to deduplicate messages, "lock.factory" when not set. // Default: null
 *     },
 *     identity_stamps?: bool|Param, // Adds a message id and a causation id to dispatched messages, and a correlation id at the start of each flow. // Default: false
 *     default_bus?: scalar|Param|null, // Default: null
 *     buses?: array<string, array{ // Default: {"messenger.bus.default":{"default_middleware":{"enabled":true,"allow_no_handlers":false,"allow_no_senders":true},"middleware":[],"messages":[],"unwrap_exceptions":false}}
 *         default_middleware?: Param|bool|string|array{
 *             enabled?: bool|Param, // Default: true
 *             allow_no_handlers?: bool|Param, // Default: false
 *             allow_no_senders?: bool|Param, // Default: true
 *         },
 *         middleware?: Param|string|list<Param|string|array{ // Default: []
 *             id?: scalar|Param|null,
 *             arguments?: list<mixed>,
 *         }>,
 *         messages?: Param|string|list<scalar|Param|null>,
 *         unwrap_exceptions?: bool|Param, // Whether the application gets the exception of the failing handler instead of a HandlerFailedException when it dispatches a message. // Default: false
 *     }>,
 * }
 * @psalm-type TypeInfoConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     aliases?: array<string, scalar|Param|null>,
 * }
 * @psalm-type PropertyAccessConfig = bool|array{ // Property access configuration
 *     enabled?: bool|Param, // Default: true
 *     magic_call?: bool|Param, // Default: false
 *     magic_get?: bool|Param, // Default: true
 *     magic_set?: bool|Param, // Default: true
 *     throw_exception_on_invalid_index?: bool|Param, // Default: false
 *     throw_exception_on_invalid_property_path?: bool|Param, // Default: true
 *     wildcard_reads?: bool|Param, // Enables reading every element of a collection through a "[*]" wildcard. // Default: false
 * }
 * @psalm-type PropertyInfoConfig = bool|array{ // Property info configuration
 *     enabled?: bool|Param, // Default: true
 *     with_constructor_extractor?: bool|Param, // Registers the constructor extractor. // Default: true
 * }
 * @psalm-type AssetMapperConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     paths?: Param|string|array<string, scalar|Param|null>,
 *     excluded_patterns?: list<scalar|Param|null>,
 *     exclude_dotfiles?: bool|Param, // If true, any files starting with "." will be excluded from the asset mapper. // Default: true
 *     server?: bool|Param, // If true, a "dev server" will return the assets from the public directory (true in "debug" mode only by default). // Default: "%kernel.debug%"
 *     public_prefix?: scalar|Param|null, // The public path where the assets will be written to (and served from when "server" is true). // Default: "/assets/"
 *     metadata_dir?: scalar|Param|null, // The directory where "asset-map:compile" writes manifest.json, importmap.json and entrypoint.*.json. These files are read by PHP only, so they do not need to be exposed to the browser. // Default: null
 *     missing_import_mode?: "strict"|"warn"|"ignore"|Param|null, // Behavior if an asset cannot be found when imported from JavaScript or CSS files - e.g. "import './non-existent.js'". "strict" means an exception is thrown, "warn" means a warning is logged, "ignore" means the import is left as-is. Defaults to "strict" in debug mode and to "warn" otherwise. // Default: null
 *     extensions?: array<string, scalar|Param|null>,
 *     importmap_path?: scalar|Param|null, // The path of the importmap.php file. // Default: "%kernel.project_dir%/importmap.php"
 *     importmap_polyfill?: scalar|Param|null, // The importmap name that will be used to load the polyfill. Set to false to disable. // Default: "es-module-shims"
 *     importmap_entries?: "all"|"reachable"|Param, // Which entries end up in the rendered importmap: "all" of them, or only the ones "reachable" from the rendered entrypoints (their eager and lazy import chains) plus the polyfill. // Default: "all"
 *     importmap_script_attributes?: array<string, scalar|Param|null>,
 *     importmap_integrity_algorithms?: list<"sha256"|"sha384"|"sha512"|Param>,
 *     vendor_dir?: scalar|Param|null, // The directory to store JavaScript vendors. // Default: "%kernel.project_dir%/assets/vendor"
 *     minimum_release_age?: int|Param, // Minimum age in seconds a package version must have to be considered when checking for updates (0 disables the check). Enabling it makes update checks download the full npm metadata document, which is larger than the abbreviated one. // Default: 0
 *     precompress?: bool|array{ // Precompress assets with Brotli, Zstandard and gzip.
 *         enabled?: bool|Param, // Default: false
 *         formats?: list<scalar|Param|null>,
 *         extensions?: list<scalar|Param|null>,
 *     },
 * }
 * @psalm-type RateLimiterConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     builder?: array{ // Configuration for the RateLimiterBuilder service.
 *         lock_factory?: scalar|Param|null, // The service ID of the lock factory to use with the RateLimiterBuilder. // Default: "auto"
 *         cache_pool?: scalar|Param|null, // The cache pool to use with RateLimiterBuilder. // Default: "cache.rate_limiter"
 *         storage_service?: scalar|Param|null, // The service ID of a custom storage implementation, this precedes any configured "cache_pool". // Default: null
 *     },
 *     limiters?: array<string, array{ // Default: []
 *         lock_factory?: scalar|Param|null, // The service ID of the lock factory used by this limiter (or null to disable locking). // Default: "auto"
 *         cache_pool?: scalar|Param|null, // The cache pool to use for storing the current limiter state. // Default: "cache.rate_limiter"
 *         storage_service?: scalar|Param|null, // The service ID of a custom storage implementation, this precedes any configured "cache_pool". // Default: null
 *         policy?: "fixed_window"|"token_bucket"|"sliding_window"|"compound"|"no_limit"|Param, // The algorithm to be used by this limiter.
 *         limiters?: Param|string|array<string, array{ // Default: []
 *             key?: scalar|Param|null, // The key to pass to this limiter, instead of the one passed to the compound limiter's create() method. // Default: null
 *         }>,
 *         limit?: int|Param, // The maximum allowed hits in a fixed interval or burst.
 *         interval?: scalar|Param|null, // Configures the fixed interval if "policy" is set to "fixed_window" or "sliding_window". The value must be a number followed by "second", "minute", "hour", "day", "week" or "month" (or their plural equivalent).
 *         rate?: array{ // Configures the fill rate if "policy" is set to "token_bucket".
 *             interval?: scalar|Param|null, // Configures the rate interval. The value must be a number followed by "second", "minute", "hour", "day", "week" or "month" (or their plural equivalent).
 *             amount?: int|Param, // Amount of tokens to add each interval. // Default: 1
 *         },
 *         anchor_at?: scalar|Param|null, // Aligns the "fixed_window" policy to a calendar (e.g. "2024-01-05 00:00:00 UTC" combined with `interval: 1 month` resets the counter on the 5th of each month). UTC if not specified. // Default: null
 *     }>,
 * }
 * @psalm-type HttpClientConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     max_host_connections?: int|Param, // The maximum number of connections to a single host.
 *     recorder?: bool|array{ // Record HTTP exchanges into HAR files and replay them in tests (see RecorderHttpClient).
 *         enabled?: bool|Param|null, // Defaults to true when "framework.test" is enabled, to false otherwise. // Default: null
 *         redactor?: scalar|Param|null, // Service id of a RedactorInterface; when set, "redact" and "redact_except" are ignored. // Default: null
 *         redact?: list<scalar|Param|null>,
 *         redact_except?: list<scalar|Param|null>,
 *     },
 *     default_options?: array{
 *         vars?: array<string, mixed>,
 *         headers?: array<string, mixed>,
 *         max_redirects?: int|Param, // The maximum number of redirects to follow.
 *         http_version?: scalar|Param|null, // The default HTTP version, typically 1.1 or 2.0, leave to null for the best version.
 *         resolve?: array<string, scalar|Param|null>,
 *         proxy?: scalar|Param|null, // The URL of the proxy to pass requests through or null for automatic detection.
 *         no_proxy?: scalar|Param|null, // A comma separated list of hosts that do not require a proxy to be reached.
 *         timeout?: float|Param, // The idle timeout, defaults to the "default_socket_timeout" ini parameter.
 *         max_duration?: float|Param, // The maximum execution time for the request+response as a whole.
 *         max_connect_duration?: float|Param, // The maximum duration allowed for DNS + TCP + TLS connection; a value lower than or equal to 0 means unlimited.
 *         bindto?: scalar|Param|null, // A network interface name, IP address, a host name or a UNIX socket to bind to.
 *         verify_peer?: bool|Param, // Indicates if the peer should be verified in a TLS context.
 *         verify_host?: bool|Param, // Indicates if the host should exist as a certificate common name.
 *         cafile?: scalar|Param|null, // A certificate authority file.
 *         capath?: scalar|Param|null, // A directory that contains multiple certificate authority files.
 *         local_cert?: scalar|Param|null, // A PEM formatted certificate file.
 *         local_pk?: scalar|Param|null, // A private key file.
 *         passphrase?: scalar|Param|null, // The passphrase used to encrypt the "local_pk" file.
 *         ciphers?: scalar|Param|null, // A list of TLS ciphers separated by colons, commas or spaces (e.g. "RC3-SHA:TLS13-AES-128-GCM-SHA256"...).
 *         peer_fingerprint?: array{ // Associative array: hashing algorithm => hash(es).
 *             sha1?: mixed,
 *             pin-sha256?: mixed,
 *             md5?: mixed,
 *         },
 *         crypto_method?: scalar|Param|null, // The minimum version of TLS to accept; must be one of STREAM_CRYPTO_METHOD_TLSv*_CLIENT constants.
 *         extra?: array<string, mixed>,
 *         rate_limiter?: scalar|Param|null, // Rate limiter name to use for throttling requests. // Default: null
 *         caching?: bool|array{ // Caching configuration.
 *             enabled?: bool|Param, // Default: false
 *             cache_pool?: string|Param, // The taggable cache pool to use for storing the responses. // Default: "cache.http_client"
 *             shared?: bool|Param, // Indicates whether the cache is shared (public) or private. // Default: true
 *             max_ttl?: int|Param, // The maximum TTL (in seconds) allowed for cached responses. // Default: 86400
 *         },
 *         retry_failed?: bool|array{
 *             enabled?: bool|Param, // Default: false
 *             base_uris?: Param|string|list<string|Param>,
 *             retry_strategy?: scalar|Param|null, // service id to override the retry strategy. // Default: null
 *             http_codes?: Param|int|string|array<string, array{ // Default: []
 *                 code?: int|Param,
 *                 methods?: Param|string|list<string|Param>,
 *             }>,
 *             max_retries?: int|Param, // Default: 3
 *             delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *             multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: delay * (multiple ^ retries). // Default: 2
 *             max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *             jitter?: float|Param, // Randomness in percent (between 0 and 1) to apply to the delay. // Default: 0.1
 *         },
 *     },
 *     mock_response_factory?: scalar|Param|null, // `true` to always return empty 200 responses, or the id of the service to use to generate mock responses - which should be either an invokable or an iterable.
 *     scoped_clients?: array<string, Param|string|array{ // Default: []
 *         scope?: scalar|Param|null, // The regular expression that the request URL must match before adding the other options. When none is provided, the base URI is used instead.
 *         base_uri?: scalar|Param|null, // The URI to resolve relative URLs, following rules in RFC 3985, section 2.
 *         auth_basic?: scalar|Param|null, // An HTTP Basic authentication "username:password".
 *         auth_bearer?: scalar|Param|null, // A token enabling HTTP Bearer authorization.
 *         auth_ntlm?: scalar|Param|null, // A "username:password" pair to use Microsoft NTLM authentication (requires the cURL extension).
 *         query?: array<string, scalar|Param|null>,
 *         mock_response_factory?: scalar|Param|null, // `true` to always return empty 200 responses, `false` to disable mocking, or the id of the service to use to generate mock responses (invokable or iterable).
 *         headers?: array<string, mixed>,
 *         max_redirects?: int|Param, // The maximum number of redirects to follow.
 *         http_version?: scalar|Param|null, // The default HTTP version, typically 1.1 or 2.0, leave to null for the best version.
 *         resolve?: array<string, scalar|Param|null>,
 *         proxy?: scalar|Param|null, // The URL of the proxy to pass requests through or null for automatic detection.
 *         no_proxy?: scalar|Param|null, // A comma separated list of hosts that do not require a proxy to be reached.
 *         timeout?: float|Param, // The idle timeout, defaults to the "default_socket_timeout" ini parameter.
 *         max_duration?: float|Param, // The maximum execution time for the request+response as a whole.
 *         max_connect_duration?: float|Param, // The maximum duration allowed for DNS + TCP + TLS connection; a value lower than or equal to 0 means unlimited.
 *         bindto?: scalar|Param|null, // A network interface name, IP address, a host name or a UNIX socket to bind to.
 *         verify_peer?: bool|Param, // Indicates if the peer should be verified in a TLS context.
 *         verify_host?: bool|Param, // Indicates if the host should exist as a certificate common name.
 *         cafile?: scalar|Param|null, // A certificate authority file.
 *         capath?: scalar|Param|null, // A directory that contains multiple certificate authority files.
 *         local_cert?: scalar|Param|null, // A PEM formatted certificate file.
 *         local_pk?: scalar|Param|null, // A private key file.
 *         passphrase?: scalar|Param|null, // The passphrase used to encrypt the "local_pk" file.
 *         ciphers?: scalar|Param|null, // A list of TLS ciphers separated by colons, commas or spaces (e.g. "RC3-SHA:TLS13-AES-128-GCM-SHA256"...).
 *         peer_fingerprint?: array{ // Associative array: hashing algorithm => hash(es).
 *             sha1?: mixed,
 *             pin-sha256?: mixed,
 *             md5?: mixed,
 *         },
 *         crypto_method?: scalar|Param|null, // The minimum version of TLS to accept; must be one of STREAM_CRYPTO_METHOD_TLSv*_CLIENT constants.
 *         extra?: array<string, mixed>,
 *         rate_limiter?: scalar|Param|null, // Rate limiter name to use for throttling requests. // Default: null
 *         caching?: bool|array{ // Caching configuration.
 *             enabled?: bool|Param, // Default: false
 *             cache_pool?: string|Param, // The taggable cache pool to use for storing the responses. // Default: "cache.http_client"
 *             shared?: bool|Param, // Indicates whether the cache is shared (public) or private. // Default: true
 *             max_ttl?: int|Param, // The maximum TTL (in seconds) allowed for cached responses. // Default: 86400
 *         },
 *         retry_failed?: bool|array{
 *             enabled?: bool|Param, // Default: false
 *             base_uris?: Param|string|list<string|Param>,
 *             retry_strategy?: scalar|Param|null, // service id to override the retry strategy. // Default: null
 *             http_codes?: Param|int|string|array<string, array{ // Default: []
 *                 code?: int|Param,
 *                 methods?: Param|string|list<string|Param>,
 *             }>,
 *             max_retries?: int|Param, // Default: 3
 *             delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *             multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: delay * (multiple ^ retries). // Default: 2
 *             max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *             jitter?: float|Param, // Randomness in percent (between 0 and 1) to apply to the delay. // Default: 0.1
 *         },
 *     }>,
 * }
 * @psalm-type MailerConfig = bool|array{
 *     enabled?: bool|Param, // Default: true
 *     message_bus?: scalar|Param|null, // The message bus to use. Defaults to the default bus if the Messenger component is installed. // Default: null
 *     dsn?: scalar|Param|null, // Default: null
 *     transports?: array<string, Param|string|array{ // Default: []
 *         dsn?: scalar|Param|null,
 *         rate_limiter?: scalar|Param|null, // Rate limiter name used to limit the number of messages sent through this transport; when the limit is exceeded, sending fails with a RateLimitExceededException. // Default: null
 *     }>,
 *     envelope?: array{ // Mailer Envelope configuration
 *         sender?: scalar|Param|null,
 *         recipients?: Param|string|list<scalar|Param|null>,
 *         allowed_recipients?: Param|string|list<scalar|Param|null>,
 *     },
 *     headers?: array<string, Param|string|array{ // Default: []
 *         value?: mixed,
 *     }>,
 *     tracking?: array{ // Default open/click tracking for every message that does not carry an explicit "X-Track" header; null keeps each provider's default. An "X-Track" entry in the "headers" option wins over this one.
 *         opens?: true|false|Param|null, // Default: null
 *         clicks?: true|false|Param|null, // Default: null
 *     },
 *     dkim_signer?: bool|array{ // DKIM signer configuration
 *         enabled?: bool|Param, // Default: false
 *         key?: scalar|Param|null, // Key content, or path to key (in PEM format with the `file://` prefix) // Default: ""
 *         domain?: scalar|Param|null, // Default: ""
 *         select?: scalar|Param|null, // Default: ""
 *         passphrase?: scalar|Param|null, // The private key passphrase // Default: ""
 *         options?: array<string, mixed>,
 *     },
 *     smime_signer?: bool|array{ // S/MIME signer configuration
 *         enabled?: bool|Param, // Default: false
 *         key?: scalar|Param|null, // Path to key (in PEM format) // Default: ""
 *         certificate?: scalar|Param|null, // Path to certificate (in PEM format without the `file://` prefix) // Default: ""
 *         passphrase?: scalar|Param|null, // The private key passphrase // Default: null
 *         extra_certificates?: scalar|Param|null, // Default: null
 *         sign_options?: int|Param, // Default: null
 *     },
 *     smime_encrypter?: bool|array{ // S/MIME encrypter configuration
 *         enabled?: bool|Param, // Default: false
 *         repository?: scalar|Param|null, // S/MIME certificate repository service. This service shall implement the `Symfony\Component\Mailer\EventListener\SmimeCertificateRepositoryInterface`. // Default: ""
 *         certificates?: array<string, scalar|Param|null>,
 *         on_missing_certificate?: "send_unencrypted"|"fail"|"encrypt"|"skip"|Param, // Default behavior when a recipient has no S/MIME certificate: "send_unencrypted" (send the message unencrypted, deprecated since 8.2), "fail" (throw an exception), "encrypt" (encrypt for the recipients that have a certificate, the others receive an unreadable message), "skip" (encrypt for the recipients that have a certificate and drop the others from the envelope; note that "mailer.envelope.recipients" is applied afterwards and overrides that list). Can be overridden per message by setting the "X-SMime-Encrypt" header to one of these values. // Default: "send_unencrypted"
 *         encrypt_for_sender?: bool|Param, // Also encrypt for the sender, when a certificate is available for its address, so that the sender can read the messages it sent. // Default: false
 *         cipher?: int|Param, // A set of algorithms used to encrypt the message // Default: null
 *     },
 *     pgp_signer?: bool|array{ // PGP/MIME signer configuration
 *         enabled?: bool|Param, // Default: false
 *         secret_key?: scalar|Param|null, // Path to the secret key (ASCII armored format without the `file://` prefix) // Default: ""
 *         public_key?: scalar|Param|null, // Path to the public key (ASCII armored format without the `file://` prefix) // Default: null
 *         passphrase?: scalar|Param|null, // The secret key passphrase // Default: null
 *         binary?: scalar|Param|null, // Path to the GnuPG binary // Default: "gpg"
 *         digest_algorithm?: "SHA224"|"SHA256"|"SHA384"|"SHA512"|Param, // The digest algorithm used to sign the message // Default: "SHA512"
 *     },
 *     pgp_encrypter?: bool|array{ // PGP/MIME encrypter configuration
 *         enabled?: bool|Param, // Default: false
 *         repository?: scalar|Param|null, // Service or class implementing `Symfony\Component\Mailer\EventListener\PgpPublicKeyRepositoryInterface` to provide recipient PGP public keys. // Default: ""
 *         keys?: array<string, scalar|Param|null>,
 *         binary?: scalar|Param|null, // Path to the GnuPG binary // Default: "gpg"
 *         cipher_algorithm?: "AES"|"AES192"|"AES256"|"TWOFISH"|"CAMELLIA128"|"CAMELLIA192"|"CAMELLIA256"|Param, // The cipher algorithm used to encrypt the message // Default: "AES256"
 *         timeout?: float|Param, // Timeout in seconds for the GPG process (null for no timeout) // Default: 60.0
 *         hide_recipients?: bool|Param, // Hide every recipient's key ID in the encrypted message (gpg --hidden-recipient). Recipients listed in the Bcc header are always hidden regardless of this option; set it to true to also hide To and Cc recipients. // Default: false
 *         on_missing_key?: "fail"|"encrypt"|"skip"|Param, // Default behavior when a recipient has no PGP public key: "fail" (throw an exception), "encrypt" (encrypt for the recipients that have a key, the others receive an unreadable message), "skip" (encrypt for the recipients that have a key and drop the others from the envelope; note that "mailer.envelope.recipients" is applied afterwards and overrides that list). The message is never sent unencrypted. Can be overridden per message by setting the "X-Pgp-Encrypt" header to one of these values. // Default: "fail"
 *         encrypt_for_sender?: bool|Param, // Also encrypt for the sender, when a public key is available for its address, so that the sender can read the messages it sent. // Default: false
 *     },
 * }
 * @psalm-type FrameworkConfig = array{
 *     secret?: scalar|Param|null, // A secret that must not change. The options that sign data default to it and take a list of secrets to rotate theirs.
 *     http_method_override?: bool|Param, // Set true to enable support for the '_method' request parameter to determine the intended HTTP method on POST requests. // Default: false
 *     allowed_http_method_override?: null|list<string|Param>,
 *     trust_x_sendfile_type_header?: scalar|Param|null, // Set true to enable support for xsendfile in binary file responses. // Default: "%env(bool:default::SYMFONY_TRUST_X_SENDFILE_TYPE_HEADER)%"
 *     ide?: scalar|Param|null, // Deprecated: Setting the "framework.ide.ide" configuration option is deprecated, use the "SYMFONY_IDE" env var instead. // Default: null
 *     test?: bool|Param,
 *     default_locale?: scalar|Param|null, // Default: "en"
 *     set_locale_from_accept_language?: bool|Param, // Whether to use the Accept-Language HTTP header to set the Request locale (only when the "_locale" request attribute is not passed). // Default: false
 *     set_content_language_from_locale?: bool|Param, // Whether to set the Content-Language HTTP header on the Response using the Request locale. // Default: false
 *     enabled_locales?: list<scalar|Param|null>,
 *     trusted_hosts?: Param|string|list<scalar|Param|null>,
 *     trusted_proxies?: mixed, // Default: ["%env(default::SYMFONY_TRUSTED_PROXIES)%"]
 *     trusted_headers?: Param|string|list<scalar|Param|null>,
 *     error_controller?: scalar|Param|null, // Default: "error_controller"
 *     handle_all_throwables?: bool|Param, // HttpKernel will handle all kinds of \Throwable. // Default: true
 *     csrf_protection?: bool|array{
 *         enabled?: scalar|Param|null, // Default: null
 *         stateless_token_ids?: list<scalar|Param|null>,
 *         check_header?: scalar|Param|null, // Whether to check the CSRF token in a header in addition to a cookie when using stateless protection. // Default: false
 *         cookie_name?: scalar|Param|null, // The name of the cookie to use when using stateless protection. // Default: "csrf-token"
 *     },
 *     form?: bool|array{ // Form configuration
 *         enabled?: bool|Param, // Default: true
 *         csrf_protection?: bool|array{
 *             enabled?: scalar|Param|null, // Default: null
 *             token_id?: scalar|Param|null, // Default: null
 *             field_name?: scalar|Param|null, // Default: "_token"
 *             field_attr?: array<string, scalar|Param|null>,
 *         },
 *     },
 *     http_cache?: bool|array{ // HTTP cache configuration
 *         enabled?: bool|Param, // Default: false
 *         debug?: bool|Param, // Default: "%kernel.debug%"
 *         trace_level?: "none"|"short"|"full"|Param,
 *         trace_header?: scalar|Param|null,
 *         cache_status?: scalar|Param|null, // Enables the RFC 9211 "Cache-Status" response header and names this cache in it, e.g. "Symfony". No header is added when null.
 *         default_ttl?: int|Param,
 *         private_headers?: list<scalar|Param|null>,
 *         skip_response_headers?: list<scalar|Param|null>,
 *         allow_reload?: bool|Param,
 *         allow_revalidate?: bool|Param,
 *         stale_while_revalidate?: int|Param,
 *         stale_if_error?: int|Param,
 *         terminate_on_cache_hit?: bool|Param, // Deprecated: Setting the "framework.http_cache.terminate_on_cache_hit.terminate_on_cache_hit" configuration option is deprecated. It will be removed in version 9.0.
 *     },
 *     esi?: bool|array{ // ESI configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     ssi?: bool|array{ // SSI configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     fragments?: bool|array{ // Fragments configuration
 *         enabled?: bool|Param, // Default: false
 *         hinclude_default_template?: scalar|Param|null, // Deprecated: Setting the "framework.fragments.hinclude_default_template.hinclude_default_template" configuration option is deprecated. It will be removed in version 9.0. // Default: null
 *         path?: scalar|Param|null, // Default: "/_fragment"
 *     },
 *     uri_signer?: array{ // URI signer configuration
 *         secret?: Param|string|list<scalar|Param|null>,
 *         expiration?: int|Param, // Default expiration of signed URIs, in seconds. // Default: null
 *     },
 *     profiler?: bool|array{ // Profiler configuration
 *         enabled?: bool|Param, // Default: false
 *         collect?: bool|Param, // Default: true
 *         collect_parameter?: scalar|Param|null, // The name of the parameter to use to enable or disable collection on a per request basis. // Default: null
 *         only_exceptions?: bool|Param, // Default: false
 *         only_main_requests?: bool|Param, // Default: false
 *         excluded_paths?: Param|string|list<scalar|Param|null>,
 *         excluded_http_codes?: Param|int|string|list<Param|string|list<scalar|Param|null>>,
 *         dsn?: scalar|Param|null, // Default: "file:%kernel.cache_dir%/profiler"
 *         collect_serializer_data?: true|Param, // Deprecated: Setting the "framework.profiler.collect_serializer_data.collect_serializer_data" configuration option is deprecated. It will be removed in version 9.0. // Default: true
 *     },
 *     workflows?: mixed,
 *     router?: RouterConfig,
 *     assets?: AssetConfig,
 *     asset_mapper?: AssetMapperConfig,
 *     translator?: TranslationConfig,
 *     validation?: ValidationConfig,
 *     serializer?: mixed,
 *     property_access?: PropertyAccessConfig,
 *     type_info?: TypeInfoConfig,
 *     property_info?: PropertyInfoConfig,
 *     cache?: CacheConfig,
 *     web_link?: mixed,
 *     lock?: mixed,
 *     semaphore?: mixed,
 *     messenger?: MessengerConfig,
 *     scheduler?: mixed,
 *     http_client?: HttpClientConfig,
 *     mailer?: MailerConfig,
 *     notifier?: mixed,
 *     rate_limiter?: RateLimiterConfig,
 *     uid?: mixed,
 *     html_sanitizer?: mixed,
 *     webhook?: mixed,
 *     remote_event?: mixed,
 *     json_streamer?: mixed,
 *     session?: bool|array{ // Session configuration
 *         enabled?: bool|Param, // Default: false
 *         storage_factory_id?: scalar|Param|null, // Defaults to "session.storage.factory.mock_file" when "framework.test" is true, to "session.storage.factory.native" otherwise. // Default: null
 *         handler_id?: scalar|Param|null, // Defaults to using the native session handler, or to the native *file* session handler if "save_path" is not null.
 *         name?: scalar|Param|null,
 *         cookie_lifetime?: scalar|Param|null,
 *         cookie_path?: scalar|Param|null,
 *         cookie_domain?: scalar|Param|null,
 *         cookie_secure?: true|false|"auto"|Param, // Default: "auto"
 *         cookie_httponly?: bool|Param, // Default: true
 *         cookie_samesite?: null|"lax"|"strict"|"none"|Param, // Default: "lax"
 *         use_cookies?: bool|Param,
 *         gc_divisor?: scalar|Param|null,
 *         gc_probability?: scalar|Param|null,
 *         gc_maxlifetime?: scalar|Param|null,
 *         save_path?: scalar|Param|null, // Defaults to "%kernel.cache_dir%/sessions" if the "handler_id" option is not null.
 *         metadata_update_threshold?: int|Param, // Seconds to wait between 2 session metadata updates. // Default: 0
 *         isolate_attributes?: bool|Param, // Whether to deep-clone the values read from and passed to session attributes, so that only values passed to set() are saved. // Default: false
 *     },
 *     request?: bool|array{ // Request configuration
 *         enabled?: bool|Param, // Default: false
 *         formats?: array<string, Param|string|list<scalar|Param|null>>,
 *         serializer?: scalar|Param|null, // Service id of the serializer that maps request payloads and query strings to controller arguments with #[MapRequestPayload] and #[MapQueryString], e.g. "serializer.api" for the named serializer "api". // Default: null
 *     },
 *     response?: array{ // Response configuration
 *         serializer?: scalar|Param|null, // Service id of the serializer that serializes the values returned by controllers with #[Serialize], e.g. "serializer.api" for the named serializer "api". // Default: null
 *     },
 *     php_errors?: array{ // PHP errors handling configuration
 *         log?: mixed, // Use the application logger instead of the PHP logger for logging PHP errors. // Default: true
 *         throw?: bool|Param|null, // Throw PHP errors as \ErrorException instances. Enabled by default when debug is enabled. // Default: null
 *     },
 *     exceptions?: array<string, array{ // Default: []
 *         log_level?: scalar|Param|null, // The level of log message. Null to let Symfony decide. // Default: null
 *         status_code?: scalar|Param|null, // The status code of the response. Null or 0 to let Symfony decide. // Default: null
 *         log_channel?: scalar|Param|null, // The channel of log message. Null to let Symfony decide. // Default: null
 *     }>,
 *     disallow_search_engine_index?: bool|Param|null, // Enabled by default when debug is enabled. // Default: null
 *     secrets?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *         vault_directory?: scalar|Param|null, // Default: "%kernel.project_dir%/config/secrets/%kernel.runtime_environment%"
 *         local_dotenv_file?: scalar|Param|null, // Default: "%kernel.project_dir%/.env.%kernel.environment%.local"
 *         decryption_env_var?: scalar|Param|null, // Default: "base64:default::SYMFONY_DECRYPTION_SECRET"
 *     },
 * }
 * @psalm-type DoctrineConfig = array{
 *     dbal?: array{
 *         default_connection?: scalar|Param|null,
 *         types?: array<string, Param|string|array{ // Default: []
 *             class?: scalar|Param|null,
 *         }>,
 *         driver_schemes?: array<string, scalar|Param|null>,
 *         connections?: array<string, array{ // Default: []
 *             url?: scalar|Param|null, // A URL with connection information; any parameter value parsed from this string will override explicitly set parameters
 *             dbname?: scalar|Param|null,
 *             host?: scalar|Param|null, // Defaults to "localhost" at runtime.
 *             port?: scalar|Param|null, // Defaults to null at runtime.
 *             user?: scalar|Param|null, // Defaults to "root" at runtime.
 *             password?: scalar|Param|null, // Defaults to null at runtime.
 *             dbname_suffix?: scalar|Param|null, // Adds the given suffix to the configured database name, this option has no effects for the SQLite platform
 *             application_name?: scalar|Param|null,
 *             charset?: scalar|Param|null,
 *             path?: scalar|Param|null,
 *             memory?: bool|Param,
 *             unix_socket?: scalar|Param|null, // The unix socket to use for MySQL
 *             persistent?: bool|Param, // True to use as persistent connection for the ibm_db2 driver
 *             protocol?: scalar|Param|null, // The protocol to use for the ibm_db2 driver (default to TCPIP if omitted)
 *             service?: bool|Param, // True to use SERVICE_NAME as connection parameter instead of SID for Oracle
 *             servicename?: scalar|Param|null, // Overrules dbname parameter if given and used as SERVICE_NAME or SID connection parameter for Oracle depending on the service parameter.
 *             sessionMode?: scalar|Param|null, // The session mode to use for the oci8 driver
 *             server?: scalar|Param|null, // The name of a running database server to connect to for SQL Anywhere.
 *             default_dbname?: scalar|Param|null, // Override the default database (postgres) to connect to for PostgreSQL connection.
 *             sslmode?: scalar|Param|null, // Determines whether or with what priority a SSL TCP/IP connection will be negotiated with the server for PostgreSQL.
 *             sslrootcert?: scalar|Param|null, // The name of a file containing SSL certificate authority (CA) certificate(s). If the file exists, the server's certificate will be verified to be signed by one of these authorities.
 *             sslcert?: scalar|Param|null, // The path to the SSL client certificate file for PostgreSQL.
 *             sslkey?: scalar|Param|null, // The path to the SSL client key file for PostgreSQL.
 *             sslcrl?: scalar|Param|null, // The file name of the SSL certificate revocation list for PostgreSQL.
 *             pooled?: bool|Param, // True to use a pooled server with the oci8/pdo_oracle driver
 *             MultipleActiveResultSets?: bool|Param, // Configuring MultipleActiveResultSets for the pdo_sqlsrv driver
 *             instancename?: scalar|Param|null, // Optional parameter, complete whether to add the INSTANCE_NAME parameter in the connection. It is generally used to connect to an Oracle RAC server to select the name of a particular instance.
 *             connectstring?: scalar|Param|null, // Complete Easy Connect connection descriptor, see https://docs.oracle.com/database/121/NETAG/naming.htm.When using this option, you will still need to provide the user and password parameters, but the other parameters will no longer be used. Note that when using this parameter, the getHost and getPort methods from Doctrine\DBAL\Connection will no longer function as expected.
 *             driver?: scalar|Param|null, // Default: "pdo_mysql"
 *             auto_commit?: bool|Param,
 *             schema_filter?: scalar|Param|null,
 *             logging?: bool|Param, // Default: true
 *             profiling?: bool|Param, // Default: true
 *             profiling_collect_backtrace?: bool|Param, // Enables collecting backtraces when profiling is enabled // Default: false
 *             profiling_collect_schema_errors?: bool|Param, // Enables collecting schema errors when profiling is enabled // Default: true
 *             server_version?: scalar|Param|null,
 *             idle_connection_ttl?: int|Param, // Default: 600
 *             driver_class?: scalar|Param|null,
 *             wrapper_class?: scalar|Param|null,
 *             keep_replica?: bool|Param,
 *             options?: array<string, mixed>,
 *             mapping_types?: array<string, scalar|Param|null>,
 *             default_table_options?: array<string, scalar|Param|null>,
 *             schema_manager_factory?: scalar|Param|null, // Default: "doctrine.dbal.default_schema_manager_factory"
 *             result_cache?: scalar|Param|null,
 *             replicas?: array<string, array{ // Default: []
 *                 url?: scalar|Param|null, // A URL with connection information; any parameter value parsed from this string will override explicitly set parameters
 *                 dbname?: scalar|Param|null,
 *                 host?: scalar|Param|null, // Defaults to "localhost" at runtime.
 *                 port?: scalar|Param|null, // Defaults to null at runtime.
 *                 user?: scalar|Param|null, // Defaults to "root" at runtime.
 *                 password?: scalar|Param|null, // Defaults to null at runtime.
 *                 dbname_suffix?: scalar|Param|null, // Adds the given suffix to the configured database name, this option has no effects for the SQLite platform
 *                 application_name?: scalar|Param|null,
 *                 charset?: scalar|Param|null,
 *                 path?: scalar|Param|null,
 *                 memory?: bool|Param,
 *                 unix_socket?: scalar|Param|null, // The unix socket to use for MySQL
 *                 persistent?: bool|Param, // True to use as persistent connection for the ibm_db2 driver
 *                 protocol?: scalar|Param|null, // The protocol to use for the ibm_db2 driver (default to TCPIP if omitted)
 *                 service?: bool|Param, // True to use SERVICE_NAME as connection parameter instead of SID for Oracle
 *                 servicename?: scalar|Param|null, // Overrules dbname parameter if given and used as SERVICE_NAME or SID connection parameter for Oracle depending on the service parameter.
 *                 sessionMode?: scalar|Param|null, // The session mode to use for the oci8 driver
 *                 server?: scalar|Param|null, // The name of a running database server to connect to for SQL Anywhere.
 *                 default_dbname?: scalar|Param|null, // Override the default database (postgres) to connect to for PostgreSQL connection.
 *                 sslmode?: scalar|Param|null, // Determines whether or with what priority a SSL TCP/IP connection will be negotiated with the server for PostgreSQL.
 *                 sslrootcert?: scalar|Param|null, // The name of a file containing SSL certificate authority (CA) certificate(s). If the file exists, the server's certificate will be verified to be signed by one of these authorities.
 *                 sslcert?: scalar|Param|null, // The path to the SSL client certificate file for PostgreSQL.
 *                 sslkey?: scalar|Param|null, // The path to the SSL client key file for PostgreSQL.
 *                 sslcrl?: scalar|Param|null, // The file name of the SSL certificate revocation list for PostgreSQL.
 *                 pooled?: bool|Param, // True to use a pooled server with the oci8/pdo_oracle driver
 *                 MultipleActiveResultSets?: bool|Param, // Configuring MultipleActiveResultSets for the pdo_sqlsrv driver
 *                 instancename?: scalar|Param|null, // Optional parameter, complete whether to add the INSTANCE_NAME parameter in the connection. It is generally used to connect to an Oracle RAC server to select the name of a particular instance.
 *                 connectstring?: scalar|Param|null, // Complete Easy Connect connection descriptor, see https://docs.oracle.com/database/121/NETAG/naming.htm.When using this option, you will still need to provide the user and password parameters, but the other parameters will no longer be used. Note that when using this parameter, the getHost and getPort methods from Doctrine\DBAL\Connection will no longer function as expected.
 *                 ...<string, mixed>
 *             }>,
 *             ...<string, mixed>
 *         }>,
 *         ...<string, mixed>
 *     },
 *     orm?: array{
 *         default_entity_manager?: scalar|Param|null,
 *         enable_native_lazy_objects?: bool|Param, // Deprecated: The "enable_native_lazy_objects" option is deprecated and will be removed in DoctrineBundle 4.0, as native lazy objects are now always enabled. // Default: true
 *         controller_resolver?: bool|array{
 *             enabled?: bool|Param, // Default: true
 *             auto_mapping?: bool|Param, // Deprecated: The "doctrine.orm.controller_resolver.auto_mapping.auto_mapping" option is deprecated and will be removed in DoctrineBundle 4.0, as it only accepts `false` since 3.0. // Set to true to enable using route placeholders as lookup criteria when the primary key doesn't match the argument name // Default: false
 *             evict_cache?: bool|Param, // Set to true to fetch the entity from the database instead of using the cache, if any // Default: false
 *         },
 *         entity_managers?: array<string, array{ // Default: []
 *             query_cache_driver?: Param|string|array{
 *                 type?: scalar|Param|null, // Default: null
 *                 id?: scalar|Param|null,
 *                 pool?: scalar|Param|null,
 *             },
 *             metadata_cache_driver?: Param|string|array{
 *                 type?: scalar|Param|null, // Default: null
 *                 id?: scalar|Param|null,
 *                 pool?: scalar|Param|null,
 *             },
 *             result_cache_driver?: Param|string|array{
 *                 type?: scalar|Param|null, // Default: null
 *                 id?: scalar|Param|null,
 *                 pool?: scalar|Param|null,
 *             },
 *             entity_listeners?: array{
 *                 entities?: array<string, array{ // Default: []
 *                     listeners?: array<string, array{ // Default: []
 *                         events?: list<array{ // Default: []
 *                             type?: scalar|Param|null,
 *                             method?: scalar|Param|null, // Default: null
 *                         }>,
 *                     }>,
 *                 }>,
 *                 ...<string, mixed>
 *             },
 *             connection?: scalar|Param|null,
 *             class_metadata_factory_name?: scalar|Param|null, // Default: "Doctrine\\ORM\\Mapping\\ClassMetadataFactory"
 *             default_repository_class?: scalar|Param|null, // Default: "Doctrine\\ORM\\EntityRepository"
 *             auto_mapping?: scalar|Param|null, // Default: false
 *             naming_strategy?: scalar|Param|null, // Default: "doctrine.orm.naming_strategy.default"
 *             quote_strategy?: scalar|Param|null, // Default: "doctrine.orm.quote_strategy.default"
 *             typed_field_mapper?: scalar|Param|null, // Default: "doctrine.orm.typed_field_mapper.default"
 *             entity_listener_resolver?: scalar|Param|null, // Default: null
 *             fetch_mode_subselect_batch_size?: scalar|Param|null,
 *             repository_factory?: scalar|Param|null, // Default: "doctrine.orm.container_repository_factory"
 *             schema_ignore_classes?: list<scalar|Param|null>,
 *             validate_xml_mapping?: bool|Param, // Set to "true" to opt-in to the new mapping driver mode that was added in Doctrine ORM 2.14 and will be mandatory in ORM 3.0. See https://github.com/doctrine/orm/pull/6728. // Default: false
 *             second_level_cache?: array{
 *                 region_cache_driver?: Param|string|array{
 *                     type?: scalar|Param|null, // Default: null
 *                     id?: scalar|Param|null,
 *                     pool?: scalar|Param|null,
 *                 },
 *                 region_lock_lifetime?: scalar|Param|null, // Default: 60
 *                 log_enabled?: bool|Param, // Default: true
 *                 region_lifetime?: scalar|Param|null, // Default: 3600
 *                 enabled?: bool|Param, // Default: true
 *                 factory?: scalar|Param|null,
 *                 regions?: array<string, array{ // Default: []
 *                     cache_driver?: Param|string|array{
 *                         type?: scalar|Param|null, // Default: null
 *                         id?: scalar|Param|null,
 *                         pool?: scalar|Param|null,
 *                     },
 *                     lock_path?: scalar|Param|null, // Default: "%kernel.cache_dir%/doctrine/orm/slc/filelock"
 *                     lock_lifetime?: scalar|Param|null, // Default: 60
 *                     type?: scalar|Param|null, // Default: "default"
 *                     lifetime?: scalar|Param|null, // Default: null
 *                     service?: scalar|Param|null,
 *                     name?: scalar|Param|null,
 *                 }>,
 *                 loggers?: array<string, array{ // Default: []
 *                     name?: scalar|Param|null,
 *                     service?: scalar|Param|null,
 *                 }>,
 *             },
 *             hydrators?: array<string, scalar|Param|null>,
 *             mappings?: array<string, Param|bool|string|array{ // Default: []
 *                 mapping?: scalar|Param|null, // Default: true
 *                 type?: scalar|Param|null,
 *                 dir?: scalar|Param|null,
 *                 alias?: scalar|Param|null,
 *                 prefix?: scalar|Param|null,
 *                 is_bundle?: bool|Param,
 *             }>,
 *             dql?: array{
 *                 string_functions?: array<string, scalar|Param|null>,
 *                 numeric_functions?: array<string, scalar|Param|null>,
 *                 datetime_functions?: array<string, scalar|Param|null>,
 *             },
 *             filters?: array<string, Param|string|array{ // Default: []
 *                 class?: scalar|Param|null,
 *                 enabled?: bool|Param, // Default: false
 *                 parameters?: array<string, mixed>,
 *                 ...<string, mixed>
 *             }>,
 *             identity_generation_preferences?: array<string, scalar|Param|null>,
 *         }>,
 *         resolve_target_entities?: array<string, scalar|Param|null>,
 *         ...<string, mixed>
 *     },
 * }
 * @psalm-type DamaDoctrineTestConfig = array{
 *     enable_static_connection?: mixed, // Default: true
 *     enable_static_meta_data_cache?: bool|Param, // Default: true
 *     enable_static_query_cache?: bool|Param, // Default: true
 *     connection_keys?: list<mixed>,
 * }
 * @psalm-type DoctrineMigrationsConfig = array{
 *     enable_service_migrations?: bool|Param, // Whether to enable fetching migrations from the service container. // Default: false
 *     migrations_paths?: array<string, scalar|Param|null>,
 *     services?: array<string, scalar|Param|null>,
 *     factories?: array<string, scalar|Param|null>,
 *     storage?: array{ // Storage to use for migration status metadata.
 *         table_storage?: array{ // The default metadata storage, implemented as a table in the database.
 *             table_name?: scalar|Param|null, // Default: null
 *             version_column_name?: scalar|Param|null, // Default: null
 *             version_column_length?: scalar|Param|null, // Default: null
 *             executed_at_column_name?: scalar|Param|null, // Default: null
 *             execution_time_column_name?: scalar|Param|null, // Default: null
 *         },
 *     },
 *     migrations?: list<scalar|Param|null>,
 *     connection?: scalar|Param|null, // Connection name to use for the migrations database. // Default: null
 *     em?: scalar|Param|null, // Entity manager name to use for the migrations database (available when doctrine/orm is installed). // Default: null
 *     all_or_nothing?: scalar|Param|null, // Run all migrations in a transaction. // Default: false
 *     check_database_platform?: scalar|Param|null, // Adds an extra check in the generated migrations to allow execution only on the same platform as they were initially generated on. // Default: true
 *     custom_template?: scalar|Param|null, // Custom template path for generated migration classes. // Default: null
 *     organize_migrations?: scalar|Param|null, // Organize migrations mode. Possible values are: "BY_YEAR", "BY_YEAR_AND_MONTH", false // Default: false
 *     enable_profiler?: bool|Param, // Whether or not to enable the profiler collector to calculate and visualize migration status. This adds some queries overhead. // Default: false
 *     transactional?: bool|Param, // Whether or not to wrap migrations in a single transaction. // Default: true
 * }
 * @psalm-type SentryConfig = array{
 *     dsn?: scalar|Param|null, // If this value is not provided, the SDK will try to read it from the SENTRY_DSN environment variable. If that variable also does not exist, the SDK will not send any events.
 *     register_error_listener?: bool|Param, // Default: true
 *     register_error_handler?: bool|Param, // Default: true
 *     register_monolog_handler?: bool|Param, // EXPERIMENT: automatically push a Sentry handler onto every Monolog channel (requires MonologBundle). // Default: false
 *     logger?: scalar|Param|null, // The service ID of the PSR-3 logger used to log messages coming from the SDK client. Be aware that setting the same logger of the application may create a circular loop when an event fails to be sent. // Default: null
 *     options?: array{
 *         integrations?: mixed, // Default: []
 *         default_integrations?: bool|Param,
 *         prefixes?: list<scalar|Param|null>,
 *         sample_rate?: float|Param, // The sampling factor to apply to events. A value of 0 will deny sending any event, and a value of 1 will send all events.
 *         enable_tracing?: bool|Param,
 *         traces_sample_rate?: float|Param, // The sampling factor to apply to transactions. A value of 0 will deny sending any transaction, and a value of 1 will send all transactions.
 *         traces_sampler?: scalar|Param|null,
 *         profiles_sample_rate?: float|Param, // The sampling factor to apply to profiles. A value of 0 will deny sending any profiles, and a value of 1 will send all profiles. Profiles are sampled in relation to traces_sample_rate
 *         enable_logs?: bool|Param,
 *         log_flush_threshold?: mixed, // Default: null
 *         enable_metrics?: bool|Param, // Default: true
 *         attach_stacktrace?: bool|Param,
 *         attach_metric_code_locations?: bool|Param,
 *         context_lines?: int|Param,
 *         environment?: scalar|Param|null, // Default: "%kernel.environment%"
 *         logger?: scalar|Param|null,
 *         spotlight?: bool|Param,
 *         spotlight_url?: scalar|Param|null,
 *         release?: scalar|Param|null, // Default: "%env(default::SENTRY_RELEASE)%"
 *         org_id?: int|Param,
 *         server_name?: scalar|Param|null,
 *         ignore_exceptions?: list<scalar|Param|null>,
 *         ignore_transactions?: list<scalar|Param|null>,
 *         before_send?: scalar|Param|null,
 *         before_send_transaction?: scalar|Param|null,
 *         before_send_check_in?: scalar|Param|null,
 *         before_send_metrics?: scalar|Param|null,
 *         before_send_log?: scalar|Param|null,
 *         before_send_metric?: scalar|Param|null,
 *         trace_propagation_targets?: mixed,
 *         strict_trace_continuation?: bool|Param,
 *         tags?: array<string, scalar|Param|null>,
 *         error_types?: scalar|Param|null,
 *         max_breadcrumbs?: int|Param,
 *         before_breadcrumb?: mixed,
 *         in_app_exclude?: list<scalar|Param|null>,
 *         in_app_include?: list<scalar|Param|null>,
 *         send_default_pii?: bool|Param,
 *         data_collection?: array{ // Opts into the data collection options, which replace legacy options such as "send_default_pii". An empty array applies the default of every option, null keeps the legacy options even if an earlier config file opted in.
 *             user_info?: bool|Param,
 *             cookies?: array{
 *                 mode?: "off"|"denyList"|"allowList"|Param,
 *                 terms?: list<scalar|Param|null>,
 *             },
 *             http_headers?: array{
 *                 request?: array{
 *                     mode?: "off"|"denyList"|"allowList"|Param,
 *                     terms?: list<scalar|Param|null>,
 *                 },
 *                 response?: array{
 *                     mode?: "off"|"denyList"|"allowList"|Param,
 *                     terms?: list<scalar|Param|null>,
 *                 },
 *                 ...<string, mixed>
 *             },
 *             http_bodies?: list<"incomingRequest"|"outgoingRequest"|"incomingResponse"|"outgoingResponse"|Param>,
 *             url_query_params?: array{
 *                 mode?: "off"|"denyList"|"allowList"|Param,
 *                 terms?: list<scalar|Param|null>,
 *             },
 *             gen_ai?: array{
 *                 inputs?: bool|Param,
 *                 outputs?: bool|Param,
 *             },
 *             database_query_data?: bool|Param,
 *             queues?: bool|Param,
 *             stack_frame_variables?: bool|array{
 *                 mode?: "off"|"denyList"|"allowList"|Param,
 *                 terms?: list<scalar|Param|null>,
 *             },
 *             frame_context_lines?: int|Param,
 *             ...<string, mixed>
 *         },
 *         max_value_length?: int|Param,
 *         transport?: scalar|Param|null,
 *         http_client?: scalar|Param|null,
 *         http_proxy?: scalar|Param|null,
 *         http_proxy_authentication?: scalar|Param|null,
 *         http_connect_timeout?: float|Param, // The maximum number of seconds to wait while trying to connect to a server. It works only when using the default transport.
 *         http_timeout?: float|Param, // The maximum execution time for the request+response as a whole. It works only when using the default transport.
 *         http_ssl_verify_peer?: bool|Param,
 *         http_compression?: bool|Param,
 *         capture_silenced_errors?: bool|Param,
 *         max_request_body_size?: "none"|"never"|"small"|"medium"|"always"|Param,
 *         class_serializers?: array<string, scalar|Param|null>,
 *     },
 *     messenger?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *         capture_soft_fails?: bool|Param, // Default: true
 *         isolate_breadcrumbs_by_message?: bool|Param, // Default: false
 *         isolate_context_by_message?: bool|Param, // Default: false
 *     },
 *     tracing?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *         dbal?: bool|array{
 *             enabled?: bool|Param, // Default: true
 *             ignore_prepare_spans?: bool|Param, // Default: false
 *             connections?: list<scalar|Param|null>,
 *         },
 *         twig?: bool|array{
 *             enabled?: bool|Param, // Default: true
 *         },
 *         cache?: bool|array{
 *             enabled?: bool|Param, // Default: true
 *         },
 *         http_client?: bool|array{
 *             enabled?: bool|Param, // Default: true
 *         },
 *         console?: array{
 *             excluded_commands?: list<scalar|Param|null>,
 *         },
 *     },
 * }
 * @psalm-type TwigConfig = array{
 *     form_themes?: list<scalar|Param|null>,
 *     globals?: array<string, array{ // Default: []
 *         id?: scalar|Param|null,
 *         type?: scalar|Param|null,
 *         value?: mixed,
 *         ...<string, mixed>
 *     }>,
 *     autoescape_service?: scalar|Param|null, // Default: null
 *     autoescape_service_method?: scalar|Param|null, // Default: null
 *     cache?: scalar|Param|null, // Default: true
 *     charset?: scalar|Param|null, // Default: "%kernel.charset%"
 *     debug?: bool|Param, // Default: "%kernel.debug%"
 *     strict_variables?: bool|Param, // Default: "%kernel.debug%"
 *     auto_reload?: scalar|Param|null,
 *     optimizations?: int|Param,
 *     default_path?: scalar|Param|null, // The default path used to load templates. // Default: "%kernel.project_dir%/templates"
 *     file_name_pattern?: Param|string|list<scalar|Param|null>,
 *     paths?: array<string, mixed>,
 *     date?: array{ // The default format options used by the date filter.
 *         format?: scalar|Param|null, // Default: "F j, Y H:i"
 *         interval_format?: scalar|Param|null, // Default: "%d days"
 *         timezone?: scalar|Param|null, // The timezone used when formatting dates, when set to null, the timezone returned by date_default_timezone_get() is used. // Default: null
 *     },
 *     number_format?: array{ // The default format options for the number_format filter.
 *         decimals?: int|Param, // Default: 0
 *         decimal_point?: scalar|Param|null, // Default: "."
 *         thousands_separator?: scalar|Param|null, // Default: ","
 *     },
 *     mailer?: array{
 *         html_to_text_converter?: scalar|Param|null, // A service implementing the "Symfony\Component\Mime\HtmlToTextConverter\HtmlToTextConverterInterface". // Default: null
 *     },
 * }
 * @psalm-type TwigExtraConfig = array{
 *     cache?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     html?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     markdown?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     intl?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     cssinliner?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *     },
 *     inky?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *     },
 *     string?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *     },
 *     commonmark?: array{
 *         renderer?: array{ // Array of options for rendering HTML.
 *             block_separator?: scalar|Param|null,
 *             inner_separator?: scalar|Param|null,
 *             soft_break?: scalar|Param|null,
 *         },
 *         html_input?: "strip"|"allow"|"escape"|Param, // How to handle HTML input.
 *         allow_unsafe_links?: bool|Param, // Remove risky link and image URLs by setting this to false. // Default: true
 *         max_nesting_level?: int|Param, // The maximum nesting level for blocks. // Default: 9223372036854775807
 *         max_delimiters_per_line?: int|Param, // The maximum number of strong/emphasis delimiters per line. // Default: 9223372036854775807
 *         slug_normalizer?: array{ // Array of options for configuring how URL-safe slugs are created.
 *             instance?: mixed,
 *             max_length?: int|Param, // Default: 255
 *             unique?: mixed,
 *         },
 *         commonmark?: array{ // Array of options for configuring the CommonMark core extension.
 *             enable_em?: bool|Param, // Default: true
 *             enable_strong?: bool|Param, // Default: true
 *             use_asterisk?: bool|Param, // Default: true
 *             use_underscore?: bool|Param, // Default: true
 *             unordered_list_markers?: list<scalar|Param|null>,
 *         },
 *         ...<string, mixed>
 *     },
 * }
 * @psalm-type SecurityConfig = array{
 *     access_denied_url?: scalar|Param|null, // Default: null
 *     recent_authentication_lifetime?: int|Param, // Number of seconds an interactive authentication keeps granting IS_AUTHENTICATED_RECENTLY. Use it to make sensitive actions require the user to authenticate again. // Default: 7200
 *     very_recent_authentication_lifetime?: int|Param, // Number of seconds an interactive authentication keeps granting IS_AUTHENTICATED_VERY_RECENTLY, a stricter bar than IS_AUTHENTICATED_RECENTLY for the most sensitive actions. // Default: 300
 *     session_fixation_strategy?: "none"|"migrate"|"invalidate"|Param, // Default: "migrate"
 *     expose_security_errors?: \Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel::None|\Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel::AccountStatus|\Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel::All|Param, // Default: "none"
 *     erase_credentials?: bool|Param, // Deprecated: Setting the "security.erase_credentials.erase_credentials" configuration option is deprecated. It will be removed in Symfony 9.0, as the "eraseCredentials()" method was removed in Symfony 8.0. // Default: true
 *     access_decision_manager?: array{
 *         strategy?: "affirmative"|"consensus"|"unanimous"|"priority"|Param,
 *         service?: scalar|Param|null,
 *         strategy_service?: scalar|Param|null,
 *         allow_if_all_abstain?: bool|Param, // Default: false
 *         allow_if_equal_granted_denied?: bool|Param, // Default: true
 *     },
 *     password_hashers?: array<string, Param|string|array{ // Default: []
 *         algorithm?: scalar|Param|null,
 *         migrate_from?: Param|string|list<scalar|Param|null>,
 *         hash_algorithm?: scalar|Param|null, // Name of hashing algorithm for PBKDF2 (i.e. sha256, sha512, etc..) See hash_algos() for a list of supported algorithms. // Default: "sha512"
 *         key_length?: scalar|Param|null, // Default: 40
 *         ignore_case?: bool|Param, // Default: false
 *         encode_as_base64?: bool|Param, // Default: true
 *         iterations?: scalar|Param|null, // Default: 5000
 *         cost?: int|Param, // Defaults to the lowest value bcrypt accepts when "framework.test" is enabled. // Default: null
 *         memory_cost?: scalar|Param|null, // Defaults to the lowest value argon2 accepts when "framework.test" is enabled. // Default: null
 *         time_cost?: scalar|Param|null, // Defaults to the lowest value argon2 accepts when "framework.test" is enabled. // Default: null
 *         id?: scalar|Param|null,
 *     }>,
 *     providers?: array<string, array{ // Default: []
 *         id?: scalar|Param|null,
 *         chain?: array{
 *             providers?: Param|string|list<scalar|Param|null>,
 *         },
 *         entity?: array{
 *             class?: scalar|Param|null, // The full entity class name of your user class.
 *             property?: scalar|Param|null, // Default: null
 *             manager_name?: scalar|Param|null, // Default: null
 *         },
 *         memory?: array{
 *             users?: array<string, array{ // Default: []
 *                 password?: scalar|Param|null, // Default: null
 *                 roles?: Param|string|list<scalar|Param|null>,
 *             }>,
 *         },
 *         ldap?: array{
 *             service?: scalar|Param|null,
 *             base_dn?: scalar|Param|null,
 *             search_dn?: scalar|Param|null, // Default: null
 *             search_password?: scalar|Param|null, // Default: null
 *             extra_fields?: list<scalar|Param|null>,
 *             default_roles?: Param|string|list<scalar|Param|null>,
 *             role_fetcher?: scalar|Param|null, // Default: null
 *             uid_key?: scalar|Param|null, // Default: "sAMAccountName"
 *             filter?: scalar|Param|null, // Default: "({uid_key}={user_identifier})"
 *             password_attribute?: scalar|Param|null, // Default: null
 *         },
 *         oidc?: array{
 *             enabled?: bool|Param, // Internal marker; the OIDC provider has no configuration options. // Default: true
 *             ...<string, mixed>
 *         },
 *     }>,
 *     firewalls?: array<string, array{ // Default: []
 *         pattern?: scalar|Param|null,
 *         host?: scalar|Param|null,
 *         methods?: Param|string|list<scalar|Param|null>,
 *         security?: bool|Param, // Default: true
 *         user_checker?: scalar|Param|null, // The UserChecker to use when authenticating users in this firewall. // Default: "security.user_checker"
 *         user_checker_on_refresh?: bool|Param, // Whether to run this firewall's UserChecker again when the user is refreshed from the session, so that an account disabled during the session is rejected on the next request. It then runs on every request of this firewall, so enable it only if that checker is safe to call that often. // Default: false
 *         request_matcher?: scalar|Param|null,
 *         access_denied_url?: scalar|Param|null,
 *         access_denied_handler?: scalar|Param|null,
 *         entry_point?: scalar|Param|null, // An enabled authenticator name or a service id that implements "Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface".
 *         entry_point_path?: scalar|Param|null, // A path, an absolute URL or a route name to redirect anonymous users to when they need to authenticate.
 *         re_authentication_entry_point?: scalar|Param|null, // An enabled authenticator name or a service id implementing "Symfony\Component\Security\Http\EntryPoint\ReAuthenticationEntryPointInterface", started when the vote denying access asks for a re-authentication. Defaults to the firewall entry point when it implements this interface.
 *         provider?: scalar|Param|null,
 *         stateless?: bool|Param, // Default: false
 *         lazy?: bool|Param, // Default: false
 *         context?: scalar|Param|null,
 *         logout?: array{
 *             enable_csrf?: bool|Param|null, // Default: null
 *             csrf_token_id?: scalar|Param|null, // Default: "logout"
 *             csrf_parameter?: scalar|Param|null, // Default: "_csrf_token"
 *             csrf_token_manager?: scalar|Param|null,
 *             path?: scalar|Param|null, // Default: "/logout"
 *             target?: scalar|Param|null, // Default: "/"
 *             invalidate_session?: bool|Param, // Default: true
 *             clear_site_data?: Param|string|list<"*"|"cache"|"cookies"|"storage"|"clientHints"|"executionContexts"|"prefetchCache"|"prerenderCache"|Param>,
 *             delete_cookies?: Param|string|array<string, array{ // Default: []
 *                 path?: scalar|Param|null, // Default: null
 *                 domain?: scalar|Param|null, // Default: null
 *                 secure?: scalar|Param|null, // Default: false
 *                 samesite?: scalar|Param|null, // Default: null
 *                 partitioned?: scalar|Param|null, // Default: false
 *             }>,
 *         },
 *         switch_user?: array{
 *             provider?: scalar|Param|null,
 *             parameter?: scalar|Param|null, // Default: "_switch_user"
 *             role?: scalar|Param|null, // Default: "ROLE_ALLOWED_TO_SWITCH"
 *             target_route?: scalar|Param|null, // Default: null
 *             path?: scalar|Param|null, // Restrict user switching to this path (a path or route name). Declaring the route POST-only is up to the application. The parameter is no longer read from the request headers in this mode. // Default: null
 *             enable_csrf?: bool|Param|null, // Default: null
 *             csrf_token_id?: scalar|Param|null, // Default: "switch_user"
 *             csrf_parameter?: scalar|Param|null, // Default: "_csrf_token"
 *             csrf_token_manager?: scalar|Param|null,
 *         },
 *         required_badges?: list<scalar|Param|null>,
 *         custom_authenticators?: list<scalar|Param|null>,
 *         login_throttling?: array{
 *             limiter?: scalar|Param|null, // A service id implementing "Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface".
 *             max_attempts?: int|Param, // Default: 5
 *             interval?: scalar|Param|null, // Default: "1 minute"
 *             lock_factory?: scalar|Param|null, // The service ID of the lock factory used by the login rate limiter ("auto" to use the default one when the Lock component is configured, or null to disable locking). // Default: "auto"
 *             cache_pool?: string|Param, // The cache pool to use for storing the limiter state // Default: "cache.rate_limiter"
 *             storage_service?: string|Param, // The service ID of a custom storage implementation, this precedes any configured "cache_pool" // Default: null
 *         },
 *         x509?: array{
 *             provider?: scalar|Param|null,
 *             user?: scalar|Param|null, // Default: "SSL_CLIENT_S_DN_Email"
 *             credentials?: scalar|Param|null, // Default: "SSL_CLIENT_S_DN"
 *             user_identifier?: scalar|Param|null, // Default: "emailAddress"
 *         },
 *         remote_user?: array{
 *             provider?: scalar|Param|null,
 *             user?: scalar|Param|null, // Default: "REMOTE_USER"
 *         },
 *         login_link?: array{
 *             check_route?: scalar|Param|null, // Route that will validate the login link - e.g. "app_login_link_verify".
 *             check_post_only?: scalar|Param|null, // If true, only HTTP POST requests to "check_route" will be handled by the authenticator. // Default: false
 *             signature_properties?: list<scalar|Param|null>,
 *             lifetime?: int|Param, // The lifetime of the login link in seconds. // Default: 600
 *             max_uses?: int|Param, // Max number of times a login link can be used - null means unlimited within lifetime. // Default: null
 *             used_link_cache?: scalar|Param|null, // Cache service id used to expired links of max_uses is set.
 *             success_handler?: scalar|Param|null, // A service id that implements Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface.
 *             failure_handler?: scalar|Param|null, // A service id that implements Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface.
 *             provider?: scalar|Param|null, // The user provider to load users from.
 *             secret?: Param|string|list<scalar|Param|null>,
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|Param|null, // Default: "/"
 *             login_path?: scalar|Param|null, // Default: "/login"
 *             target_path_parameter?: scalar|Param|null, // Default: "_target_path"
 *             use_referer?: bool|Param, // Default: false
 *             failure_path?: scalar|Param|null, // Default: null
 *             failure_forward?: bool|Param, // Default: false
 *             failure_path_parameter?: scalar|Param|null, // Default: "_failure_path"
 *         },
 *         oidc_login?: array{
 *             provider?: scalar|Param|null,
 *             remember_me?: bool|Param, // Deprecated: Setting the "security.firewalls..oidc_login.remember_me.remember_me" configuration option has no effect and is deprecated. It will be removed in Symfony 9.0. // Default: true
 *             success_handler?: scalar|Param|null,
 *             failure_handler?: scalar|Param|null,
 *             check_path?: scalar|Param|null, // The firewall path where the OIDC provider redirects after authentication. Must match a redirect URI registered with the provider. A route is declared for this path by the "security.route_loader" service, which the application must import. A route name is accepted too, in which case no route is declared for it. // Default: "/oidc/callback"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|Param|null, // Default: "/login"
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|Param|null, // Default: "/"
 *             target_path_parameter?: scalar|Param|null, // Default: "_target_path"
 *             use_referer?: bool|Param, // Default: false
 *             failure_path?: scalar|Param|null, // Default: null
 *             failure_forward?: bool|Param, // Default: false
 *             failure_path_parameter?: scalar|Param|null, // Default: "_failure_path"
 *             provider_uri?: scalar|Param|null, // The OIDC Issuer URL (e.g. "https://accounts.example.com"). Used for .well-known/openid-configuration discovery unless "discovery_uri" is set.
 *             discovery_uri?: scalar|Param|null, // Absolute URL of the discovery document. The "issuer" it announces is still checked against "provider_uri". // Default: null
 *             http_client?: scalar|Param|null, // The id of the HttpClient service every call to the provider is made with: discovery, JWKS, token and UserInfo endpoints. Defaults to "http_client". A scoped client must scope the discovery host and every host the provider announces. // Default: null
 *             client_id?: scalar|Param|null, // The OIDC client identifier.
 *             client_certificate?: Param|string|array{ // The TLS client certificate presented to the token and UserInfo endpoints.
 *                 certificate?: scalar|Param|null, // Path to the PEM file of the certificate.
 *                 key?: scalar|Param|null, // Path to the PEM file of the private key, when not in the certificate file. // Default: null
 *                 passphrase?: scalar|Param|null, // Passphrase of the private key. // Default: null
 *             },
 *             client_authentication?: Param|string|array{ // How the client authenticates at the token endpoint, which RFC 7591, Section 2 names in its "token_endpoint_auth_method" metadata. Set the method Symfony ships with its parameters, or the id of a service implementing "Symfony\Component\Security\Http\OAuth2\ClientAuthentication\ClientAuthenticationInterface" for a scheme it does not. Exactly one of them.
 *                 client_secret_basic?: scalar|Param|null, // Send the client secret as HTTP Basic credentials, the "client_secret_basic" method of RFC 6749, Section 2.3.1, which the RFC recommends. Takes the client secret.
 *                 client_secret_post?: scalar|Param|null, // Send the client secret in the body of the token request, the "client_secret_post" method of RFC 6749, Section 2.3.1. Takes the client secret. Use it for the providers that support nothing else.
 *                 none?: bool|Param, // Declare a public client (a SPA, a mobile or a native application), which holds no secret and relies on PKCE to protect the code exchange. It can disable neither PKCE nor the ID token signature check.
 *                 client_secret_jwt?: Param|string|array{ // Authenticate with a JWT assertion keyed with the client secret, the "client_secret_jwt" method of OIDC Core 1.0, Section 9. The secret keys an HMAC and is never sent, but the provider holds it too and could sign an assertion in the name of the client: prefer "private_key_jwt", which nobody but the client can sign. Takes the client secret, or a mapping to also set "algorithm" and "lifetime".
 *                     secret?: scalar|Param|null, // The client secret, whose octets key the HMAC. It must be at least as long as the digest the algorithm produces, which RFC 7518, Section 3.2 requires and the algorithm itself checks: 32 bytes for "HS256", 48 for "HS384", 64 for "HS512".
 *                     algorithm?: "HS256"|"HS384"|"HS512"|Param, // The MAC algorithm the assertion is signed with, which must be one your provider announces in "token_endpoint_auth_signing_alg_values_supported". // Default: "HS256"
 *                     lifetime?: int|Param, // How long an assertion is valid, in seconds. It is built for one request and sent right away, so keep it short: it is the window a provider that does not track the "jti" would accept a captured assertion in. // Default: 60
 *                     audience?: "issuer"|"token_endpoint"|Param, // The audience of the assertion: the issuer of the provider, or its token endpoint for a provider that refuses the issuer. // Default: "issuer"
 *                 },
 *                 private_key_jwt?: Param|string|array{ // Authenticate with a JWT assertion signed with the private key of the client, the "private_key_jwt" method of OIDC Core 1.0, Section 9, and the one FAPI 2.0 asks for. The provider only holds the public half, registered as the client "jwks" or fetched from its "jwks_uri", so it learns nothing it could authenticate as the client with.
 *                     key?: scalar|Param|null, // JSON-encoded JWK of the private key the assertion is signed with. Give it a "kid" when the client publishes several keys, so that the provider knows which one verifies the signature without trying them all.
 *                     algorithm?: "RS256"|"RS384"|"RS512"|"ES256"|"ES384"|"ES512"|"PS256"|"PS384"|"PS512"|Param, // The signature algorithm the assertion is signed with, which must be one your provider announces in "token_endpoint_auth_signing_alg_values_supported". FAPI 2.0 asks for "PS256" or "ES256". // Default: "RS256"
 *                     lifetime?: int|Param, // How long an assertion is valid, in seconds. It is built for one request and sent right away, so keep it short: it is the window a provider that does not track the "jti" would accept a captured assertion in. // Default: 60
 *                     audience?: "issuer"|"token_endpoint"|Param, // The audience of the assertion: the issuer of the provider, or its token endpoint for a provider that refuses the issuer. // Default: "issuer"
 *                 },
 *                 tls_client_auth?: bool|Param, // Authenticate with "client_certificate", issued by a certificate authority.
 *                 self_signed_tls_client_auth?: bool|Param, // Authenticate with "client_certificate", self-signed.
 *                 id?: scalar|Param|null, // The id of a service implementing "ClientAuthenticationInterface", for a scheme Symfony does not ship. The method it reports is only known once it is built, so the rules a public client cannot bend are then checked when a login starts on this firewall instead of while the container compiles.
 *             },
 *             dpop?: Param|string|array{ // Binds the tokens the provider issues to a key held by this client (DPoP); a token the provider did not bind is refused.
 *                 key?: scalar|Param|null, // The private key the proofs are signed with, as a JSON-encoded JWK.
 *                 algorithm?: "ES256"|"ES384"|"ES512"|"PS256"|"PS384"|"PS512"|"RS256"|"RS384"|"RS512"|Param, // The algorithm the proofs are signed with, among the "dpop_signing_alg_values_supported" of the provider. // Default: "ES256"
 *             },
 *             scope?: list<scalar|Param|null>,
 *             start_path?: scalar|Param|null, // The path where the route loader declares a route that starts the flow by redirecting to the provider; link to it e.g. from the login page of a firewall offering several ways to log in. A route name is accepted too, in which case no route is declared for it. // Default: "/oidc/start"
 *             discovery_cache_ttl?: int|Param, // TTL in seconds for caching the OIDC discovery configuration, and for the provider JWKS when it advertises no cache lifetime itself. // Default: 3600
 *             allowed_time_drift?: int|Param, // Allowed clock skew in seconds when validating ID token time claims. // Default: 0
 *             user_data_source?: "userinfo"|"id_token"|Param, // Where the user claims are read from: "userinfo" (default) fetches them from the UserInfo endpoint; "id_token" reads them from the validated ID token instead, for providers that put the requested claims there, some of which expose no UserInfo endpoint at all, which is then not required to be announced. // Default: "userinfo"
 *             user_identifier_claim?: scalar|Param|null, // The claim the user identifier is read from. "sub" (default) is the only claim OIDC guarantees stable and unique for the user. Only pick another claim, e.g. "email", when the provider guarantees its value unique, verified and stable too: whoever controls the value of that claim at the provider owns the matching account here. // Default: "sub"
 *             id_token_signature?: array{
 *                 required?: bool|Param, // When true (default), the ID token signature is verified against the provider JWKS. Setting it to false decodes the ID token without verifying it, which OIDC Core 1.0, Section 3.1.3.7, item 6 only allows because the token comes from the token endpoint over TLS: it is then only as safe as the TLS verification of the HTTP client used for that request, so never turn it off with a client configured with "verify_peer: false" or "verify_host: false", nor behind a TLS-terminating proxy. A public client, whose "client_authentication" reports the "none" method, cannot turn it off at all. // Default: true
 *                 algorithms?: list<scalar|Param|null>,
 *                 enforce_key_usage_verification?: bool|Param, // When enabled (default), only keys explicitly designated for signature (via "use":"sig" or a "key_ops" entry containing "sign"/"verify") are accepted. When disabled, keys without any usage designation are also accepted; keys explicitly restricted to encryption are still rejected. // Default: true
 *             },
 *             pkce?: array{
 *                 enabled?: bool|Param, // Whether to use PKCE (Proof Key for Code Exchange, RFC 7636), which any current provider should support; only disable it for one that rejects the "code_challenge" parameter. A public client, whose "client_authentication" reports the "none" method, cannot disable it at all. // Default: true
 *                 method?: "S256"|"plain"|Param, // The PKCE code challenge method. RFC 7636, Section 4.2 mandates "S256" for every client able to compute it, so only ever pick "plain" for a provider that supports nothing else. // Default: "S256"
 *             },
 *             max_age?: int|Param, // Maximum elapsed seconds since the end-user authentication, sent as the "max_age" authorization parameter; the ID token must then carry an "auth_time" claim, which is checked against this value, "allowed_time_drift" included.
 *             authorization_params?: array<string, scalar|Param|null>,
 *             refresh_access_token?: bool|array{ // Renew the access token with the refresh token grant of RFC 6749, Section 6, so that it stays usable to call an API on behalf of the logged-in user. The provider only issues a refresh token when it was asked for one, e.g. with the "offline_access" scope, and the renewal needs the "expires_in" it is optional for the provider to report. Whether this is enabled or not, the tokens are held as the "oauth2_refresh_token", "oauth2_access_token" and "oauth2_access_token_expires_at" attributes of the security token, and the "security.authenticator.oidc_login.token_refresher.<firewall>" service renews them on demand. A provider rotating refresh tokens expects the previous one never to be replayed, which a session handler locking the session guarantees, and the default one does.
 *                 enabled?: bool|Param, // Default: false
 *                 leeway?: int|Param, // How many seconds before its expiry the access token is renewed, so that one handed to a call in flight does not expire on the way. // Default: 30
 *             },
 *             enable_end_session?: bool|Param, // Enable RP-Initiated Logout via the OIDC end_session_endpoint. // Default: false
 *             post_logout_redirect_path?: scalar|Param|null, // Path or route to redirect to after OIDC logout. // Default: "/"
 *             backchannel_logout?: bool|array{ // Accept the logout tokens the OIDC provider posts when one of its sessions ends.
 *                 enabled?: bool|Param, // Default: false
 *                 path?: scalar|Param|null, // Path where the OIDC provider posts its logout tokens. // Default: "/oidc/backchannel-logout"
 *                 cache?: scalar|Param|null, // Id of the cache pool remembering the ended provider sessions, shared by every server of the application. // Default: "cache.security"
 *                 lifetime?: int|Param, // How long an ended provider session is remembered, in seconds; at least how long a session can stay idle. // Default: 86400
 *             },
 *         },
 *         form_login?: array{
 *             provider?: scalar|Param|null,
 *             remember_me?: bool|Param, // Deprecated: Setting the "security.firewalls..form_login.remember_me.remember_me" configuration option has no effect and is deprecated. It will be removed in Symfony 9.0. // Default: true
 *             success_handler?: scalar|Param|null,
 *             failure_handler?: scalar|Param|null,
 *             check_path?: scalar|Param|null, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|Param|null, // Default: "/login"
 *             username_parameter?: scalar|Param|null, // Default: "_username"
 *             password_parameter?: scalar|Param|null, // Default: "_password"
 *             csrf_parameter?: scalar|Param|null, // Default: "_csrf_token"
 *             csrf_token_id?: scalar|Param|null, // Default: "authenticate"
 *             enable_csrf?: bool|Param, // Default: false
 *             post_only?: bool|Param, // Default: true
 *             form_only?: bool|Param, // Default: false
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|Param|null, // Default: "/"
 *             target_path_parameter?: scalar|Param|null, // Default: "_target_path"
 *             use_referer?: bool|Param, // Default: false
 *             failure_path?: scalar|Param|null, // Default: null
 *             failure_forward?: bool|Param, // Default: false
 *             failure_path_parameter?: scalar|Param|null, // Default: "_failure_path"
 *         },
 *         form_login_ldap?: array{
 *             provider?: scalar|Param|null,
 *             remember_me?: bool|Param, // Deprecated: Setting the "security.firewalls..form_login_ldap.remember_me.remember_me" configuration option has no effect and is deprecated. It will be removed in Symfony 9.0. // Default: true
 *             success_handler?: scalar|Param|null,
 *             failure_handler?: scalar|Param|null,
 *             check_path?: scalar|Param|null, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|Param|null, // Default: "/login"
 *             username_parameter?: scalar|Param|null, // Default: "_username"
 *             password_parameter?: scalar|Param|null, // Default: "_password"
 *             csrf_parameter?: scalar|Param|null, // Default: "_csrf_token"
 *             csrf_token_id?: scalar|Param|null, // Default: "authenticate"
 *             enable_csrf?: bool|Param, // Default: false
 *             post_only?: bool|Param, // Default: true
 *             form_only?: bool|Param, // Default: false
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|Param|null, // Default: "/"
 *             target_path_parameter?: scalar|Param|null, // Default: "_target_path"
 *             use_referer?: bool|Param, // Default: false
 *             failure_path?: scalar|Param|null, // Default: null
 *             failure_forward?: bool|Param, // Default: false
 *             failure_path_parameter?: scalar|Param|null, // Default: "_failure_path"
 *             service?: scalar|Param|null, // Default: "ldap"
 *             dn_string?: scalar|Param|null, // Default: "{user_identifier}"
 *             query_string?: scalar|Param|null,
 *             search_dn?: scalar|Param|null, // Default: ""
 *             search_password?: scalar|Param|null, // Default: ""
 *             ldap_users_only?: bool|Param, // Only bind users of class "Symfony\Component\Ldap\Security\LdapUser" against the LDAP server, and leave any other user to the regular password checker. // Default: false
 *         },
 *         json_login?: array{
 *             provider?: scalar|Param|null,
 *             remember_me?: bool|Param, // Deprecated: Setting the "security.firewalls..json_login.remember_me.remember_me" configuration option has no effect and is deprecated. It will be removed in Symfony 9.0. // Default: true
 *             success_handler?: scalar|Param|null,
 *             failure_handler?: scalar|Param|null,
 *             check_path?: scalar|Param|null, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|Param|null, // Default: "/login"
 *             username_path?: scalar|Param|null, // Default: "username"
 *             password_path?: scalar|Param|null, // Default: "password"
 *         },
 *         json_login_ldap?: array{
 *             provider?: scalar|Param|null,
 *             remember_me?: bool|Param, // Deprecated: Setting the "security.firewalls..json_login_ldap.remember_me.remember_me" configuration option has no effect and is deprecated. It will be removed in Symfony 9.0. // Default: true
 *             success_handler?: scalar|Param|null,
 *             failure_handler?: scalar|Param|null,
 *             check_path?: scalar|Param|null, // Default: "/login_check"
 *             use_forward?: bool|Param, // Default: false
 *             login_path?: scalar|Param|null, // Default: "/login"
 *             username_path?: scalar|Param|null, // Default: "username"
 *             password_path?: scalar|Param|null, // Default: "password"
 *             service?: scalar|Param|null, // Default: "ldap"
 *             dn_string?: scalar|Param|null, // Default: "{user_identifier}"
 *             query_string?: scalar|Param|null,
 *             search_dn?: scalar|Param|null, // Default: ""
 *             search_password?: scalar|Param|null, // Default: ""
 *             ldap_users_only?: bool|Param, // Only bind users of class "Symfony\Component\Ldap\Security\LdapUser" against the LDAP server, and leave any other user to the regular password checker. // Default: false
 *         },
 *         access_token?: array{
 *             provider?: scalar|Param|null,
 *             remember_me?: bool|Param, // Deprecated: Setting the "security.firewalls..access_token.remember_me.remember_me" configuration option has no effect and is deprecated. It will be removed in Symfony 9.0. // Default: true
 *             success_handler?: scalar|Param|null,
 *             failure_handler?: scalar|Param|null,
 *             realm?: scalar|Param|null, // Default: null
 *             token_extractors?: Param|string|list<scalar|Param|null>,
 *             token_handler?: Param|string|array{
 *                 id?: scalar|Param|null,
 *                 oidc_user_info?: Param|string|array{
 *                     base_uri?: scalar|Param|null, // Base URI of the userinfo endpoint on the OIDC server, or the OIDC server URI to use the discovery (require "discovery" to be configured). The latter must end with a slash when it has a path, as the discovery path is resolved against it as a relative URL.
 *                     discovery?: array{ // Enable the OIDC discovery.
 *                         cache?: array{
 *                             id?: scalar|Param|null, // Cache service id to use to cache the OIDC discovery configuration. // Default: "cache.security.discovery"
 *                         },
 *                     },
 *                     claim?: scalar|Param|null, // Claim which contains the user identifier (e.g. sub, email, etc.). // Default: "sub"
 *                     client?: scalar|Param|null, // HttpClient service id to use to call the OIDC server.
 *                 },
 *                 oidc?: array{
 *                     discovery?: array{ // Enable the OIDC discovery.
 *                         base_uri?: Param|string|list<scalar|Param|null>,
 *                         cache?: array{
 *                             id?: scalar|Param|null, // Cache service id to use to cache the OIDC discovery configuration. // Default: "cache.security.discovery"
 *                         },
 *                         enforce_key_usage_verification?: bool|Param, // When enabled (default), only keys explicitly designated for signature (via "use":"sig" or a "key_ops" entry containing "sign"/"verify") are accepted. When disabled, keys without any usage designation are also accepted; keys explicitly restricted to encryption are still rejected. // Default: true
 *                         check_issuer?: bool|null|array<string, string|Param>,
 *                     },
 *                     claim?: scalar|Param|null, // Claim which contains the user identifier (e.g.: sub, email..). // Default: "sub"
 *                     audience?: Param|string|list<scalar|Param|null>,
 *                     issuers?: list<scalar|Param|null>,
 *                     algorithms?: list<scalar|Param|null>,
 *                     keyset?: scalar|Param|null, // JSON-encoded JWKSet used to sign the token (must contain a list of valid public keys).
 *                     encryption?: bool|array{
 *                         enabled?: bool|Param, // Default: false
 *                         enforce?: bool|Param, // When enabled, the token shall be encrypted. // Default: false
 *                         algorithms?: list<scalar|Param|null>,
 *                         keyset?: scalar|Param|null, // JSON-encoded JWKSet used to decrypt the token (must contain a list of valid private keys).
 *                     },
 *                     allowed_time_drift?: int|Param, // Allowed time drift in seconds for token validation (iat, nbf, exp claims). // Default: 0
 *                     enforce_at_jwt_type?: bool|Param|null, // When enabled, the "typ" header of the token must be "at+jwt" or "application/at+jwt", as RFC 9068 requires from a JWT access token. This rejects the ID tokens issued for the same audience. Disable it only for providers that do not follow the profile. Defaults to false in 8.2 and to true as of 9.0. // Default: null
 *                 },
 *                 cas?: array{
 *                     validation_url?: scalar|Param|null, // CAS server validation URL
 *                     prefix?: scalar|Param|null, // CAS prefix // Default: "cas"
 *                     http_client?: scalar|Param|null, // HTTP Client service // Default: null
 *                 },
 *                 oauth2?: Param|string|array{
 *                     http_client?: scalar|Param|null, // HttpClient service id the introspection endpoint is called with. Declare it as a scoped client whose "base_uri" is the introspection endpoint of your authorization server and whose "auth_basic" holds the credentials it authenticates with. Those are sent as given, where the "client_secret_basic" of RFC 6749 §2.3.1 form-urlencodes both halves, so encode a client id or a secret holding a colon, a plus or a space yourself.
 *                     audience?: Param|string|list<scalar|Param|null>,
 *                     issuer?: scalar|Param|null, // Identifier of the authorization server, checked against the "iss" of the introspection response. // Default: null
 *                     claim?: scalar|Param|null, // Claim which contains the user identifier (e.g.: sub, username, email...). Defaults to "sub", falling back to "username". // Default: null
 *                     allowed_time_drift?: int|Param, // Allowed time drift in seconds when validating the "iat", "nbf" and "exp" of the introspection response. // Default: 0
 *                     cache?: array{ // Cache the introspection responses of active tokens, never beyond their "exp".
 *                         id?: scalar|Param|null, // Cache service id to use to cache the introspection responses.
 *                         ttl?: int|Param, // Maximum lifetime in seconds of a cached introspection response. The shorter it is, the sooner a revoked token stops being accepted. // Default: 60
 *                     },
 *                     response_signature?: bool|array{ // Ask the authorization server for a signed introspection response (RFC 9701) and verify it.
 *                         enabled?: bool|Param, // Default: false
 *                         enforce?: bool|Param, // When enabled (default), a plain JSON introspection response is refused. // Default: true
 *                         algorithms?: list<scalar|Param|null>,
 *                         discovery?: bool|array{ // Read the keys the introspection response is verified against from the RFC 8414 metadata of the authorization server, whose URL is derived from the "issuer" this handler already declares. Only the "jwks_uri" is read from it: which algorithms are accepted stays declared here, so that an authorization server cannot widen it by announcing more.
 *                             enabled?: bool|Param, // Default: false
 *                             cache?: array{
 *                                 id?: scalar|Param|null, // Cache service id the metadata document and the keys it points at are stored in. // Default: "cache.security.discovery"
 *                             },
 *                         },
 *                         keyset?: scalar|Param|null, // JSON-encoded JWKSet holding the public keys of your authorization server, the ones it announces at its "jwks_uri", which the introspection response is verified against. // Default: null
 *                     },
 *                 },
 *             },
 *             resource_metadata?: array{ // Declaring this node serves the RFC 9728 protected resource metadata document of the firewall at "/.well-known/oauth-protected-resource" and advertises its URL in the "resource_metadata" parameter of the "WWW-Authenticate" header, which is how a client discovers where to get a token this firewall accepts. The route is declared by the "security.route_loader" service, which the application must import. Make sure the route is reachable without a token.
 *                 resource?: scalar|Param|null, // The resource identifier of this firewall: an HTTPS URL without a fragment (e.g. "https://example.com/api"), read when the container is compiled, or a path (e.g. "/api") resolved against the origin of the request. Its path is inserted after the well-known path, as RFC 9728, Section 3.1 prescribes. Defaults to the origin of the request, which is what a firewall covering a whole application wants. // Default: null
 *                 authorization_servers?: Param|string|list<scalar|Param|null>,
 *                 jwks_uri?: scalar|Param|null, // URL of the JWK Set holding the keys this resource signs its own responses with. Unrelated to the keys the access tokens are verified against, which belong to the authorization server. // Default: null
 *                 scopes_supported?: Param|string|list<scalar|Param|null>,
 *                 bearer_methods_supported?: Param|string|list<"header"|"body"|"query"|Param>,
 *                 resource_name?: scalar|Param|null, // Human-readable name of this resource, meant to be displayed to the end user. // Default: null
 *                 resource_documentation?: scalar|Param|null, // URL of the developer documentation of this resource. // Default: null
 *                 resource_policy_uri?: scalar|Param|null, // URL of the policy telling how the client may use the data this resource exposes. // Default: null
 *                 resource_tos_uri?: scalar|Param|null, // URL of the terms of service of this resource. // Default: null
 *             },
 *             dpop?: bool|array{ // Accepts only the access tokens bound to a key the request proves it holds (DPoP), presented under the "DPoP" scheme.
 *                 enabled?: bool|Param, // Default: false
 *                 algorithms?: list<scalar|Param|null>,
 *                 cache?: scalar|Param|null, // The cache pool proofs are remembered in to refuse a replay, shared by all the instances of the application. // Default: "cache.security"
 *                 proof_lifetime?: int|Param, // How long a proof is accepted after its "iat", in seconds. // Default: 60
 *                 allowed_time_drift?: int|Param, // Allowed time drift in seconds for the "iat" of a proof, both ways. // Default: 5
 *             },
 *         },
 *         http_basic?: array{
 *             provider?: scalar|Param|null,
 *             realm?: scalar|Param|null, // Default: "Secured Area"
 *         },
 *         http_basic_ldap?: array{
 *             provider?: scalar|Param|null,
 *             realm?: scalar|Param|null, // Default: "Secured Area"
 *             service?: scalar|Param|null, // Default: "ldap"
 *             dn_string?: scalar|Param|null, // Default: "{user_identifier}"
 *             query_string?: scalar|Param|null,
 *             search_dn?: scalar|Param|null, // Default: ""
 *             search_password?: scalar|Param|null, // Default: ""
 *             ldap_users_only?: bool|Param, // Only bind users of class "Symfony\Component\Ldap\Security\LdapUser" against the LDAP server, and leave any other user to the regular password checker. // Default: false
 *         },
 *         remember_me?: array{
 *             secret?: Param|string|list<scalar|Param|null>,
 *             service?: scalar|Param|null,
 *             user_providers?: Param|string|list<scalar|Param|null>,
 *             catch_exceptions?: bool|Param, // Default: true
 *             signature_properties?: list<scalar|Param|null>,
 *             token_provider?: Param|string|array{
 *                 service?: scalar|Param|null, // The service ID of a custom remember-me token provider.
 *                 doctrine?: bool|array{
 *                     enabled?: bool|Param, // Default: false
 *                     connection?: scalar|Param|null, // Default: null
 *                 },
 *             },
 *             token_verifier?: scalar|Param|null, // The service ID of a custom rememberme token verifier.
 *             name?: scalar|Param|null, // Default: "REMEMBERME"
 *             lifetime?: int|Param, // Default: 31536000
 *             path?: scalar|Param|null, // Default: "/"
 *             domain?: scalar|Param|null, // Default: null
 *             secure?: true|false|"auto"|Param, // Defaults to the value of "framework.session.cookie_secure", or to "auto".
 *             httponly?: bool|Param, // Default: true
 *             samesite?: null|"lax"|"strict"|"none"|Param, // Defaults to the value of "framework.session.cookie_samesite", or to "lax".
 *             always_remember_me?: bool|Param, // Default: false
 *             remember_me_parameter?: scalar|Param|null, // Default: "_remember_me"
 *         },
 *         two_factor?: array{
 *             check_path?: scalar|Param|null, // Default: "/2fa_check"
 *             post_only?: bool|Param, // Default: true
 *             auth_form_path?: scalar|Param|null, // Default: "/2fa"
 *             always_use_default_target_path?: bool|Param, // Default: false
 *             default_target_path?: scalar|Param|null, // Default: "/"
 *             success_handler?: scalar|Param|null, // Default: null
 *             failure_handler?: scalar|Param|null, // Default: null
 *             authentication_required_handler?: scalar|Param|null, // Default: null
 *             auth_code_parameter_name?: scalar|Param|null, // Default: "_auth_code"
 *             trusted_parameter_name?: scalar|Param|null, // Default: "_trusted"
 *             remember_me_sets_trusted?: scalar|Param|null, // Default: false
 *             multi_factor?: bool|Param, // Default: false
 *             prepare_on_login?: bool|Param, // Default: false
 *             prepare_on_access_denied?: bool|Param, // Default: false
 *             enable_csrf?: scalar|Param|null, // Default: false
 *             csrf_parameter?: scalar|Param|null, // Default: "_csrf_token"
 *             csrf_token_id?: scalar|Param|null, // Default: "two_factor"
 *             csrf_header?: scalar|Param|null, // Default: null
 *             csrf_token_manager?: scalar|Param|null, // Default: "scheb_two_factor.csrf_token_manager"
 *             provider?: scalar|Param|null, // Default: null
 *         },
 *     }>,
 *     access_control?: list<array{ // Default: []
 *         request_matcher?: scalar|Param|null, // Default: null
 *         requires_channel?: scalar|Param|null, // Default: null
 *         path?: scalar|Param|null, // Use the urldecoded format. // Default: null
 *         host?: scalar|Param|null, // Default: null
 *         port?: int|Param, // Default: null
 *         ips?: Param|string|list<scalar|Param|null>,
 *         attributes?: array<string, scalar|Param|null>,
 *         route?: scalar|Param|null, // Default: null
 *         methods?: Param|string|list<scalar|Param|null>,
 *         allow_if?: scalar|Param|null, // Default: null
 *         roles?: Param|string|list<scalar|Param|null>,
 *     }>,
 *     role_hierarchy?: array<string, Param|string|list<scalar|Param|null>>,
 * }
 * @psalm-type NelmioSecurityConfig = array{
 *     signed_cookie?: array{
 *         names?: list<scalar|Param|null>,
 *         secret?: scalar|Param|null, // Default: "%kernel.secret%"
 *         hash_algo?: scalar|Param|null,
 *         legacy_hash_algo?: scalar|Param|null, // Fallback algorithm to allow for frictionless hash algorithm upgrades. Use with caution and as a temporary measure as it allows for downgrade attacks. // Default: null
 *         separator?: scalar|Param|null, // Default: "."
 *     },
 *     clickjacking?: array{
 *         hosts?: list<scalar|Param|null>,
 *         paths?: array<string, array{ // Default: {"^/.*":{"header":"DENY"}}
 *             header?: scalar|Param|null, // Default: "DENY"
 *             ...<string, mixed>
 *         }>,
 *         content_types?: list<scalar|Param|null>,
 *     },
 *     external_redirects?: array{
 *         abort?: bool|Param, // Default: false
 *         override?: scalar|Param|null, // Default: null
 *         forward_as?: scalar|Param|null, // Default: null
 *         log?: bool|Param, // Default: false
 *         allow_list?: list<scalar|Param|null>,
 *     },
 *     flexible_ssl?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         cookie_name?: scalar|Param|null, // Default: "auth"
 *         unsecured_logout?: bool|Param, // Default: false
 *     },
 *     forced_ssl?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         hsts_max_age?: scalar|Param|null, // Default: null
 *         hsts_subdomains?: bool|Param, // Default: false
 *         hsts_preload?: bool|Param, // Default: false
 *         allow_list?: list<scalar|Param|null>,
 *         hosts?: list<scalar|Param|null>,
 *         redirect_status_code?: scalar|Param|null, // Default: 302
 *     },
 *     content_type?: array{
 *         nosniff?: bool|Param, // Default: false
 *     },
 *     xss_protection?: array{ // Deprecated: The "xss_protection" option is deprecated, use Content Security Policy without allowing "unsafe-inline" scripts instead.
 *         enabled?: bool|Param, // Default: false
 *         mode_block?: bool|Param, // Default: false
 *         report_uri?: scalar|Param|null, // Default: null
 *     },
 *     csp?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *         request_matcher?: scalar|Param|null, // Default: null
 *         hosts?: list<scalar|Param|null>,
 *         content_types?: list<scalar|Param|null>,
 *         report_endpoint?: array{
 *             log_channel?: scalar|Param|null, // Default: null
 *             log_formatter?: scalar|Param|null, // Default: "nelmio_security.csp_report.log_formatter"
 *             log_level?: "alert"|"critical"|"debug"|"emergency"|"error"|"info"|"notice"|"warning"|Param, // Default: "notice"
 *             filters?: array{
 *                 domains?: bool|Param, // Default: true
 *                 schemes?: bool|Param, // Default: true
 *                 browser_bugs?: bool|Param, // Default: true
 *                 injected_scripts?: bool|Param, // Default: true
 *             },
 *             dismiss?: list<list<"default-src"|"base-uri"|"block-all-mixed-content"|"child-src"|"connect-src"|"font-src"|"form-action"|"frame-ancestors"|"frame-src"|"img-src"|"manifest-src"|"media-src"|"object-src"|"plugin-types"|"script-src"|"style-src"|"upgrade-insecure-requests"|"report-uri"|"worker-src"|"prefetch-src"|"report-to"|"*"|Param>>,
 *         },
 *         compat_headers?: bool|Param, // Default: true
 *         report_logger_service?: scalar|Param|null, // Default: "logger"
 *         hash?: array{
 *             algorithm?: "sha256"|"sha384"|"sha512"|Param, // The algorithm to use for hashes // Default: "sha256"
 *         },
 *         report?: array{
 *             level1_fallback?: bool|Param, // Provides CSP Level 1 fallback when using hash or nonce (CSP level 2) by adding 'unsafe-inline' source. See https://www.w3.org/TR/CSP2/#directive-script-src and https://www.w3.org/TR/CSP2/#directive-style-src // Default: true
 *             browser_adaptive?: bool|array{ // Do not send directives that browser do not support
 *                 enabled?: bool|Param, // Default: false
 *                 parser?: scalar|Param|null, // Default: "nelmio_security.ua_parser.ua_php"
 *             },
 *             default-src?: list<scalar|Param|null>,
 *             base-uri?: list<scalar|Param|null>,
 *             block-all-mixed-content?: bool|Param, // Default: false
 *             child-src?: list<scalar|Param|null>,
 *             connect-src?: list<scalar|Param|null>,
 *             font-src?: list<scalar|Param|null>,
 *             form-action?: list<scalar|Param|null>,
 *             frame-ancestors?: list<scalar|Param|null>,
 *             frame-src?: list<scalar|Param|null>,
 *             img-src?: list<scalar|Param|null>,
 *             manifest-src?: list<scalar|Param|null>,
 *             media-src?: list<scalar|Param|null>,
 *             object-src?: list<scalar|Param|null>,
 *             plugin-types?: list<scalar|Param|null>,
 *             script-src?: list<scalar|Param|null>,
 *             style-src?: list<scalar|Param|null>,
 *             upgrade-insecure-requests?: bool|Param, // Default: false
 *             report-uri?: Param|string|list<scalar|Param|null>,
 *             worker-src?: list<scalar|Param|null>,
 *             prefetch-src?: list<scalar|Param|null>,
 *             report-to?: scalar|Param|null,
 *         },
 *         enforce?: array{
 *             level1_fallback?: bool|Param, // Provides CSP Level 1 fallback when using hash or nonce (CSP level 2) by adding 'unsafe-inline' source. See https://www.w3.org/TR/CSP2/#directive-script-src and https://www.w3.org/TR/CSP2/#directive-style-src // Default: true
 *             browser_adaptive?: bool|array{ // Do not send directives that browser do not support
 *                 enabled?: bool|Param, // Default: false
 *                 parser?: scalar|Param|null, // Default: "nelmio_security.ua_parser.ua_php"
 *             },
 *             default-src?: list<scalar|Param|null>,
 *             base-uri?: list<scalar|Param|null>,
 *             block-all-mixed-content?: bool|Param, // Default: false
 *             child-src?: list<scalar|Param|null>,
 *             connect-src?: list<scalar|Param|null>,
 *             font-src?: list<scalar|Param|null>,
 *             form-action?: list<scalar|Param|null>,
 *             frame-ancestors?: list<scalar|Param|null>,
 *             frame-src?: list<scalar|Param|null>,
 *             img-src?: list<scalar|Param|null>,
 *             manifest-src?: list<scalar|Param|null>,
 *             media-src?: list<scalar|Param|null>,
 *             object-src?: list<scalar|Param|null>,
 *             plugin-types?: list<scalar|Param|null>,
 *             script-src?: list<scalar|Param|null>,
 *             style-src?: list<scalar|Param|null>,
 *             upgrade-insecure-requests?: bool|Param, // Default: false
 *             report-uri?: Param|string|list<scalar|Param|null>,
 *             worker-src?: list<scalar|Param|null>,
 *             prefetch-src?: list<scalar|Param|null>,
 *             report-to?: scalar|Param|null,
 *         },
 *     },
 *     referrer_policy?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         policies?: Param|string|list<scalar|Param|null>,
 *     },
 *     permissions_policy?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         policies?: array{
 *             accelerometer?: mixed, // Default: null
 *             ambient_light_sensor?: mixed, // Default: null
 *             attribution_reporting?: mixed, // Default: null
 *             autoplay?: mixed, // Default: null
 *             bluetooth?: mixed, // Default: null
 *             browsing_topics?: mixed, // Default: null
 *             camera?: mixed, // Default: null
 *             captured_surface_control?: mixed, // Default: null
 *             compute_pressure?: mixed, // Default: null
 *             cross_origin_isolated?: mixed, // Default: null
 *             deferred_fetch?: mixed, // Default: null
 *             deferred_fetch_minimal?: mixed, // Default: null
 *             display_capture?: mixed, // Default: null
 *             encrypted_media?: mixed, // Default: null
 *             fullscreen?: mixed, // Default: null
 *             gamepad?: mixed, // Default: null
 *             geolocation?: mixed, // Default: null
 *             gyroscope?: mixed, // Default: null
 *             hid?: mixed, // Default: null
 *             identity_credentials_get?: mixed, // Default: null
 *             idle_detection?: mixed, // Default: null
 *             interest_cohort?: mixed, // Default: null
 *             language_detector?: mixed, // Default: null
 *             local_fonts?: mixed, // Default: null
 *             magnetometer?: mixed, // Default: null
 *             microphone?: mixed, // Default: null
 *             midi?: mixed, // Default: null
 *             otp_credentials?: mixed, // Default: null
 *             payment?: mixed, // Default: null
 *             picture_in_picture?: mixed, // Default: null
 *             publickey_credentials_create?: mixed, // Default: null
 *             publickey_credentials_get?: mixed, // Default: null
 *             screen_wake_lock?: mixed, // Default: null
 *             serial?: mixed, // Default: null
 *             speaker_selection?: mixed, // Default: null
 *             storage_access?: mixed, // Default: null
 *             summarizer?: mixed, // Default: null
 *             translator?: mixed, // Default: null
 *             usb?: mixed, // Default: null
 *             web_share?: mixed, // Default: null
 *             window_management?: mixed, // Default: null
 *             xr_spatial_tracking?: mixed, // Default: null
 *         },
 *     },
 *     cross_origin_isolation?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         paths?: array<string, array{ // Default: []
 *             coep?: "unsafe-none"|"require-corp"|"credentialless"|Param, // Cross-Origin-Embedder-Policy (COEP) header value
 *             coop?: "unsafe-none"|"same-origin-allow-popups"|"same-origin"|"noopener-allow-popups"|Param, // Cross-Origin-Opener-Policy (COOP) header value
 *             corp?: "same-site"|"same-origin"|"cross-origin"|Param, // Cross-Origin-Resource-Policy (CORP) header value
 *             report_only?: bool|Param, // Use Report-Only headers instead of enforcing (applies to COEP and COOP only) // Default: false
 *             report_to?: scalar|Param|null, // Reporting endpoint name for violations (requires Reporting API configuration, applies to COEP and COOP only) // Default: null
 *         }>,
 *     },
 * }
 * @psalm-type KnpMenuConfig = array{
 *     providers?: array{
 *         builder_alias?: bool|Param, // Default: true
 *     },
 *     twig?: array{
 *         template?: scalar|Param|null, // Default: "@KnpMenu/menu.html.twig"
 *     },
 *     route_voter?: bool|Param, // Default: true
 *     default_renderer?: scalar|Param|null, // Default: "twig"
 * }
 * @psalm-type WebProfilerConfig = array{
 *     toolbar?: bool|array{ // Profiler toolbar configuration
 *         enabled?: bool|Param, // Default: false
 *         ajax_replace?: bool|Param, // Replace toolbar on AJAX requests // Default: false
 *     },
 *     intercept_redirects?: bool|Param, // Default: false
 *     excluded_ajax_paths?: scalar|Param|null, // Default: "^/((index|app(_[\\w]+)?)\\.php/)?_wdt"
 * }
 * @psalm-type MonologConfig = array{
 *     use_microseconds?: scalar|Param|null, // Default: true
 *     timezone?: string|Param, // The timezone used for the timestamp of every log record (e.g. "UTC" or "Europe/Paris"). Defaults to the PHP default timezone. // Default: null
 *     channels?: list<scalar|Param|null>,
 *     handlers?: array<string, array{ // Default: []
 *         type?: scalar|Param|null,
 *         id?: scalar|Param|null,
 *         enabled?: bool|Param, // Default: true
 *         priority?: scalar|Param|null, // Default: 0
 *         level?: scalar|Param|null, // Default: "DEBUG"
 *         bubble?: bool|Param, // Default: true
 *         interactive_only?: bool|Param, // Default: false
 *         app_name?: scalar|Param|null, // Default: null
 *         include_stacktraces?: bool|Param, // Default: false
 *         base_path?: scalar|Param|null, // Default: null
 *         process_psr_3_messages?: array{
 *             enabled?: bool|Param|null, // Default: null
 *             date_format?: scalar|Param|null,
 *             remove_used_context_fields?: bool|Param,
 *             ...<string, mixed>
 *         },
 *         path?: scalar|Param|null, // Default: "%kernel.logs_dir%/%kernel.environment%.log"
 *         file_permission?: scalar|Param|null, // Default: null
 *         use_locking?: bool|Param, // Default: false
 *         filename_format?: scalar|Param|null, // Default: "{filename}-{date}"
 *         date_format?: scalar|Param|null, // Default: "Y-m-d"
 *         ident?: scalar|Param|null, // Default: "php"
 *         logopts?: scalar|Param|null, // Default: 1
 *         facility?: scalar|Param|null, // Default: "user"
 *         max_files?: scalar|Param|null, // Default: 0
 *         action_level?: scalar|Param|null, // Default: "WARNING"
 *         activation_strategy?: scalar|Param|null, // Default: null
 *         stop_buffering?: bool|Param, // Default: true
 *         passthru_level?: scalar|Param|null, // Default: null
 *         excluded_http_codes?: list<array{ // Default: []
 *             code?: scalar|Param|null,
 *             urls?: list<scalar|Param|null>,
 *         }>,
 *         accepted_levels?: list<scalar|Param|null>,
 *         min_level?: scalar|Param|null, // Default: "DEBUG"
 *         max_level?: scalar|Param|null, // Default: "EMERGENCY"
 *         buffer_size?: scalar|Param|null, // Default: 0
 *         flush_on_overflow?: bool|Param, // Default: false
 *         handler?: scalar|Param|null,
 *         url?: scalar|Param|null,
 *         exchange?: scalar|Param|null,
 *         exchange_name?: scalar|Param|null, // Default: "log"
 *         channel?: scalar|Param|null, // Default: null
 *         bot_name?: scalar|Param|null, // Default: "Monolog"
 *         use_attachment?: scalar|Param|null, // Default: true
 *         use_short_attachment?: scalar|Param|null, // Default: false
 *         include_extra?: scalar|Param|null, // Default: false
 *         icon_emoji?: scalar|Param|null, // Default: null
 *         webhook_url?: scalar|Param|null,
 *         exclude_fields?: list<scalar|Param|null>,
 *         token?: scalar|Param|null,
 *         region?: scalar|Param|null,
 *         source?: scalar|Param|null,
 *         use_ssl?: bool|Param, // Default: true
 *         user?: mixed,
 *         title?: scalar|Param|null, // Default: null
 *         host?: scalar|Param|null, // Default: null
 *         port?: scalar|Param|null, // Default: 514
 *         rfc?: scalar|Param|null, // Default: 1
 *         config?: list<scalar|Param|null>,
 *         members?: list<scalar|Param|null>,
 *         connection_string?: scalar|Param|null,
 *         timeout?: scalar|Param|null,
 *         time?: scalar|Param|null, // Default: 60
 *         deduplication_level?: scalar|Param|null, // Default: 400
 *         store?: scalar|Param|null, // Default: null
 *         connection_timeout?: scalar|Param|null,
 *         persistent?: bool|Param,
 *         message_type?: scalar|Param|null, // Default: 0
 *         expand_newlines?: bool|Param, // Default: false
 *         parse_mode?: scalar|Param|null, // Default: null
 *         disable_webpage_preview?: bool|Param|null, // Default: null
 *         disable_notification?: bool|Param|null, // Default: null
 *         split_long_messages?: bool|Param, // Default: false
 *         delay_between_messages?: bool|Param, // Default: false
 *         topic?: int|Param, // Default: null
 *         factor?: int|Param, // Default: 1
 *         tags?: Param|string|list<scalar|Param|null>,
 *         console_formatter_options?: mixed, // Default: []
 *         formatter?: scalar|Param|null,
 *         nested?: bool|Param, // Default: false
 *         publisher?: Param|string|array{
 *             id?: scalar|Param|null,
 *             hostname?: scalar|Param|null,
 *             port?: scalar|Param|null, // Default: 12201
 *             chunk_size?: scalar|Param|null, // Default: 1420
 *             encoder?: "json"|"compressed_json"|Param,
 *         },
 *         mongodb?: Param|string|array{
 *             id?: scalar|Param|null, // ID of a MongoDB\Client service
 *             uri?: scalar|Param|null,
 *             username?: scalar|Param|null,
 *             password?: scalar|Param|null,
 *             database?: scalar|Param|null, // Default: "monolog"
 *             collection?: scalar|Param|null, // Default: "logs"
 *         },
 *         elasticsearch?: Param|string|array{
 *             id?: scalar|Param|null,
 *             hosts?: list<scalar|Param|null>,
 *             host?: scalar|Param|null,
 *             port?: scalar|Param|null, // Default: 9200
 *             transport?: scalar|Param|null, // Default: "Http"
 *             user?: scalar|Param|null, // Default: null
 *             password?: scalar|Param|null, // Default: null
 *         },
 *         index?: scalar|Param|null, // Default: "monolog"
 *         document_type?: scalar|Param|null, // Default: "logs"
 *         ignore_error?: scalar|Param|null, // Default: false
 *         redis?: Param|string|array{
 *             id?: scalar|Param|null,
 *             host?: scalar|Param|null,
 *             password?: scalar|Param|null, // Default: null
 *             port?: scalar|Param|null, // Default: 6379
 *             database?: scalar|Param|null, // Default: 0
 *             key_name?: scalar|Param|null, // Default: "monolog_redis"
 *         },
 *         predis?: Param|string|array{ // Deprecated: The "predis" option is deprecated and ignored, use the "redis" option to configure the Predis client.
 *             id?: scalar|Param|null,
 *             host?: scalar|Param|null,
 *         },
 *         from_email?: scalar|Param|null,
 *         to_email?: Param|string|list<scalar|Param|null>,
 *         subject?: scalar|Param|null,
 *         content_type?: scalar|Param|null, // Default: null
 *         headers?: list<scalar|Param|null>,
 *         parameters?: list<scalar|Param|null>,
 *         mailer?: scalar|Param|null, // Default: null
 *         email_prototype?: Param|string|array{
 *             id?: scalar|Param|null,
 *             method?: scalar|Param|null, // Default: null
 *         },
 *         verbosity_levels?: array{
 *             VERBOSITY_QUIET?: scalar|Param|null, // Default: "ERROR"
 *             VERBOSITY_NORMAL?: scalar|Param|null, // Default: "WARNING"
 *             VERBOSITY_VERBOSE?: scalar|Param|null, // Default: "NOTICE"
 *             VERBOSITY_VERY_VERBOSE?: scalar|Param|null, // Default: "INFO"
 *             VERBOSITY_DEBUG?: scalar|Param|null, // Default: "DEBUG"
 *         },
 *         channels?: Param|string|array{
 *             type?: scalar|Param|null,
 *             elements?: list<scalar|Param|null>,
 *             ...<string, mixed>
 *         },
 *     }>,
 * }
 * @psalm-type DebugConfig = array{
 *     max_items?: int|Param, // Max number of displayed items past the first level, -1 means no limit. // Default: 2500
 *     min_depth?: int|Param, // Minimum tree depth to clone all the items, 1 is default. // Default: 1
 *     max_string_length?: int|Param, // Max length of displayed strings, -1 means no limit. // Default: -1
 *     dump_destination?: scalar|Param|null, // A stream URL where dumps should be written to. // Default: null
 *     theme?: "dark"|"light"|Param, // Changes the color of the dump() output when rendered directly on the templating. "dark" (default) or "light". // Default: "dark"
 * }
 * @psalm-type MakerConfig = array{
 *     root_namespace?: scalar|Param|null, // Default: "App"
 *     generate_final_classes?: bool|Param, // Default: true
 *     generate_final_entities?: bool|Param, // Default: false
 * }
 * @psalm-type StimulusConfig = array{
 *     controller_paths?: list<scalar|Param|null>,
 *     controllers_json?: scalar|Param|null, // Default: "%kernel.project_dir%/assets/controllers.json"
 * }
 * @psalm-type TurboConfig = array{
 *     broadcast?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *         entity_template_prefixes?: list<scalar|Param|null>,
 *         doctrine_orm?: bool|array{ // Enable the Doctrine ORM integration
 *             enabled?: bool|Param, // Default: true
 *         },
 *     },
 *     default_transport?: scalar|Param|null, // Default: "default"
 *     mercure?: array{
 *         ignore_cookie_domain_errors?: bool|Param, // Render nothing and log a warning, instead of failing, when the authorization cookie of a private stream source cannot be created because the page is served on another domain than the hub // Default: false
 *     },
 * }
 * @psalm-type SymfonycastsSassConfig = array{
 *     root_sass?: list<scalar|Param|null>,
 *     binary?: scalar|Param|null, // The Sass binary to use // Default: null
 *     search_for_binary?: scalar|Param|null, // Whether to search for the Sass binary in the system PATH // Default: true
 *     sass_options?: array{
 *         style?: "compressed"|"expanded"|Param, // The style of the generated CSS: compressed or expanded. // Default: "expanded"
 *         charset?: bool|Param, // Whether to include the charset declaration in the generated Sass.
 *         error_css?: bool|Param, // Emit a CSS file when an error occurs.
 *         source_map?: bool|Param, // Whether to generate source maps. // Default: true
 *         embed_sources?: bool|Param, // Embed source file contents in source maps.
 *         embed_source_map?: bool|Param, // Embed source map contents in CSS. // Default: "%kernel.debug%"
 *         load_path?: list<scalar|Param|null>,
 *         quiet?: bool|Param, // Don't print warnings.
 *         quiet_deps?: bool|Param, // Don't print compiler warnings from dependencies.
 *         stop_on_error?: bool|Param, // Don't compile more files once an error is encountered.
 *         trace?: bool|Param, // Print full Dart stack traces for exceptions.
 *     },
 *     embed_sourcemap?: bool|Param|null, // Deprecated: Option "embed_sourcemap" at "symfonycasts_sass.embed_sourcemap" is deprecated. Use "sass_options.embed_source_map" instead". // Default: null
 * }
 * @psalm-type SchebTwoFactorConfig = array{
 *     persister?: scalar|Param|null, // Default: "scheb_two_factor.persister.doctrine"
 *     model_manager_name?: scalar|Param|null, // Default: null
 *     security_tokens?: list<scalar|Param|null>,
 *     ip_whitelist?: list<scalar|Param|null>,
 *     ip_whitelist_provider?: scalar|Param|null, // Default: "scheb_two_factor.default_ip_whitelist_provider"
 *     two_factor_token_factory?: scalar|Param|null, // Default: "scheb_two_factor.default_token_factory"
 *     two_factor_provider_decider?: scalar|Param|null, // Default: "scheb_two_factor.default_provider_decider"
 *     two_factor_condition?: scalar|Param|null, // Default: null
 *     code_reuse_cache?: scalar|Param|null, // Default: null
 *     code_reuse_cache_duration?: int|Param, // Default: 60
 *     code_reuse_default_handler?: scalar|Param|null, // Default: null
 *     trusted_device?: bool|array{
 *         enabled?: scalar|Param|null, // Default: false
 *         manager?: scalar|Param|null, // Default: "scheb_two_factor.default_trusted_device_manager"
 *         lifetime?: int|Param, // Default: 5184000
 *         extend_lifetime?: bool|Param, // Default: false
 *         key?: scalar|Param|null, // Default: null
 *         cookie_name?: scalar|Param|null, // Default: "trusted_device"
 *         cookie_secure?: true|false|"auto"|Param, // Default: "auto"
 *         cookie_domain?: scalar|Param|null, // Default: null
 *         cookie_path?: scalar|Param|null, // Default: "/"
 *         cookie_same_site?: scalar|Param|null, // Default: "lax"
 *     },
 *     backup_codes?: bool|array{
 *         enabled?: scalar|Param|null, // Default: false
 *         manager?: scalar|Param|null, // Default: "scheb_two_factor.default_backup_code_manager"
 *     },
 *     totp?: bool|array{
 *         enabled?: scalar|Param|null, // Default: false
 *         form_renderer?: scalar|Param|null, // Default: null
 *         issuer?: scalar|Param|null, // Default: null
 *         server_name?: scalar|Param|null, // Default: null
 *         leeway?: int|Param, // Default: 0
 *         parameters?: list<scalar|Param|null>,
 *         template?: scalar|Param|null, // Default: "@SchebTwoFactor/Authentication/form.html.twig"
 *     },
 * }
 * @psalm-type ConfigType = array{
 *     imports?: ImportsConfig,
 *     parameters?: ParametersConfig,
 *     services?: ServicesConfig,
 *     router?: RouterConfig,
 *     cache?: CacheConfig,
 *     asset?: AssetConfig,
 *     validation?: ValidationConfig,
 *     translation?: TranslationConfig,
 *     messenger?: MessengerConfig,
 *     type_info?: TypeInfoConfig,
 *     property_access?: PropertyAccessConfig,
 *     property_info?: PropertyInfoConfig,
 *     asset_mapper?: AssetMapperConfig,
 *     rate_limiter?: RateLimiterConfig,
 *     http_client?: HttpClientConfig,
 *     mailer?: MailerConfig,
 *     framework?: FrameworkConfig,
 *     doctrine?: DoctrineConfig,
 *     doctrine_migrations?: DoctrineMigrationsConfig,
 *     twig?: TwigConfig,
 *     twig_extra?: TwigExtraConfig,
 *     security?: SecurityConfig,
 *     nelmio_security?: NelmioSecurityConfig,
 *     knp_menu?: KnpMenuConfig,
 *     monolog?: MonologConfig,
 *     stimulus?: StimulusConfig,
 *     turbo?: TurboConfig,
 *     symfonycasts_sass?: SymfonycastsSassConfig,
 *     scheb_two_factor?: SchebTwoFactorConfig,
 *     "when@dev"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         router?: RouterConfig,
 *         cache?: CacheConfig,
 *         asset?: AssetConfig,
 *         validation?: ValidationConfig,
 *         translation?: TranslationConfig,
 *         messenger?: MessengerConfig,
 *         type_info?: TypeInfoConfig,
 *         property_access?: PropertyAccessConfig,
 *         property_info?: PropertyInfoConfig,
 *         asset_mapper?: AssetMapperConfig,
 *         rate_limiter?: RateLimiterConfig,
 *         http_client?: HttpClientConfig,
 *         mailer?: MailerConfig,
 *         framework?: FrameworkConfig,
 *         doctrine?: DoctrineConfig,
 *         doctrine_migrations?: DoctrineMigrationsConfig,
 *         twig?: TwigConfig,
 *         twig_extra?: TwigExtraConfig,
 *         security?: SecurityConfig,
 *         nelmio_security?: NelmioSecurityConfig,
 *         knp_menu?: KnpMenuConfig,
 *         web_profiler?: WebProfilerConfig,
 *         monolog?: MonologConfig,
 *         debug?: DebugConfig,
 *         maker?: MakerConfig,
 *         stimulus?: StimulusConfig,
 *         turbo?: TurboConfig,
 *         symfonycasts_sass?: SymfonycastsSassConfig,
 *         scheb_two_factor?: SchebTwoFactorConfig,
 *     },
 *     "when@prod"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         router?: RouterConfig,
 *         cache?: CacheConfig,
 *         asset?: AssetConfig,
 *         validation?: ValidationConfig,
 *         translation?: TranslationConfig,
 *         messenger?: MessengerConfig,
 *         type_info?: TypeInfoConfig,
 *         property_access?: PropertyAccessConfig,
 *         property_info?: PropertyInfoConfig,
 *         asset_mapper?: AssetMapperConfig,
 *         rate_limiter?: RateLimiterConfig,
 *         http_client?: HttpClientConfig,
 *         mailer?: MailerConfig,
 *         framework?: FrameworkConfig,
 *         doctrine?: DoctrineConfig,
 *         doctrine_migrations?: DoctrineMigrationsConfig,
 *         sentry?: SentryConfig,
 *         twig?: TwigConfig,
 *         twig_extra?: TwigExtraConfig,
 *         security?: SecurityConfig,
 *         nelmio_security?: NelmioSecurityConfig,
 *         knp_menu?: KnpMenuConfig,
 *         monolog?: MonologConfig,
 *         stimulus?: StimulusConfig,
 *         turbo?: TurboConfig,
 *         symfonycasts_sass?: SymfonycastsSassConfig,
 *         scheb_two_factor?: SchebTwoFactorConfig,
 *     },
 *     "when@test"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         router?: RouterConfig,
 *         cache?: CacheConfig,
 *         asset?: AssetConfig,
 *         validation?: ValidationConfig,
 *         translation?: TranslationConfig,
 *         messenger?: MessengerConfig,
 *         type_info?: TypeInfoConfig,
 *         property_access?: PropertyAccessConfig,
 *         property_info?: PropertyInfoConfig,
 *         asset_mapper?: AssetMapperConfig,
 *         rate_limiter?: RateLimiterConfig,
 *         http_client?: HttpClientConfig,
 *         mailer?: MailerConfig,
 *         framework?: FrameworkConfig,
 *         doctrine?: DoctrineConfig,
 *         dama_doctrine_test?: DamaDoctrineTestConfig,
 *         doctrine_migrations?: DoctrineMigrationsConfig,
 *         twig?: TwigConfig,
 *         twig_extra?: TwigExtraConfig,
 *         security?: SecurityConfig,
 *         nelmio_security?: NelmioSecurityConfig,
 *         knp_menu?: KnpMenuConfig,
 *         web_profiler?: WebProfilerConfig,
 *         monolog?: MonologConfig,
 *         stimulus?: StimulusConfig,
 *         turbo?: TurboConfig,
 *         symfonycasts_sass?: SymfonycastsSassConfig,
 *         scheb_two_factor?: SchebTwoFactorConfig,
 *     },
 *     ...<string, ExtensionType|array{ // extra keys must follow the when@%env% pattern or match an extension alias
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         ...<string, ExtensionType>,
 *     }>
 * }
 */
final class App
{
    /**
     * @param ConfigType $config
     *
     * @psalm-return ConfigType
     */
    public static function config(array $config): array
    {
        /** @var ConfigType $config */
        $config = AppReference::config($config);

        return $config;
    }
}

namespace Symfony\Component\Routing\Loader\Configurator;

/**
 * This class provides array-shapes for configuring the routes of an application.
 *
 * Example:
 *
 *     ```php
 *     // config/routes.php
 *     namespace Symfony\Component\Routing\Loader\Configurator;
 *
 *     return Routes::config([
 *         'controllers' => [
 *             'resource' => 'routing.controllers',
 *         ],
 *     ]);
 *     ```
 *
 * @psalm-type RouteConfig = array{
 *     path: string|array<string,string>,
 *     controller?: string,
 *     template?: string,
 *     redirect_to_route?: string,
 *     redirect_to?: string,
 *     methods?: string|list<string>,
 *     requirements?: array<string,string>,
 *     defaults?: array<string,mixed>,
 *     options?: array<string,mixed>,
 *     host?: string|array<string,string>,
 *     schemes?: string|list<string>,
 *     condition?: string,
 *     add_condition?: string,
 *     locale?: string,
 *     format?: string,
 *     utf8?: bool,
 *     stateless?: bool,
 *     firewall?: string,
 * }
 * @psalm-type ImportConfig = array{
 *     resource: string,
 *     type?: string,
 *     exclude?: string|list<string>,
 *     prefix?: string|array<string,string>,
 *     name_prefix?: string,
 *     trailing_slash_on_root?: bool,
 *     controller?: string,
 *     methods?: string|list<string>,
 *     requirements?: array<string,string>,
 *     defaults?: array<string,mixed>,
 *     options?: array<string,mixed>,
 *     host?: string|array<string,string>,
 *     schemes?: string|list<string>,
 *     condition?: string,
 *     add_condition?: string,
 *     locale?: string,
 *     format?: string,
 *     utf8?: bool,
 *     stateless?: bool,
 *     firewall?: string,
 * }
 * @psalm-type AliasConfig = array{
 *     alias: string,
 *     deprecated?: array{package:string, version:string, message?:string},
 * }
 * @psalm-type RoutesConfig = array{
 *     "when@dev"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     "when@prod"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     "when@test"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     ...<string, RouteConfig|ImportConfig|AliasConfig>
 * }
 */
final class Routes
{
    /**
     * @param RoutesConfig $config
     *
     * @psalm-return RoutesConfig
     */
    public static function config(array $config): array
    {
        return $config;
    }
}
