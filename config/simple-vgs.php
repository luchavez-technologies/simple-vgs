<?php

return [
    'vgs_test_api_enabled' => env('VGS_TEST_API_ENABLED', true),
    'vgs_vault_id' => env('VGS_VAULT_ID'),
    'vgs_vault_environment' => env('VGS_VAULT_ENVIRONMENT', 'sandbox'),
    'vgs_vault_username' => env('VGS_VAULT_USERNAME'),
    'vgs_vault_password' => env('VGS_VAULT_PASSWORD'),
    'vgs_vault_port' => env('VGS_VAULT_PORT', 8443),
];
