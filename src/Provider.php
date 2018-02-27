<?php

declare(strict_types=1);

namespace Wtf\Rest;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuupola\Middleware\JwtAuthentication;

class Provider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container['jwt_middleware'] = function ($container) {
            $config = $container['config']('jwt', []);
            if (!($config['before'] ?? null)) {
                $config['before'] = function (ServerRequestInterface $request, array $args) use ($container) {
                    $token = $request->getAttribute($config['attribute'] ?? 'token');
                    $container['user'] = (is_object($token) && property_exists($token, 'data') ? $token->data : $token);

                    return $request;
                };
            }

            return new JwtAuthentication($config);
        };
    }
}
