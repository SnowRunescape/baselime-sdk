<?php

use PHPUnit\Framework\TestCase;
use Baselime\Baselime;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class BaselimeTest extends TestCase
{
    public function testEvent()
    {
        $mockClient = $this->createMock(Client::class);

        $mockClient->expects($this->once())
            ->method("post")
            ->with(
                $this->equalTo("https://events.baselime.io/v1/logs"),
                $this->callback(function($options) {
                    $this->assertArrayHasKey("headers", $options);
                    $this->assertArrayHasKey("x-api-key", $options["headers"]);
                    $this->assertArrayHasKey("Content-Type", $options["headers"]);
                    $this->assertArrayHasKey("x-service", $options["headers"]);
                    $this->assertEquals("application/json", $options["headers"]["Content-Type"]);

                    $this->assertArrayHasKey("json", $options);
                    $this->assertIsArray($options["json"]);

                    return true;
                })
            )
            ->willReturn(new Response(200, [], null));

        $baselime = new Baselime("test-api-key");

        $reflection = new \ReflectionClass($baselime);
        $property = $reflection->getProperty("client");
        $property->setAccessible(true);
        $property->setValue($baselime, $mockClient);

        $baselime->event("test-service", [
            "key" => "value",
        ]);
    }
}
