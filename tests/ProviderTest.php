<?php

declare(strict_types=1);

namespace Wtf\Rest\Tests;

use PHPUnit\Framework\TestCase;
use Wtf\Rest\Provider;

class ProviderTest extends TestCase
{
    protected $container;

    protected function setUp(): void
    {
        $dir = __DIR__.'/config/';
        $app = new \Wtf\App(['config_dir' => $dir]);
        $this->container = $app->getContainer();
        $this->container->register(new Provider());
    }

    public function testJwtAuthentication(): void
    {
        $this->assertInstanceOf('\Tuupola\Middleware\JwtAuthentication', $this->container->jwt_middleware);
        $request = $this->container->request->withHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWV9.TJVA95OrM7E2cBab30RMHrHDcEfxjoYZgeFONFh7HgQ');
        $response = $this->container->response;
        $callable = function ($request, $response) { return $response; };
        $result = $this->container->jwt_middleware->__invoke($request, $response, $callable);
        $this->assertArrayHasKey('name', (array) $this->container->user);
    }
}
