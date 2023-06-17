@if (isset($errors) && $errors->any())
@foreach ($errors->all() as $error)
<p class="alerta-error">{{ $error }}</p>
<br>
@endforeach
@endif
<div class="mb-6">
    <label for="name" class="label">Nombre</label>
    <input type="text" name="name" class="labelInput" placeholder="Nombre" value="{{ old('name', $user->name)}}">
</div>
<div class="mb-6">
    <label for="lastname" class="label">Apellido</label>
    <input type="text" name="lastname" class="labelInput" placeholder="Apellido" value="{{ old('lastname', $user->lastname)}}">
</div>
<div class="mb-6">
    <label for="identification_number" class="label">No.Identificacion</label>
    <input type="text" name="identification_number" class="labelInput" placeholder="No.Identificacion" value="{{ old('identification_number', $user->identification_number) }}">
</div>
<div class="mb-6">
    <label for="cell_phone" class="label">No. Celular</label>
    <input type="text" name="cell_phone" class="labelInput" placeholder="No. Celular" value="{{ old('cell_phone', $user->cell_phone) }}">
</div>
<div class="mb-6">
    <label for="email" class="label">Email</label>
    <input type="text" name="email" class="labelInput" placeholder="Correo" value="{{ old('email', $user->email) }}">
</div>
<div class="mb-6">
    <label for="address" class="label">Direccion</label>
    <input type="text" name="address" class="labelInput" placeholder="Direccion" value="{{ old('address', $user->address) }}">
</div>
<div class="mb-6">
<textarea rows="4" cols="50" name="note" placeholder="Escribe tu Nota aquí..." class="labelInput">{{ old('note', $user->note) }}</textarea>
</div>