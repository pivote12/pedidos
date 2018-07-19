<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Response;


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$cliente = Cliente::withCount('pedidos')->with('pedidos')->get();
        $cliente = new Cliente();
        $cliente = $cliente->getPedidosWithCount();
        return Response::json($cliente);
        //dd($cliente);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'name' => 'required|string'
      ]);
      $cliente = new Cliente();
      $cliente->name = $request->name;
      $cliente->save();
      $cliente = $cliente->getPedidosWithCount();

      return Response::json($cliente);
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
        //
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
        $request->validate([
            'name' => 'required|string'
        ]);
        $cliente = Cliente::find($id);
        $cliente->name = $request->name;
        $cliente->save();
        $cliente = $cliente->getPedidosWithCount();

        return Response::json($cliente);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cliente = Cliente::where('id',$id)->with('pedidos')->first();
      if(count($cliente->pedidos)> 0)
      {
        return Response::json('false');;
      }
      $cliente->delete();
      return Response::json($cliente->getPedidosWithCount());
    }
}
