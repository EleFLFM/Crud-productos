@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">
                        <i class="fas fa-{{ isset($producto) ? 'edit' : 'plus-circle' }} me-2"></i>
                        {{ isset($producto) ? 'Editar Producto' : 'Nuevo Producto' }}
                    </h2>
                </div>

                <div class="card-body">
                    <form action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}" method="POST">
                        @csrf
                        @if (isset($producto))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre del Producto</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input type="text" name="nombre" id="nombre" 
                                           class="form-control @error('nombre') is-invalid @enderror" 
                                           value="{{ old('nombre', $producto->nombre ?? '') }}" 
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="precio" id="precio" 
                                           class="form-control @error('precio') is-invalid @enderror" 
                                           value="{{ old('precio', $producto->precio ?? '') }}" 
                                           required>
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" 
                                      class="form-control @error('descripcion') is-invalid @enderror" 
                                      rows="3">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cantidad_disponible" class="form-label">Stock Disponible</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                    <input type="number" name="cantidad_disponible" id="cantidad_disponible" 
                                           class="form-control @error('cantidad_disponible') is-invalid @enderror" 
                                           value="{{ old('cantidad_disponible', $producto->cantidad_disponible ?? '') }}" 
                                           required>
                                    @error('cantidad_disponible')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                {{ isset($producto) ? 'Actualizar' : 'Guardar' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection