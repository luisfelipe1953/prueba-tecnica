@extends('layout')

@section('content')
<h1 class="text-center my-20 text-2xl"> Usuarios </h1>


<div class="sm:flex sm:justify-end">
    <a class="text-center text-white py-[15px] px-[40px] text-sm border-0
    uppercase font-bold  hover:bg-blue-800 mb-6 bg-blue-600 block sm:inline " href="{{route('users.create')}}">
        <i class="fa-solid fa-circle-plus"></i>
        Agregar Usuario
    </a>
</div>

@if (session('success'))
<div class="alerta-exito my-5">
    {{ session('success') }}
</div>
@endif

<div>
    @if(!empty($users))

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre completo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No. Identificicacion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No. Celular
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Direccion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        --
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{$user->name . ", " . $user->lastname}}
                    </td>
                    <td class="px-6 py-4">
                        {{$user->email}}
                    </td>
                    <td class="px-6 py-4">
                        {{$user->identification_number}}
                    </td>
                    <td class="px-6 py-4">
                        {{$user->cell_phone}}
                    </td>
                    <td class="px-6 py-4">
                        {{$user->address}}
                    </td>

                    <td class="py-4 flex text-base">
                        <a href="{{route('users.edit', $user)}}" class="hover:text-blue-800 font-bold mr-2 text-blue-600">
                            <i class="fa-solid fa-user-pen text-primario"></i>
                            Editar</a>
                        <form action="{{route('users.destroy', $user->id)}}" method="POST" class="text-red-500 font-bold ">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-800">
                                <i class="fa-solid fa-circle-xmark text-red"></i>
                                Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="paginacion">
        <span>Página {{ $users->currentPage() }} de {{ $users->lastPage() }}:</span>
        <ul class="pagina-numeros">
            @if ($users->currentPage() > 1)
            <li><a href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="{{ ($users->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $users->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                @if ($users->hasMorePages())
                <li><a href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @endif
        </ul>
    </div>
    @else
    <p class="text-center">No hay Usuarios aun</p>
    @endif
</div>


@endsection