<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Typeanswer;
use Illuminate\Http\Request;

class TypeanswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeanswers = Typeanswer::all();
        $colors = Color::all();

        return view('backend.tiporisposta.index')
            ->with(compact('typeanswers'))
            ->with(compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();

        $typeanswer = Typeanswer::all();

        $typeanswer_count = count($typeanswer);

        return view('backend.tiporisposta.create')
            ->with(compact('colors'))
            ->with(compact('typeanswer_count'));
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

        Typeanswer::create([
            'name' => $request->input('name'),
            'sorting' => $request->input('sorting'),
            'color_id' => $request->input('color_id')
        ]);

        return redirect('/backend/tiporisposta')->with('message', 'Tipo Risposta aggiunto correttamente a Database!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typeanswer = Typeanswer::find($id);

        return view('backend.tiporisposta.show')
            ->with(compact('typeanswer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeanswer = Typeanswer::find($id);
        $colors = Color::all();

        return view('backend.tiporisposta.edit')
            ->with(compact('typeanswer'))
            ->with(compact('colors'));
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
        Typeanswer::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'sorting' => $request->input('sorting'),
                'color_id' => $request->input('color_id')
            ]);

        return redirect('/backend/tiporisposta/'.$id)
            ->with('message', 'Dati Tipo Risposta Aggiornati con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Typeanswer::where('id', $id);
        $post->delete();

        return redirect('/backend/tiporisposta')
            ->with('message', 'Tipo Risposta cancellata correttamente');
    }
}
