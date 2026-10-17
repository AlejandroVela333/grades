@extends('layouts.app')

@section('title', 'Materias')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Materias</h1>
        <a class="btn btn-primary" href="{{ route('subjects.create') }}">Agregar materia</a>
    </div>

    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th colspan="3">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('subjects.show', $subject) }}">Ver</a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('subjects.edit', $subject) }}">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('subjects.destroy', $subject) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('¿Deseas eliminar esta materia y sus actividades?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay materias registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
