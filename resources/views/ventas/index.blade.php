@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6 fw-bold text-primary">Registro de Ventas</h1>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#filtroModal">
                <i class="fas fa-filter me-2"></i>Filtrar
            </button>
          
        </div>
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
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Total</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>
                                <span class="fw-bold">{{ $venta->producto->nombre }}</span>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $venta->cantidad_vendida }}</span>
                            </td>
                            <td>
                                <span class="text-success fw-bold">${{ number_format($venta->precio_total, 2) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $venta->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Total de ventas: {{ $ventas->total() }}
        </div>
        <div>
            {{ $ventas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Modal de Filtros -->
<div class="modal fade" id="filtroModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filtrar Ventas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Rango de Fechas</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select class="form-select">
                            <option>Todos los productos</option>
                            <!-- Opciones dinámicas -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Aplicar Filtros</button>
            </div>
        </div>
    </div>
</div>
@endsection