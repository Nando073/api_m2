<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'API Soporte TI',
            ],

            'routes' => [
                /*
                 * Ruta para acceder a la interfaz de documentación (Swagger UI)
                 */
                'api' => 'api-docs',

                /*
                 * Ruta para acceder al archivo JSON de documentación
                 */
                'docs' => 'api-docs.json',
            ],

            'paths' => [
                /*
                 * Usar ruta absoluta para los assets (CSS, JS)
                 */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                /*
                 * Nombre del archivo JSON generado
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * Nombre del archivo YAML generado (opcional)
                 */
                'docs_yaml' => 'api-docs.yaml',

                /*
                 * Formato a usar para la documentación: json o yaml
                 */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                /*
                 * Directorios donde se almacenan las anotaciones de Swagger
                 */
                'annotations' => [
                    base_path('app/Swagger'),
                    base_path('app/Http/Controllers'),
                ],
            ],
        ],
    ],

    'defaults' => [
        'routes' => [
            /*
             * Ruta para acceder al JSON de documentación (por defecto)
             */
            'docs' => 'api-docs',

            /*
             * Ruta para callback de OAuth2 (si usas autenticación)
             */
            'oauth2_callback' => 'api/oauth2-callback',

            /*
             * Middleware para proteger el acceso a la documentación
             */
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],

            /*
             * Opciones de grupo de rutas
             */
            'group_options' => [],
        ],

        'paths' => [
            /*
             * Ruta absoluta donde se almacenará el archivo JSON generado
             */
            'docs' => storage_path('api-docs'),

            /*
             * Ruta absoluta donde se exportarán las vistas de Swagger UI
             */
            'views' => base_path('resources/views/vendor/l5-swagger'),

            /*
             * Ruta base de la API (por defecto null)
             */
            'base' => env('L5_SWAGGER_BASE_PATH', null),

            /*
             * Ruta donde se almacenan los assets de Swagger UI
             */
            'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

            /*
             * Directorios excluidos del escaneo (deprecado)
             */
            'excludes' => [],
        ],

        'scanOptions' => [
            /**
             * Analizador (por defecto \OpenApi\StaticAnalyser)
             */
            'analyser' => null,

            /**
             * Análisis (por defecto \OpenApi\Analysis)
             */
            'analysis' => null,

            /**
             * Procesadores personalizados
             */
            'processors' => [
                // new \App\SwaggerProcessors\SchemaQueryParameter(),
            ],

            /**
             * Patrón de archivos a escanear (por defecto *.php)
             */
            'pattern' => null,

            /**
             * Directorios excluidos del escaneo
             */
            'exclude' => [],

            /**
             * Versión de OpenAPI a generar (3.0.0 o 3.1.0)
             */
            'open_api_spec_version' => env('L5_SWAGGER_OPEN_API_SPEC_VERSION', '3.0.0'),
        ],

        /*
         * Definiciones de seguridad (opcional)
         */
        'securityDefinitions' => [
            'securitySchemes' => [
                /*
                 * Ejemplo de seguridad con API Key
                 */
                // 'api_key' => [
                //     'type' => 'apiKey',
                //     'description' => 'API Key para autenticación',
                //     'name' => 'Authorization',
                //     'in' => 'header',
                // ],
            ],
            'security' => [
                // [
                //     'api_key' => [],
                // ],
            ],
        ],

        /*
         * Generar documentación en cada petición (solo en desarrollo)
         */
        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', true),

        /*
         * Generar copia en YAML (opcional)
         */
        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),

        /*
         * Configuración de proxy (para AWS Load Balancer)
         */
        'proxy' => false,

        /*
         * URL de configuración adicional (plugin de Swagger UI)
         */
        'additional_config_url' => null,

        /*
         * Orden de las operaciones (alpha, method o null)
         */
        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),

        /*
         * URL del validador (null para desactivar)
         */
        'validator_url' => null,

        /*
         * Configuración de la interfaz Swagger UI
         */
        'ui' => [
            'display' => [
                /*
                 * Expansión por defecto: 'list', 'full', 'none'
                 */
                'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),

                /*
                 * Filtro de tags (true para activar)
                 */
                'filter' => env('L5_SWAGGER_UI_FILTERS', true),
            ],

            'authorization' => [
                /*
                 * Persistir datos de autorización
                 */
                'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),

                'oauth2' => [
                    /*
                     * Usar PKCE en flujo AuthorizationCodeGrant
                     */
                    'use_pkce_with_authorization_code_grant' => false,
                ],
            ],
        ],

        /*
         * Constantes que pueden ser usadas en anotaciones
         */
        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('APP_URL', 'http://localhost') . '/api',
        ],
    ],
];