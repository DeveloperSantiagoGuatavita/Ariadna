<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //trae todos los registros
        $categorias = Categoria::all();
        return response()->json($categorias);
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
            $newCategoria = new Categoria();
            $newCategoria->nombre = $request->nombre;
            $newCategoria->descripcion = $request->descripcion;
            if (!$newCategoria->save()) {
                throw new Exception("Error al Crear Categoria ", 101);
            }
            DB::commit();
            $response['type'] = 'success';
            $response['title'] = 'Creacion de Categoria';
            $response['msg'] = 'Se creo la categoria correctamente';
        } catch (Exception $e) {
            DB::rollback();
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al Crear Categoria';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        }
        return response()->json(['categoria'=>$newCategoria, $response]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
        return response()->json($categoria);
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
    public function update(Request $request, Categoria $categoria)
    {
        //
        $categoria->fill($request->post())->save();
        return response()->json(['categoria'=>$categoria]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
        $categoria->delete();
        return response()->json(['mensaje' => 'Categoria eliminada']);
    }
}
