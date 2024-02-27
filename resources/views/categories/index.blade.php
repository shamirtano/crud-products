{{-- Extiendo la vista principal --}}
@extends('layouts.app')

{{-- Agregando un titulo a la vista --}}
@section('title', 'Lista de categorías')

{{-- Agregando el contenido de la vista --}}
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><b><i class="fas fa-list"></i> Lista de Categorías</b></h5>
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
                                <div>
                                    {{-- Modal view category --}}
                                    <a href="#" data-toggle="modal" data-target="#modal-view-category" data-id="{{ $category->id }}" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye fw-sm"></i></a>
                                    <a href="{{ route('categories.edit', $category->id) }}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt fw-sm"></i></a>
                                    <div class="btn-group">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="deleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
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

    @include('categories.partials.view')
@endsection

@section('scripts')
    <script>
        $('.deleteForm').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Estás seguro de eliminar la categoría?, esta operación no se puede revertir',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        title: 'Operación cancelada',
                        text: 'La categoría no ha sido eliminada',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        @if (session('success'))
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        $('#modal-view-category').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);

            $.ajax({
                url: "{{ route('categories.show', ':id') }}".replace(':id', id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    modal.find('.modal-body #name').val(data.name);
                    modal.find('.modal-body #slug').val(data.slug);
                    modal.find('.modal-body #description').val(data.description);
                    //modal.find('.modal-body #image').val(data.image) ? modal.find('.modal-body #image').attr('src', data.image) : '';
                    modal.find('.modal-body #status').val(data.status);
                }
            })
        })
    </script>
@overwrite
