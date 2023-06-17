<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserApiController extends Controller
{

    public function __construct(protected readonly UserRepository $users)
    {
    }


    /**
     * Muestra una lista de los recursos.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(UserCollection::make($this->users->paginate(8)));
        } catch (ModelNotFoundException $e) {
            return $this->ModelErrorResponse($e->getMessage(), 'usuario');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    /**
     * Almacena un nuevo recurso
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        try {
            $userModel = new User($request->validated());
            $this->users->save($userModel);
            return $this->successReponse('Creado');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

     /**
      * Muestra el recurso especificado.
      *
      * @param integer $id
      * @return JsonResponse
      */
    public function show(int $id): JsonResponse
    {
        try {
            return response()->json(new UserResource($this->users->get($id)));
        } catch (ModelNotFoundException $e) {
            return $this->ModelErrorResponse($e->getMessage(), 'usuario');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
      * Actualiza el recurso especificado en el almacenamiento.
      *
      * @param UserUpdateRequest $request
      * @param integer $id
      * @return JsonResponse
      */
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $user = $this->users->get($id);
            $user->fill($request->validated());
            $this->users->save($user);
            return $this->successReponse('Actualizado');
        } catch (ModelNotFoundException $e) {
            return $this->ModelErrorResponse($e->getMessage(), 'usuario');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

     /**
      * Elimina el recurso especificado del almacenamiento.
      *
      * @param integer $id
      * @return JsonResponse
      */
    public function destroy(int $id): JsonResponse
    {
        try {
            $user = $this->users->get($id);
            $this->users->destroy($user);
            return $this->successReponse('Eliminado');
        } catch (ModelNotFoundException $e) {
            return $this->ModelErrorResponse($e->getMessage(), 'usuario');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
