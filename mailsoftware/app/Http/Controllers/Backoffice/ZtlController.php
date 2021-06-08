<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\TypoHouses;
use App\Models\Ztl;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ZtlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ztls = Ztl::where('id', '!=', 1)
            ->with('houses', 'city')
            ->get();
        $cities = City::all();

        if ($request->ajax()){
            $data = Ztl::where('id', '!=', 1)
                ->with('houses', 'city')
                ->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-link-warning font-weight-bolder font-size-sm editZtl">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-link-danger font-weight-bolder font-size-sm deleteZtl">Delete</a>';

                    return $btn;
                })
                ->addColumn('name_ztl', function ($row) {
                    $link = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg editZtl">' . $row->description . '</a>';
                    if(count($row->houses) > 0){
                        $houses_typo = $this->getHousesAbbArray();
                        $houses = '';
                        foreach ($row->houses as $house){
                            $houses .=  $houses_typo[$house->uid]. ' ';
                        }
                        $link = $link . '<span class="text-muted font-weight-bold d-block">Case: '. $houses .' </span>';
                    } else {
                        $link = $link . '<span class="text-muted font-weight-bold d-block">Nessuna Casa Assegnata</span>';
                    }


                    return $link;
                })
                ->rawColumns(['action', 'name_ztl'])
                ->make(true);
        }

        return view('backend.ztl.index')
            ->with(compact('ztls'))
            ->with(compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        return view('backend.ztl.create')
            ->with(compact('cities'));
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
            'description' => 'required',
        ]);

//        $city = City::find($request->input('city_id'));

        Ztl::create([
            'city_id' => $request->city_id,
            'description' => $request->description,
            'ztl_da_am' => $request->ztl_da_am,
            'ztl_a_am' => $request->ztl_a_am,
            'ztl_out_am' => $request->ztl_out_am,
            'ztl_da_pm' => $request->ztl_da_pm,
            'ztl_a_pm' => $request->ztl_a_pm,
            'ztl_out_pm' => $request->ztl_out_pm,
        ]);

        return response()->json(['message_success'=>'Ztl salvata correttamente.']);

//        return redirect('/backend/ztl')->with('message', 'ZTL aggiunta correttamente a Database');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ztl = Ztl::find($id);

        return view('backend.ztl.show')
            ->with(compact('ztl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ztl = Ztl::where('id','=',$id)->with('city')->first();

        return response()->json($ztl);
//
//        return view('backend.ztl.edit')
//            ->with(compact('ztl'));
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
        $ztl = Ztl::find($id);
        $ztl->description = $request->description;
        $ztl->ztl_da_am = $request->ztl_da_am;
        $ztl->ztl_a_am = $request->ztl_a_am;
        $ztl->ztl_out_am = $request->ztl_out_am;
        $ztl->ztl_da_pm = $request->ztl_da_pm;
        $ztl->ztl_a_pm = $request->ztl_a_pm;
        $ztl->ztl_out_pm = $request->ztl_out_pm;
        $ztl->save();

        return response()->json(['message_update'=>'Ztl modificata correttamente.']);

//        return redirect('/backend/ztl/'.$id)
//            ->with('message', 'Dati ZTL Aggiornati con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ztl = Ztl::where('id', $id);
        $ztl->delete();

        return response()->json(['message_destroy'=>'Ztl cancellata correttamente.']);

//        return redirect('/backend/ztl')
//            ->with('message', 'Ztl cancellata correttamente');
    }
}
