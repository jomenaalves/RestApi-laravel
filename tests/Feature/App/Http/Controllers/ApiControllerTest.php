<?php

namespace Tests\Feature;
use Tests\TestCase;

class ApiControllerTest extends TestCase
{
    
    public function testUserMustReceiveErrorWithPassWrongCredentials(){
        $payload = [
            'email' => 'emailerrado@gmail.com',
        ];
        
        $response = $this->post('/api/auth', $payload);

        $response->assertStatus(422);
        $response->assertJson(['error' => 'Wrong credentials']);
    }

    public function testOnlyAdminCanGetToken():void
    {
        $payload = [
            'email' => 'emailerrado@gmail.com',
            'password' => '1234'
        ];

        $response = $this->post('/api/auth', $payload);

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Unauthorized']);
    }
}
