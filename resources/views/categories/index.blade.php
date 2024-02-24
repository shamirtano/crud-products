{{-- Extiendo la vista principal --}}
@extends('layouts.app')

{{-- Agregando un titulo a la vista --}}
@section('title', 'Lista de categorías')

{{-- Agregando el contenido de la vista --}}
@section('content')
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Categorías</h5>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus fw-sm"></i> Crear categoría</a>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-vcenter card-table" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->image }}</td>
                                {{-- Badge --}}
                                <td>
                                    @if ($category->status == 1)
                                        <span class="badge bg-success p-2">Activo</span>
                                    @else
                                        <span class="badge bg-danger p-2">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.edit', $category->id) }}" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt fw-sm"></i></a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
