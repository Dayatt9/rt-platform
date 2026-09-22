<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationDisabledTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_is_disabled(): void
    {
        $response = $this->get('/register');

        // Route should not exist (404) or redirect away depending on strict routing.
        // Since it's removed from web.php, it should be a 404 Not Found.
        $response->assertNotFound();
    }
}
