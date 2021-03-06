<?php

namespace App\Http\Controllers;

use App\producto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /* public function listar()
    {
        $producto = DB::table('producto as p','categoria as c', 'marca as m')
            ->select('p.Nombre', 'p.Codigo', 'c.CodigoCategoria', 'm.CodigoMarca', 'm.Vigencia')
            ->get();
        return response()->json($producto, 200);
    } */

    public function leer($id)
    {
        return Producto::find($id);
    }

    //REGISTRAR PRODUCTO
    public function registrar(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'CodigoCategoria' => 'required',
            'CodigoMarca' => 'required',
            'Tipo' => 'required|max:50',
            'Nombre' => 'required|max:100',
            'TipoControl' => 'required|max:50',
        ], [
            'unique' => ':attribute ya se encuentra registrado',
            'required' => ':attribute es obligatorio',
            'max' => ':attribute llego al limite de letras'
        ]);
        if ($validacion->fails()) {
            return response()->json($validacion->errors()->first(), 400);
        }
        $producto = new producto();

        $producto->CodigoCategoria = $request->get('CodigoCategoria');
        $producto->CodigoMarca = $request->get('CodigoMarca');
        $producto->Tipo = $request->get('Tipo');
        $producto->Nombre = $request->get('Nombre');
        $producto->TipoControl = $request->get('TipoControl');
        $producto->save();

        return response()->json($producto, 201);
    }

    //ACTUALIZAR
    public function actualizar(Request $request, $id)
    {
        $validacion = Validator::make($request->all(), [
            'CodigoCategoria' => 'required',
            'CodigoMarca' => 'required|max:6',
            'Tipo' => 'max:1',
            'Nombre' => 'max:100',
            'TipoControl' => 'max:50',
            'Negociable' => 'max:1',
        ]);
        if ($validacion->fails()) {
            return response()->json($validacion, 400);
        }
        $producto = producto::findOrFail($id);
        $producto->CodigoCategoria = $request->get('CodigoCategoria');
        $producto->CodigoMarca = $request->get('CodigoMarca');
        $producto->Tipo = $request->get('Tipo');
        $producto->Nombre = $request->get('Nombre');
        $producto->TipoControl = $request->get('TipoControl');
        $producto->Negociable = $request->get('Negociable');
        $producto->save();
        return response()->json($producto, 200);
    }

    public function cambiarVigencia($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->Vigencia = !$producto->Vigencia;
        $producto->save();

        return response()->json($producto, 200);

    }
       
    //FUNCION INICIO --> Uniendo 3 tablas (producto marca y categoria)
    public function listar()
    {
        $sql='SELECT pr.Codigo, ca.Nombre as nombreCategoria, ma.Nombre as nombreMarca, pr.Nombre as nombreProducto , pr.Tipo as Tipo FROM producto as pr
              INNER JOIN categoria as ca on ca.Codigo = pr.CodigoCategoria
              INNER JOIN marca as ma on ma.Codigo = pr.CodigoMarca
            ';
        $producto = DB::select($sql);

        return response()->json($producto, 200);
    }

       // public function listaProducto()
       // {
       //     $sql='SELECT ca.Nombre, ma.Nombre, pr.Nombre FROM producto as pr
       //         INNER JOIN categoria as ca on ca.Codigo = pr.CodigoCategoria
       //         INNER JOIN marca as ma on ma.Codigo = pr.CodigoMarca
       //         ';
       //     $producto = DB::select($sql);
       //     return response()->json($producto, 200);
       // }
   
       
       //MOSTRAR PRODUCTO
    //    public function mostrarProducto()
    //    {
    //        return producto::all();
    //    }
   
    //    //TABLA PRODUCTO
    //    public function tablaProducto()
    //    {
    //        //return producto::all('Codigo', 'CodigoCategoria', 'CodigoMarca', 'Tipo', 'Negociable','Nombre', 'TipoControl','Vigencia');
    //        $sql='SELECT pr.Vigencia, pr.Codigo, ca.Nombre as nombreCategoria, ma.Nombre as nombreMarca, pr.Nombre as nombreProducto , pr.Tipo as Tipo FROM producto as pr
    //            INNER JOIN categoria as ca on ca.Codigo = pr.CodigoCategoria
    //            INNER JOIN marca as ma on ma.Codigo = pr.CodigoMarca
    //            ';
    //        $producto = DB::select($sql);
    //        return response()->json($producto, 200);
    //    }
   
       //MOSTRAR PRODUCTO
       public function mostrar($id)
       {
           return producto::find($id);
       }
   
       
   
       
   
       //ELIMINAR
    //    public function eliminar($id)
    //    {
    //        $producto = producto::findOrFail($id);
    //        $producto->Vigencia = 0;
    //        $producto->save();
   
    //        return response()->json($producto, 200);
    //    }
   
       // CAMBIAR ESTADO
    //    public function cambiarEstado($id)
    //    {
    //        $producto = producto::findOrFail($id);
    //        $producto->Vigencia = !$producto->Vigencia;
    //        $producto->save();
   
    //        return response()->json($producto, 200);
    //    }
   
       // MOSTRAR CATEGORIA
       public function mostrarCategoria()
       {
           $respuesta=[];
           $categoria = DB::table('categoria as c')
               ->select('c.Codigo','c.Nombre')
               ->get();
           foreach($categoria as $c){
               array_push($respuesta, array("value"=>$c->Codigo, "text"=>$c->Nombre));
           }
           return response()->json($respuesta, 200);
       }
   
       // MOSTRAR MARCA
       public function mostrarMarca()
       {
           $respuesta=[];
           $marca = DB::table('marca as m')
               ->select('m.Codigo','m.Nombre')
               ->get();
           foreach($marca as $m){
               array_push($respuesta, array("value"=>$m->Codigo, "text"=>$m->Nombre));
           }
           return response()->json($respuesta, 200);
       }


}
