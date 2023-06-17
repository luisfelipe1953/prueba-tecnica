<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
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

    public function test_index()
    {
        $users = $this->user::factory()->count(10)->create();

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');

        $usersInView = $response->viewData('users');
        $this->assertInstanceOf(LengthAwarePaginator::class, $usersInView);
        $this->assertEquals($users->count(), $usersInView->total());
    }

    public function test_create()
    {
        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    public function test_store()
    {
        $userData = $this->newUser();

        $response = $this->post(route('users.store'), $userData);

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'Agregado Correctamente');
    }

    public function test_edit()
    {   
        $this->withoutExceptionHandling();
        
        $user = $this->user::factory()->create();

        $response = $this->get(route('users.edit', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user', $user);
    }

    public function test_update()
    {
        $user = $this->user::factory()->create();

        $userData = $this->newUser();

        $response = $this->put(route('users.update', $user->id), $userData);

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'Actualizado Correctamente');
    }

    public function test_destroy()
    {
        $this->withoutExceptionHandling();
    
        $user = $this->user::factory()->create();
    
        $response = $this->delete(route('users.destroy', $user->id), ['_token' => csrf_token()]);
    
        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'Eliminado Correctamente');
    }
    
}
