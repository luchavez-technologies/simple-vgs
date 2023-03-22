<?php

namespace Luchavez\SimpleVgs\Console\Commands;

use Luchavez\ApiSdkKit\Services\MakeRequest;
use Luchavez\StarterKit\Traits\UsesCommandCustomMessagesTrait;
use Illuminate\Console\Command;

/**
 * Class VGSInboundOutboundCommand
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class VGSInboundOutboundCommand extends Command
{
    use UsesCommandCustomMessagesTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'vgs:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test VGS inbound and outbound routes.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $data = [
            'card_number' => '123456789',
            'cvv' => 123,
        ];

        $this->ongoing('Redacting data: '.json_encode($data));

        $inbound_log = tap(makeRequest(simpleVgs()->getInboundRouteURL())->returnAsResponse()->data($data))->post('api/simple-vgs/inbound');

        if ($inbound_log instanceof MakeRequest && $inbound_log->getStatusFromResponse() == 200) {
            $redacted = $inbound_log->getDataFromResponse()->get('data');

            $this->ongoing('Revealing redacted data: '.json_encode($redacted));

            $outbound_log = tap(makeRequest(config('app.url'))->returnAsResponse()->data($redacted)->proxy(simpleVgs()->getOutboundRouteURL()))
                ->post('api/simple-vgs/outbound');

            if ($outbound_log instanceof MakeRequest &&
                ($revealed = $outbound_log->getDataFromResponse()->get('data')) &&
                $revealed == $data
            ) {
                $this->done('Data has been redacted then revealed successfully: '.json_encode($revealed));
            } else {
                $this->failed('Failed to reveal redacted data.');
            }
        } else {
            $this->failed('Failed to redact data. Please check your VGS Vault configuration.');
        }

        return self::SUCCESS;
    }
}
