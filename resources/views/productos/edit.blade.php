@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">
                        <i class="fas {{ isset($producto) ? 'fa-edit' : 'fa-plus-circle' }} me-2"></i>
                        {{ isset($producto) ? __('Editar Producto') : __('Crear Nuevo Producto') }}
                    </h2>
                </div>

                <div class="card-body">
                    <form 
                        action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}" 
                        method="POST"
                        novalidate
                    >
                        @csrf
                        @if(isset($producto))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">{{ __('Nombre del Producto') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input 
                                        type="text" 
                                        name="nombre" 
                                        id="nombre" 
                                        class="form-control @error('nombre') is-invalid @enderror" 
                                        value="{{ old('nombre', $producto->nombre ?? '') }}" 
                                        placeholder="{{ __('Ingrese nombre del producto') }}"
                                        required
                                    >
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label">{{ __('Precio') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        name="precio" 
                                        id="precio" 
                                        class="form-control @error('precio') is-invalid @enderror" 
                                        value="{{ old('precio', $producto->precio ?? '') }}" 
                                        placeholder="{{ __('Precio del producto') }}"
                                        min="0"
                                        required
                                    >
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
                            <textarea 
                                name="descripcion" 
                                id="descripcion" 
                                class="form-control @error('descripcion') is-invalid @enderror" 
                                rows="4" 
                                placeholder="{{ __('Descripción detallada del producto') }}"
                            >{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cantidad_disponible" class="form-label">{{ __('Stock Disponible') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                    <input 
                                        type="number" 
                                        name="cantidad_disponible" 
                                        id="cantidad_disponible" 
                                        class="form-control @error('cantidad_disponible') is-invalid @enderror" 
                                        value="{{ old('cantidad_disponible', $producto->cantidad_disponible ?? '') }}" 
                                        min="0"
                                        placeholder="{{ __('Cantidad de productos en inventario') }}"
                                        required
                                    >
                                    @error('cantidad_disponible')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                {{ isset($producto) ? __('Actualizar') : __('Guardar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection