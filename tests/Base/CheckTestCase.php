<?php

namespace Billplz\TestCase\Base;

use Laravie\Codex\Response;
use Billplz\TestCase\TestCase;

abstract class CheckTestCase extends TestCase
{
    /** @test */
    public function it_can_called_via_helper()
    {
        $check = $this->makeClient()->check();

        $this->assertInstanceOf('Billplz\Base\Check', $check);
        $this->assertInstanceOf('Billplz\Three\Check', $check);
        $this->assertSame('v3', $check->getVersion());
    }

    /** @test */
    public function it_can_check_account_registration()
    {
        $expected = '{"verified":true}';

        $faker = $this->expectRequest('GET', 'check/bank_account_number/jomlaunch')
                        ->shouldResponseWith(200, $expected);

        $response = $this->makeClient($faker)
                        ->uses('Check')
                        ->bankAccount('jomlaunch');

        $this->assertInstanceOf(Response::class, $response);
    }
}
