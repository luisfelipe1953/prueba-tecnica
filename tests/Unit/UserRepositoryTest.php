<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{   
    use RefreshDatabase, WithFaker;

    private UserRepository $userRepository;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
        $this->userRepository = new UserRepository($this->user);
    }

    private function newUser($parameters = [])
    {
        return array_merge([
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastname,
            'identification_number' => $this->faker->randomNumber(9),
            'cell_phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'note' => $this->faker->text,
        ], $parameters);
    }

    public function test_repository_paginate()
    {
        $this->user::factory(10)->create();

        $paginateNum = 5;
        $result = $this->userRepository->paginate($paginateNum);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertCount($paginateNum, $result->items());
    }

    public function test_repository_get()
    {
        $user = $this->user::factory()->create();

        $result = $this->userRepository->get($user->id);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($user->id, $result->id);
    }

    public function test_repository_save()
    {
        $userData = $this->newUser([
            'name' => 'John',
            'lastname' => 'Doe',
            'identification_number' => '123456789',
        ]);
        $userModel = new User($userData);

        $result = $this->userRepository->save($userModel);

        $this->assertInstanceOf(User::class, $result);
        $this->assertDatabaseHas('users', $userData);
    }

    public function test__repository_destroy()
    {
        $user = $this->user::factory()->create();

        $result = $this->userRepository->destroy($user);

        $this->assertInstanceOf($this->user::class, $result);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
