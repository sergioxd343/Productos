<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    //
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|in:Electrónica,Hogar,Oficina',
            'precio_unitario' => 'required|numeric|min:0',
            'stock' => 'integer|min:0',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'categoria.required' => 'La categoría del producto es obligatoria.',
            'categoria.in' => 'La categoría debe ser una de las siguientes: Electrónica,Hogar,Oficina.',
            'precio_unitario.required' => 'El precio unitario es obligatorio.',
            'precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
        ]);

        $producto = Producto::create($validatedData);
        // Devolver todo el producto creado, no solo el id
        $allProducto = Producto::find($producto->id);
        return response()->json($allProducto, 201);
    }

    public function show($id)
    {
        // Si no existe el producto devolver error 404 no se encuentra

        $producto = Producto::find($id);

        if (empty($producto)) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }

        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|in:Electrónica,Hogar,Oficina',
            'precio_unitario' => 'required|numeric|min:0',
            'stock' => 'integer|min:0',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'categoria.required' => 'La categoría del producto es obligatoria.',
            'categoria.in' => 'La categoría debe ser una de las siguientes:Electrónica, Hogar, Oficina.',
            'precio_unitario.required' => 'El precio unitario es obligatorio.',
            'precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
        ]);

        $producto = Producto::find($id);
        if (empty($producto)) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }
        $producto->update($validatedData);
        return response()->json($producto);
    }

    public function destroy($id)
    {
        // Si ya esta inactivo devolver error (activo = false)

        $producto = Producto::find($id);

        if (empty($producto)) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }

        if (!$producto->activo) {
            return response()->json(['error' => 'El producto ya está inactivo.'], 400);
        }

        $producto->update(['activo' => false]);
        return response()->json(null, 204);
    }

    // Filtado por categoria
    public function filtrarPorCategoria($categoria)
    {
        $productos = Producto::where('categoria', $categoria)->get();
        return response()->json($productos);
    }

    public function filtrarPorPaginacion($pagina, $size)
    {
        $productos = Producto::paginate($size, ['*'], 'page', $pagina);
        return response()->json($productos);
    }
}
