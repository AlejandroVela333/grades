@extends('layouts.app')

@section('title', 'Agregar materia')

@section('content')
    <div class="card">
        <div class="card-header">Agregar materia</div>
        <div class="card-body">
            <form action="{{ route('subjects.store') }}" method="post">
                @csrf
                @include('subjects._form')
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-secondary" href="{{ route('subjects.index') }}">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
