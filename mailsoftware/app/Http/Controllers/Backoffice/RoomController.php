<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\House;
use App\Models\Room;
use App\Models\Typo;
use App\Models\TypoHouses;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = Room::with('houses')->get();
        $houses_typo = $this->getHousesArray();

        if ($request->ajax()){
            $data = Room::with('houses')->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-link-warning font-weight-bolder font-size-sm editCamera">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-link-danger font-weight-bolder font-size-sm deleteCamera">Delete</a>';

                    return $btn;
                })
                ->addColumn('name_camera', function ($row) {
                    $link = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg editCamera">' . $row->name . '</a>';
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
                ->rawColumns(['action', 'name_camera'])
                ->make(true);
        }

        return view('backend.camera.index')
            ->with(compact('rooms'))
            ->with(compact('houses_typo'));
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
            'name' => 'required',
        ]);

        $new_room = Room::create([
            'name' => $request->name,
            'descrizione'=> $request->descrizione,
            'description'=> $request->description
        ]);

        $new_room->houses()->sync($request->houses);


        return response()->json(['message_success'=>'Camera salvata correttamente.']);
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
        $room = Room::where('id','=',$id)->with('houses')->first();

        return response()->json($room);

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
        $room = Room::find($id);
        $room->name = $request->name;
        $room->descrizione = $request->descrizione;
        $room->description = $request->description;
        $room->save();

        $room->houses()->sync($request->houses);

        return response()->json(['message_update'=>'Camera modificata correttamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::where('id', $id);
        $room->delete();

        return response()->json(['message_destroy'=>'Camera cancellata correttamente.']);
    }
}
