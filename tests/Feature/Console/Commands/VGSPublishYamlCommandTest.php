<?php

namespace Luchavez\SimpleVgs\Feature\Console\Commands;

use Tests\TestCase;

/**
 * Class VGSPublishYamlCommandTest
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class VGSPublishYamlCommandTest extends TestCase
{
    /**
     * Example Test
     *
     * @test
     */
    public function example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
