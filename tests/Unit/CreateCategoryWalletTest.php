<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCategoryWalletTest extends TestCase {
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_create_category_wallet() {
        $attribute = [
            'name' => $this->faker->name
        ];

        $resp = $this->post('/api/category-wallet', $attribute);
        $resp->assertJsonValidationErrors($attribute)->assertStatus(201);
    }
}
