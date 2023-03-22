<?php

namespace Luchavez\SimpleVgs\Providers;

use Luchavez\SimpleVgs\Console\Commands\VGSInboundOutboundCommand;
use Luchavez\SimpleVgs\Console\Commands\VGSPublishYamlCommand;
use Luchavez\SimpleVgs\Services\SimpleVgs;
use Luchavez\StarterKit\Abstracts\BaseStarterKitServiceProvider;
use Illuminate\Support\Facades\App;

/**
 * Class SimpleVgsServiceProvider
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class SimpleVgsServiceProvider extends BaseStarterKitServiceProvider
{
    protected array $commands = [
        VGSPublishYamlCommand::class,
    ];

    /**
     * Publishable Environment Variables
     *
     * @link    https://laravel.com/docs/8.x/eloquent#observers
     *
     * @example [ 'HELLO_WORLD' => true ]
     *
     * @var array
     */
    protected array $env_vars = [
        'VGS_TEST_API_ENABLED' => true,
        'VGS_VAULT_ID' => null,
        'VGS_VAULT_ENVIRONMENT' => 'sandbox',
        'VGS_VAULT_USERNAME' => null,
        'VGS_VAULT_PASSWORD' => null,
        'VGS_VAULT_PORT' => 8443,
    ];

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/simple-vgs.php', 'simple-vgs');

        // Register the service the package provides.
        $this->app->singleton('simple-vgs', function ($app) {
            return new SimpleVgs();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['simple-vgs'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../../config/simple-vgs.php' => config_path('simple-vgs.php'),
        ], 'simple-vgs.config');

        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../../simple-vgs.yaml' => base_path('simple-vgs.yaml'),
        ], 'simple-vgs.yaml');

        if (simpleVgs()->isTestApiEnabled()) {
            $this->commands[] = VGSInboundOutboundCommand::class;
        }

        $this->commands($this->commands);
    }

    public function areConfigsEnabled(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function areRoutesEnabled(): bool
    {
        return ! App::isProduction() && config('simple-vgs.vgs_test_api_enabled');
    }

    /**
     * Remove default route middlewares from `luchavez/starter-kit`
     *
     * @param  bool  $is_api
     * @return array
     */
    public function getDefaultRouteMiddleware(bool $is_api): array
    {
        return [];
    }

    /**
     * @return string|null
     */
    public function getRoutePrefix(): ?string
    {
        return 'simple-vgs';
    }
}
