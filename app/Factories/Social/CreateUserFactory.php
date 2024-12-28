<?php

namespace App\Factories\Social;

use App\Actions\Social\CreateXUser;
use League\OAuth1\Client\Server\Twitter;

class CreateUserFactory
{
    /**
     * @param string $service
     * @return CreateXUser
     * @throws \Exception
     */
    public function forService(string $service): CreateXUser
    {
        return match ($service) {
            'twitter' => new CreateXUser(),
            'github' => new CreateXUser(),
            default => throw new \Exception('Unsupported service')
        };
    }
}
