<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Friend;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FriendTest extends TestCase
{
    // use DatabaseMigrations;
    use RefreshDatabase;

    public function test_friend_request(){
        $data = [
            'requestor' => "andy@example.com",
            'to' => "jhon@example.com",
        ];

        $this->post('api/friend', $data)
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }

    public function test_friend_request2(){
        $data = [
            'requestor' => "joe@example.com",
            'to' => "jhon@example.com",
        ];

        $this->post('api/friend', $data)
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }

    public function test_friend_request3()
    {
        $data = [
            'requestor' => "grace@example.com",
            'to' => "jhon@example.com",
        ];

        $this->post('api/friend', $data)
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }

    public function test_friend_accept()
    {
        $data = [
            "requestor" => "andy@example.com",
            "to" => "john@example.com"
        ];

        $this->patch('api/friend/accept', $data)
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }

    public function test_friend_reject()
    {
        $data = [
            "requestor" => "joe@example.com",
            "to" => "john@example.com"
        ];

        $this->patch('api/friend/reject', $data)
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }

    public function test_friend_list_request()
    {
        $this->get('api/friend/request/jhon@example.com')
            ->assertStatus(200);
    }

    public function test_friend_list()
    {

        $this->get('api/friend/list/andy@example.com')
            ->assertStatus(200);
    }

    public function test_friend_list_same()
    {
        $data = [
            "andy@example.com",
            "john@example.com"
        ];

        $this->get('api/friend-same', ["friends" => $data])
            ->assertStatus(200);
    }

    public function test_friend_block()
    {
        $this->patch('api/friend-block', [
            "requestor" => "andy@example.com",
            "block" => "john@example.com"
        ])
            ->assertStatus(200)
            ->assertJson(["success" => true]);
    }

}
