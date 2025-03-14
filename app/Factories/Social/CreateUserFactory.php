<?php

namespace App\Factories\Social;

use App\Actions\Social\CreateXUser;

class CreateUserFactory
{
    /**
     * @throws \Exception
     */
    public function forService(string $service): CreateXUser
    {
        return match ($service) {
            'twitter' => new CreateXUser,
            'github' => new CreateXUser,
            default => throw new \Exception('Unsupported service')
        };
    }
}
