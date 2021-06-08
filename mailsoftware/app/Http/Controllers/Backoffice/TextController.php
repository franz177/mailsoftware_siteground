<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Flow;
use App\Models\FlowText;
use App\Models\House;
use App\Models\Priority;
use App\Models\Section;
use App\Models\Text;
use App\Models\Type;
use App\Models\Typeanswer;
use App\Models\TypoHouses;
use App\Models\TypoSite;
use App\Models\TypoViewHouses;
use App\Models\TypoViewSites;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flow  = new Flow;

        $houses = TypoHouses::select('uid', 'header')
            ->pluck('header', 'uid');

        $sites = TypoSite::select('uid', 'tx_mask_siti_abbr as sito')
            ->pluck('sito', 'uid');

        $texts = Text::doesntHave('flows')->get();

        return view('backend.testi.index')
            ->with(compact('flow'))
            ->with(compact('houses'))
            ->with(compact('sites'))
            ->with(compact('texts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = Priority::all();

        return view('backend.testi.create')
            ->with(compact('priorities'));

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
            'priority_id' => 'required',
            'testo' => 'required',
        ]);

        Text::create([
            'name' => $request->input('name'),
            'priority_id' => $request->input('priority_id'),
            'testo' => $request->input('testo'),
            'text' => $request->input('text')
        ]);

        $insert_text = Text::latest('id')->first();

        return redirect('/backend/testi/'.$insert_text->id.'/edit')->with('message', 'Testo aggiunto correttamente a Database');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //FARE RIFERIMENTO ALLA FUNZIONE EDIT
        return redirect('backend/testi/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getText($id)
    {
        $text = Text::find($id);

        return response()->json($text);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $text = Text::where('id', '=', $id)
            ->with(['flow_text', 'flow_text.flow', 'flow_text.block', 'flow_text.section', 'flow_text.flow.typeanswer', 'flow_text.flow.type'])
            ->first();

        $priorities = Priority::all();
        $blocks = Block::all();
        $sections = Section::all();
        $typeanswers = Typeanswer::all();
        $types = Type::all();

        $sites = $this->getSitesArray();

        $houses = $this->getHousesArray();

        return view('backend.testi.edit')
            ->with(compact('sites'))
            ->with(compact('houses'))
            ->with(compact('text'))
            ->with(compact('priorities'))
            ->with(compact('blocks'))
            ->with(compact('sections'))
            ->with(compact('typeanswers'))
            ->with(compact('types'));
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
        Text::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'priority_id' => $request->input('priority_id'),
                'testo' => $request->input('testo'),
                'text' => $request->input('text')
            ]);

        return redirect('/backend/testi/'.$id)
            ->with('message', 'Dati Testo Aggiornati con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $text = Text::where('id', $id);
        $text->delete();

        return redirect('/backend/testi/')
            ->with('message', 'Testo cancellato correttamente');
    }
}
