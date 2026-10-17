@extends('layouts.app')

@section('title', 'Editar materia')

@section('content')
    <div class="card">
        <div class="card-header">Editar materia</div>
        <div class="card-body">
            <form action="{{ route('subjects.update', $subject) }}" method="post">
                @csrf
                @method('PUT')
                @include('subjects._form')
                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                <a class="btn btn-secondary" href="{{ route('subjects.index') }}">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
