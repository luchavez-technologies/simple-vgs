<?php

namespace Luchavez\SimpleVgs\Feature\Console\Commands;

use Tests\TestCase;

/**
 * Class VGSInboundOutboundCommandTest
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class VGSInboundOutboundCommandTest extends TestCase
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
