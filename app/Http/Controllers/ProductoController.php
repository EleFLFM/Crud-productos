<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $productos = Producto::paginate(10);

        return view('productos.index', compact('productos')); //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:1000',
            'precio' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
        ]);
    
        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function vender(Request $request, $id)
{
    $producto = Producto::findOrFail($id);
    $cantidad = $request->input('cantidad');

    // Validar que haya suficiente stock
    if ($cantidad > $producto->cantidad_disponible) {
        return redirect()->back()->with('error', 'No hay suficiente stock disponible.');
    }

    // Actualizar el stock del producto
    $producto->cantidad_disponible -= $cantidad;
    $producto->save();

    // Registrar la venta
    Venta::create([
        'producto_id' => $producto->id,
        'cantidad_vendida' => $cantidad,
        'precio_total' => $producto->precio * $cantidad,
    ]);

    return redirect()->route('productos.index')->with('success', 'Producto vendido correctamente.');
}

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }
    
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|max:1000',
            'precio' => 'required|numeric|min:0',
            'cantidad_disponible' => 'required|integer|min:0',
        ]);
    
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
