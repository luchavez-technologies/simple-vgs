<?php

namespace Luchavez\SimpleVgs\Console\Commands;

use Illuminate\Console\Command;
use Luchavez\StarterKit\Traits\UsesCommandCustomMessagesTrait;

/**
 * Class VGSPublishYamlCommand
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class VGSPublishYamlCommand extends Command
{
    use UsesCommandCustomMessagesTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'vgs:yaml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish VGS configuration.yaml file.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->ongoing('Publishing simple-vgs.yaml file...');

        $this->call('vendor:publish', ['--tag' => 'simple-vgs.yaml']);

        $this->done('Published simple-vgs.yaml file: '.base_path('simple-vgs.yaml'));

        return self::SUCCESS;
    }
}
