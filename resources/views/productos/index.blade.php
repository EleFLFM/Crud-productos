@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6 fw-bold text-primary">Gestión de Productos</h1>
        <a href="{{ route('productos.create') }}" class="btn btn-outline-primary rounded-pill">
            <i class="fas fa-plus-circle me-2"></i>Nuevo Producto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>
                                <span class="badge {{ $producto->cantidad_disponible > 10 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $producto->cantidad_disponible }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Botón Editar -->
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
        
                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
        
                                    <!-- Botón Vender -->
                                    <button class="btn btn-success btn-sm" title="Vender" data-bs-toggle="modal" data-bs-target="#venderModal{{ $producto->id }}">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
        
                                <!-- Modal para Vender -->
                                <div class="modal fade" id="venderModal{{ $producto->id }}" tabindex="-1" aria-labelledby="venderModalLabel{{ $producto->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="venderModalLabel{{ $producto->id }}">Vender Producto: {{ $producto->nombre }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('productos.vender', $producto->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label for="cantidad" class="form-label">Cantidad a vender:</label>
                                                    <input type="number" name="cantidad" class="form-control" min="1" max="{{ $producto->cantidad_disponible }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Vender</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $productos->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection