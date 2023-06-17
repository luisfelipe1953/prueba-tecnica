@extends('layout')

@section('content')
<h1 class="text-center my-20 text-2xl">Editar articulo</h1>

<div class="sm:flex sm:justify-end">
    <a class="ext-center text-white py-[15px] px-[40px] text-sm border-0
    uppercase font-bold  hover:bg-blue-800 mb-6 bg-blue-600 block sm:inline" href="{{route('users.index')}}">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<form action="/users/{{$user->id}}" method="POST" class="container-md mx-auto sm:shadow-form bg-white p-[20px] rounded-xl mt-12" >
    @csrf
    @method('PUT')  
    @include('users.form')

        <button type="submit" class="ext-center text-white py-[15px] px-[40px] text-sm border-0
    uppercase font-bold  hover:bg-blue-800 mb-6 bg-blue-600 block sm:inline">Guardar</button>

</form>


@endsection