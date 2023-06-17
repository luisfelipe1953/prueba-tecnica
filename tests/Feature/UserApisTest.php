<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApisTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $user;
    private $route_uri;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
        $this->route_uri = '/api/api-users/';
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


    public function test_index_success()
    {   
        $this->withoutExceptionHandling();

        $this->user::factory(10)->create();
        $response = $this->get($this->route_uri);

        $response->assertStatus(Response::HTTP_OK);

        $usersInView = $response->json('data');

        // Verificar la estructura esperada
        $this->assertArrayHasKey('data', $usersInView);
        $this->assertArrayHasKey('total', $usersInView);

        // Verificar el número total de elementos
        $this->assertCount(8, $usersInView['data']);
    }

    public function test_index_sin_datos()
    {
        $response = $this->get($this->route_uri);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(13, 'data'); // +13 que serian los objetos de la paginacion
    }

    public function test_store_success()
    {
        $data = $this->newUser();
        $response = $this->post($this->route_uri, $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'msg' => 'Se ha Creado satisfactoriamente.'
        ]);
    }

    public function test_show_success()
    {
        $user = $this->user::factory()->create();

        $response = $this->get($this->route_uri . $user->id);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'id' => $user->id,
        ]);
    }

    public function test_show_model_not_found()
    {
        $userId = 999; // ID que no existe

        $response = $this->get($this->route_uri . $userId);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson([
            'error' => 'El usuario no existe, vuelve a intentarlo'
        ]);
    }

    public function test_update_success()
    {
        $user = User::factory()->create();
        $data = $this->newUser([
            'name' => 'Nuevo nombre',
        ]);

        $response = $this->put($this->route_uri . $user->id, $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'msg' => 'Se ha Actualizado satisfactoriamente.'
        ]);

        $this->assertDatabaseHas(
            'users',
            [
                'id' => $user->id,
                'name' => 'Nuevo nombre'
            ]
        );
    }

    public function test_update_model_not_found()
    {
        $userId = 999; // ID que no existe
        $data = $this->newUser([
            'name' => 'Nuevo nombre',
        ]);

        $response = $this->put($this->route_uri . $userId, $data);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson([
            'error' => 'El usuario no existe, vuelve a intentarlo'
        ]);
    }

    public function test_destroy_api_success()
    {
        $user = User::factory()->create();

        $response = $this->delete($this->route_uri . $user->id);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'msg' => 'Se ha Eliminado satisfactoriamente.'
        ]);
    }

    public function test_destroy_api_model_not_found()
    {
        $userId = 999; // ID que no existe

        $response = $this->delete($this->route_uri . $userId);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson([
            'error' => 'El usuario no existe, vuelve a intentarlo'
        ]);
    }
}
