<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Permiso;
use App\PermisoDetalle;
use App\User;
use DB;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return $permisos;
        //
        return view('permiso.index',[]);
    }

    public function filterIndex(Request $request)
    {
        $datos = DB::table('permisos as p')
        ->select(
            'p.id_permiso as id',
            DB::raw('DATE_FORMAT(p.per_fecha_registro, "%d/%m/%Y %r") as fecha_registro'),
            'u.usr_name as nombre',
            DB::raw('(CASE WHEN p.per_estado = 1 THEN "ACTIVO" ELSE "INACTIVO" END) as estado')
        )
        ->join('users as u','u.id_user','p.id_user');

        // filtro
        if(
            isset($request->P_fil_estado) ||
            isset($request->P_fil_user) ||
            isset($request->P_fil_inicio_fecha) ||
            isset($request->P_fil_termino_fecha)
        ){

            // filtrar fecha inicio y fecha termino
            if(isset($request->P_fil_inicio_fecha) && isset($request->P_fil_termino_fecha)){
                $datos = $datos->whereBetween('p.per_fecha_registro', [$request->P_fil_inicio_fecha." 00:00:00", $request->P_fil_termino_fecha." 23:59:59"]);
            }else if(isset($request->P_fil_inicio_fecha)){
               $datos = $datos->whereBetween('p.per_fecha_registro', [$request->P_fil_inicio_fecha." 00:00:00", date("Y-m-d",strtotime(date("Y-m-d")."+ 1 year"))." 23:59:59"]);
            }else if(isset($request->P_fil_termino_fecha)){
                $datos = $datos->whereBetween('p.per_fecha_registro', [date("Y-m-d",strtotime(date("Y-m-d")."- 1 year"))." 00:00:00", $request->P_fil_termino_fecha." 23:59:59"]);
            }

            // filtrar usuario
            if(isset($request->P_fil_user)){
                $datos = $datos->where('p.id_user','=', $request->P_fil_user);
            }

            // filtrar estado
            if(isset($request->P_fil_estado)){
                $datos = $datos->where('p.per_estado','=', ($request->P_fil_estado == "ACTV") ?  1 : 0 );
            }
            $datos = $datos->orderBy('id_permiso','asc')->get();
        }else{
            $datos = $datos->orderBy('id_permiso','asc')->limit(500)->get();
        }



        return Datatables::of($datos)
            ->addColumn('action', function ($dato) {
                return "<center>
                           <!-- <a class='btn btn-info' title='Información' data-toggle='modal'
                            data-target='#m-open-modal-view'
                            data-url='".route('access.permiso.show',$dato->id)."'><i class='far fa-eye'></i></a> -->
                            <a class='btn btn-success' title='Editar'
                            href='".route('access.permiso.edit',$dato->id)."'><i class='fa fa-edit'></i></a>
                            <a class='btn btn-secondary' data-toggle='modal'
                            data-target='#m-open-change-status' title='Cambiar Estado'
                            data-url='".route('access.permiso.destroy',$dato->id)."' ><i class='fa fa-cog'></i></a>
                        </center>";

            })->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('permiso.create',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'id_usuario'    => ['bail','required','numeric',
            Rule::unique('permisos','id_user')->where(function($query){
                  $query->where('per_estado', '=', 1);
              })
            ],
            'detalle'       => ['bail','required','nullable']
        ]);

        if ($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()]);
        }else{
            DB::beginTransaction();
            try {
                //cabecera
                $permiso = new Permiso();
                $permiso->id_user = $request->id_usuario;
                $permiso->per_fecha_registro = date('Y-m-d H:i:s');
                $permiso->save();

                //cuerpo
                $detalle = json_decode($request->detalle, true);

                if($permiso){
                    for($i = 0; $i < count($detalle); $i++){
                        $permisodetalle = new PermisoDetalle();
                        $permisodetalle->id_menu  = $detalle[$i]['menuId'];
                        $permisodetalle->id_permiso  = $permiso->id_permiso;
                        $permisodetalle->save();
                    }
                }

                DB::commit();
                return response()->json(["msg" => "Permiso ingresado correctamente"]);

            } catch (Exception $e){
                DB::rollBack();
                return response()->json(["error" => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_permiso = $id;
        //
        $cabecera = DB::table('permisos as p')
        ->select(
            'id_permiso as id',
            DB::raw('DATE_FORMAT(p.per_fecha_registro, "%d/%m/%Y %H:%i:%S") as fecha_registro'),
            'p.id_user as id_user',
            'u.usr_name as user_descripcion',
            'p.per_estado as per_estado'
        )
        ->join('users as u','u.id_user','p.id_user')
        ->where('p.id_permiso','=',$id_permiso)
        ->first();

        $detalle = DB::table('permiso_detalles as pd')
        ->select(
            'id_permiso_detalle as id',
            'pd.id_menu as id_menu',
            'm.mnu_descripcion as menu_descripcion'
        )
        ->join('menus as m','m.id_menu','pd.id_menu')
        ->where('pd.pd_estado','=',1)
        ->where('pd.id_permiso','=',$id_permiso)
        ->get();

        return view('permiso.edit',[
            // 'permisoId' => $cabecera->id,
            'cabecera' => json_encode($cabecera,true),
            'detalle' => json_encode($detalle,true)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'id_usuario'    => ['bail','required','numeric',
            Rule::unique('permisos','id_user')->where(function($query) use ($id){
                  $query->where('id_permiso','!=',$id)
                  ->where('per_estado', '=', 1);
              })
            ],
            'id_delete'     => ['bail','required','nullable'],
            'detalle'       => ['bail','required','nullable']

        ]);

        if ($validator->fails()){
            return response()->json(["error" => $validator->errors()->first()]);
        }else{
            DB::beginTransaction();
            try {
                $permiso = Permiso::find($id);

                if(!$permiso){
                    return response()->json(["msg" => "Aparentemente el registro no existe"]);
                }
                // actualiza cabecera
                $permiso->id_user = $request->id_usuario;
                $permiso->save();

                // cambia el estado de los menus eliminados
                $detalleID = json_decode($request->id_delete, true);

                if(count($detalleID) > 0){
                    PermisoDetalle::where('id_permiso', $id)
                        ->whereIn('id_permiso_detalle', $detalleID)
                        ->update([
                            'pd_estado' => 0
                        ]);
                }
                // cuerpo nuevos registros
                $detalle = json_decode($request->detalle, true);

                if(count($detalle) > 0){
                    for($i = 0; $i < count($detalle); $i++){
                        $permisodetalle = new PermisoDetalle();
                        $permisodetalle->id_menu  = $detalle[$i]['menuId'];
                        $permisodetalle->id_permiso  = $permiso->id_permiso;
                        $permisodetalle->save();
                    }
                }

                DB::commit();
                return response()->json(["msg" => "Permiso actualizado correctamente"]);

            } catch (Exception $e){
                DB::rollBack();
                return response()->json(["error" => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $permiso = Permiso::find($id);

            if(!$permiso){
                return response()->json(["msg" => "Aparentemente el registro no existe"]);
            }

            if($permiso->per_estado == "1"){

                $permiso->per_estado = '0';
                $permiso->save();
                // return Redirect::to("permiso")->with('correcto', 'Se elimino correctamente');

            } else{

                $permiso->per_estado = '1';
                $permiso->save();
                // return Redirect::to("permiso")->with('correcto', 'Se activo correctamente');
            }
            DB::commit();
            // return Redirect()->back()->with('correcto', 'Se cambio el estado correctamente');
            return response()->json(["msg" => "Permiso actualizado correctamente"]);
        } catch (Exception $e){
            DB::rollBack();
            return response()->json(["error" => $e->getMessage()]);
        }
    }

    public function autocompletarMenu( Request $request )
    {
        //
        $validator = Validator::make($request->all(), [
            'searchTerm'    =>'bail|max:50|string|nullable',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors()->first());
        }else{

            $query = DB::table('menus as men')
                ->select(
                    'men.id_menu AS id',
                    'men.mnu_descripcion AS text')
                ->where('men.mnu_estado', 1);

            if($request->has('searchTerm')){
                $searchTerm='%'.$request->searchTerm.'%';
                $query=$query->where('men.mnu_descripcion','like',$searchTerm);
                $datos = $query->get();
            }else{
                $datos = $query->get();
            }
            return response()->json($datos);
        }

    }

    public function autocompletarUser( Request $request )
    {
        //
        $validator = Validator::make($request->all(), [
            'searchTerm'    =>'bail|max:50|string|nullable',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors()->first());
        }else{

            $query = DB::table('users as use')
                ->select(
                    'use.id_user AS id',
                    'use.usr_name AS text')
                // ->where('men.mnu_estado', 1)
                ;

            if($request->has('searchTerm')){
                $searchTerm='%'.$request->searchTerm.'%';
                $query=$query->where('use.usr_name','like',$searchTerm);
                $datos = $query->get();
            }else{
                $datos = $query->get();
            }
            return response()->json($datos);
        }

    }

    public function autocompletarFilterMenu( Request $request )
    {
        //
        $validator = Validator::make($request->all(), [
            'searchTerm'    =>'bail|max:50|string|nullable',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors()->first());
        }else{

            $query = DB::table('permiso_detalles as pd')
                ->select(
                    'men.id_menu AS id',
                    'men.mnu_descripcion AS text')
                ->join('menus as men','men.id_menu','pd.id_menu')
                ->where('pd.pd_estado', 1);

            if($request->has('searchTerm')){
                $searchTerm='%'.$request->searchTerm.'%';
                $query=$query->where('men.mnu_descripcion','like',$searchTerm);
                $datos = $query->get();
            }else{
                $datos = $query->get();
            }

            $jsonArray = array();
            $contador = 0;
            foreach($datos as $value){
                $jsonArrayItem = array();
                if($contador==0){
                    $jsonArrayItem['id'] = "";
                    $jsonArrayItem['text'] = "-- TODOS --";
                    array_push($jsonArray, $jsonArrayItem);
                }
                $jsonArrayItem['id'] = $value->id;
                $jsonArrayItem['text'] = $value->text;
                array_push($jsonArray, $jsonArrayItem);
                $contador++;
            }
            $datos = $jsonArray;
            return response()->json($datos);
        }

    }

    public function autocompletarFilterUser( Request $request )
    {
        //
        $validator = Validator::make($request->all(), [
            'searchTerm'    =>'bail|max:50|string|nullable',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors()->first());
        }else{

            $query = DB::table('permisos as p')
                ->select(
                    'usr.id_user AS id',
                    'usr.usr_name AS text')
                ->join('users as usr','usr.id_user','p.id_user')
                ->where('p.per_estado', 1)
                ;

            if($request->has('searchTerm')){
                $searchTerm='%'.$request->searchTerm.'%';
                $query=$query->where('usr.usr_name ','like',$searchTerm);
                $datos = $query->get();
            }else{
                $datos = $query->get();
            }

            $jsonArray = array();
            $contador = 0;
            foreach($datos as $value){
                $jsonArrayItem = array();
                if($contador==0){
                    $jsonArrayItem['id'] = "";
                    $jsonArrayItem['text'] = "-- TODOS --";
                    array_push($jsonArray, $jsonArrayItem);
                }
                $jsonArrayItem['id'] = $value->id;
                $jsonArrayItem['text'] = $value->text;
                array_push($jsonArray, $jsonArrayItem);
                $contador++;
            }
            $datos = $jsonArray;
            return response()->json($datos);
        }

    }
}
