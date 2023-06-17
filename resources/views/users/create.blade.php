@extends('layout')

@section('content')
<h1 class="text-center my-10 text-2xl font-bold">Registrar Usuario</h1>

<div class="sm:flex sm:justify-end">
    <a class="text-center text-white py-[15px] px-[40px] text-sm border-0
    uppercase font-bold  hover:bg-blue-800 mb-6 bg-blue-600 block sm:inline" href="{{route('users.index')}}">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="container-md mx-auto sm:shadow-form bg-white p-[20px] rounded-xl">
    <form action="{{route('users.store')}}" method="POST">
        <p class="mb-2 font-bold">Informacion Personal</p>
        @csrf
        @include('users.form')

        <button href="{{route('users.index')}}" type="submit" class="text-center text-white py-[15px] px-[40px] text-sm border-0
    uppercase font-bold  hover:bg-blue-800 mb-6 bg-blue-600 block sm:inline">Registrar Usuario</button>
    </form>
</div>

@endsection