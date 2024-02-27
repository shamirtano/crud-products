{{-- Extiendo la vista principal --}}
@extends('layouts.app')

{{-- Agregando un titulo a la vista --}}
@section('title', 'Lista de productos')

{{-- Agregando el contenido de la vista --}}
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><b><i class="fas fa-list"></i> Lista de Productos</b></h5>
                <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus fw-sm"></i> Crear producto</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Imagen</th>
                            <th>Cantidad</th>
                            <th>$ Costo</th>
                            <th>$ Venta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->image }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td class="text-right">{{ number_format($product->cost, 2, ",", ".") }}</td>
                            <td class="text-right">{{ number_format($product->price, 2, ",", ".") }}</td>
                            <td>
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#modal-view-product" data-id="{{ $product->id }}" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye fw-sm"></i></a>
                                    <a href="{{ route('products.edit', $product->id) }}" type="button" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt fw-sm"></i></a>
                                    <div class="btn-group">
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="deleteForm">
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
                {{ $products->links() }}
            </div>
        </div>
    </div>

    @include('products.partials.view')
@endsection

@section('scripts')
    <script>
        // confirmar eliminar
        $('.deleteForm').on('submit', function(e) {
            e.preventDefault(); // evitar el recargue de la pagina
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Estás seguro de eliminar el producto?, esta operación no se puede revertir',
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
                        text: 'El producto no ha sido eliminado',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        // mensajes
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

        // modal ver
        $('#modal-view-product').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);

            $.ajax({
                url: "{{ route('products.show', ':id') }}".replace(':id', id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    modal.find('.modal-body #sku').val(data.sku);
                    modal.find('.modal-body #name').val(data.name);
                    modal.find('.modal-body #slug').val(data.slug);
                    modal.find('.modal-body #category_id').val(data.category.name);
                    modal.find('.modal-body #quantity').val(data.quantity);
                    modal.find('.modal-body #cost').val(data.cost);
                    modal.find('.modal-body #price').val(data.price);
                    modal.find('.modal-body #description').val(data.description);
                    //modal.find('.modal-body #image').val(data.image) ? modal.find('.modal-body #image').attr('src', data.image) : '';
                    modal.find('.modal-body #status').val(data.status);
                }
            })
        })
    </script>
@overwrite
