<?php

namespace Luchavez\SimpleVgs\Services;

use Illuminate\Support\Facades\App;

/**
 * Class SimpleVgs
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class SimpleVgs
{
    /**
     * @return bool
     */
    public function isTestApiEnabled(): bool
    {
        return ! App::isProduction() && config('simple-vgs.vgs_test_api_enabled');
    }

    /**
     * @return string|null
     */
    public function getVaultId(): ?string
    {
        return config('simple-vgs.vgs_vault_id');
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return strtolower(config('simple-vgs.vgs_vault_environment'));
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return config('simple-vgs.vgs_vault_username');
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return config('simple-vgs.vgs_vault_password');
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return config('simple-vgs.vgs_vault_port');
    }

    /**
     * @return string
     */
    protected function getVaultUrl(): string
    {
        return implode('.', [$this->getVaultId(), $this->getEnvironment(), 'verygoodproxy.com']);
    }

    /**
     * @return string
     */
    public function getInboundRouteURL(): string
    {
        return 'https://'.$this->getVaultUrl();
    }

    /**
     * @return string
     */
    public function getOutboundRouteURL(): string
    {
        return 'https://'.implode(':', [$this->getUsername(), $this->getPassword()]).'@'.$this->getVaultUrl().':'.$this->getPort();
    }
}
