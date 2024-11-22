<?php

namespace App\Http\Controllers;

use App\Models\Venta;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')->paginate(10); // Paginación
        return view('ventas.index', compact('ventas'));
    }
}
