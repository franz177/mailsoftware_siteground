<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Priority;
use App\Models\TypoHouses;
use App\Models\Ztl;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $priorities = Priority::orderBy('name')->get();

        if ($request->ajax()){
            $data = Priority::orderBy('name')->get();

            return Datatables::of($data)
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-link-warning font-weight-bolder font-size-sm editPriority">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-link-danger font-weight-bolder font-size-sm deletePriority">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.priorities.index')
            ->with(compact('priorities'));
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

        Priority::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['message_success'=>'Priorità salvata correttamente.']);
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
        $priority = Priority::find($id);

        return response()->json($priority);
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
        $priority = Priority::find($id);
        $priority->name = $request->name;
        $priority->description = $request->description;
        $priority->save();

        return response()->json(['message_update'=>'Priorità modificata correttamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priority = Priority::where('id', $id);
        $priority->delete();

        return response()->json(['message_destroy'=>'Priorità cancellata correttamente.']);

    }
}
