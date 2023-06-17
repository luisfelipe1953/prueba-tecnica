<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{   
    public function __construct(protected readonly UserRepository $users){}
    
     /**
      * Muestra una lista de los recursos.
      *
      * @return void
      */
    public function index()
    {
        $users = $this->users->paginate(8);

        return view('users.index')->with(compact('users'));
    }

     /**
      * Muestra el formulario para crear un nuevo recurso.
      *
      * @return void
      */
    public function create()
    {   
        return view('users.create')->with(['user' => new User]);
    }


     /**
      * Almacena un nuevo recurso en el almacenamiento.
      *
      * @param UserStoreRequest $request
      * @return void
      */
    public function store(UserStoreRequest $request)
    {   
        $userModel = new User($request->validated());
        
        $this->users->save($userModel);

        return redirect()->route('users.index')->with('success', 'Agregado Correctamente');
    }

    /**
     * Muestra el recurso especificado.
     */
    // public function show(int $id)
    // {
    //     $user = $this->users->get($id);

    //     return view('users.show', compact('user'));
    // }


     /**
      * Muestra el formulario para editar el recurso especificado.
      *
      * @param string $id
      * @return void
      */
    public function edit(string $id)
    {
        $user = $this->users->get($id);

        return view('users.edit', compact('user'));
    }

     /**
      * Actualiza el recurso especificado en el almacenamiento.
      *
      * @param UserUpdateRequest $request
      * @param integer $id
      * @return void
      */
    public function update(UserUpdateRequest $request, int $id)
    {
        $user = $this->users->get($id);

        $user->fill($request->validated());

        $this->users->save($user);

        return redirect()->route('users.index')->with('success', 'Actualizado Correctamente');
    }

     /**
      * Elimina el recurso especificado del almacenamiento.
      *
      * @param integer $id
      * @return void
      */
    public function destroy(int $id)
    {
        $user = $this->users->get($id);
        
        $this->users->destroy($user);

        return redirect()->route('users.index')->with('success', 'Eliminado Correctamente');
    }
}
