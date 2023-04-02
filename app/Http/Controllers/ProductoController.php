<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //trae todos los registros
        $productos = Producto::all();
        return response()->json($productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
        $response = [];
        try {
            if (strlen($request->nombre) > 40) {
                throw new Exception("Ha superado la longitud de caracteres maxima permitida");
                
            }
            $newProducto = new Producto();
            $newProducto->nombre = $request->nombre;
            $newProducto->categoria = $request->categoria;
            $newProducto->precio = $request->precio;
            $newProducto->valor = $request->valor;
            $newProducto->stock = $request->stock;
            $newProducto->descripcion = $request->descripcion;
            if (!$newProducto->save()) {
                throw new Exception("Error al Crear Producto ", 101);
            }
            DB::commit();
            $response['type'] = 'success';
            $response['title'] = 'Creacion de Producto';
            $response['msg'] = 'Se creo la Producto correctamente';
        } catch (Exception $e) {
            DB::rollback();
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al Crear Producto';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        }
        return response()->json(['Producto'=>$newProducto, $response]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
        $producto->fill($request->post())->save();
        return response()->json(['producto'=>$producto]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
        $producto->delete();
        return response()->json(['mensaje' => 'Producto eliminado']);
    }
}
