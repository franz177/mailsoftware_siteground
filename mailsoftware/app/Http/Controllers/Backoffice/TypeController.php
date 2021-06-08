<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        return view('backend.modello.index')
            ->with(compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        $types_count = count($types);

        return view('backend.modello.create')
            ->with(compact('types_count'));
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
            'name' => 'required',
        ]);

        Type::create([
            'name' => $request->input('name'),
            'sorting' => $request->input('sorting')
        ]);

        return redirect('/backend/modello')->with('message', 'Modello aggiunto correttamente a Database!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type::find($id);

        return view('backend.modello.show')
            ->with(compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type::find($id);

        return view('backend.modello.edit')
            ->with(compact('type'));
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
        Type::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'sorting' => $request->input('sorting')
            ]);

        return redirect('/backend/modello/'.$id)
            ->with('message', 'Dati Modello Aggiornati con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Type::where('id', $id);
        $post->delete();

        return redirect('/backend/modello')
            ->with('message', 'Modello cancellato correttamente');
    }
}
