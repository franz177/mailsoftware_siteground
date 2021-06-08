<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityTax;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CityTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $citytaxs = CityTax::where('id','!=', 1)->with('city')->get();
        $cities = City::all();

        if ($request->ajax()){
            $data = CityTax::where('id','!=', 1)->with('city')->get();

            return Datatables::of($data)
                ->addColumn('debit', function($row){

                    $debit = number_format($row->debit / 100, 2);
                    return $debit;
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-link-warning font-weight-bolder font-size-sm editCityTax">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-link-danger font-weight-bolder font-size-sm deleteCityTax">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['debit', 'action'])
                ->make(true);
        }

        return view('backend.citytaxs.index')
            ->with(compact('citytaxs'))
            ->with(compact('cities'));
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
            'city_id' => 'required',
            'description' => 'required',
            'mese_da' => 'required',
            'mese_a' => 'required',
            'debit' => 'required',
        ]);

        $debit = Str::replaceFirst(',','.', $request->debit);
        $debit = floatval($debit);
        $debit = $debit * 100;

        CityTax::create([
            'city_id' => $request->city_id,
            'description' => $request->description,
            'mese_da' => $request->mese_da,
            'mese_a' => $request->mese_a,
            'debit' => $debit,
            'notti_max' => $request->notti_max,
            'anni_max_adulti' => $request->anni_max_adulti,
            'anni_max_bambini' => $request->anni_max_bambini,

        ]);

        return response()->json(['message_success'=>'CityTax salvata correttamente.']);
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
        $citytax = CityTax::with('city')->find($id);

        return response()->json($citytax);
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
        $debit = Str::replaceFirst(',','.', $request->debit);
        $debit = floatval($debit);
        $debit = $debit * 100;

        $citytax = CityTax::find($id);
        $citytax->city_id = $request->city_id;
        $citytax->description = $request->description;
        $citytax->mese_da = $request->mese_da;
        $citytax->mese_a = $request->mese_a;
        $citytax->debit = $debit;
        $citytax->notti_max = $request->notti_max;
        $citytax->anni_max_adulti = $request->anni_max_adulti;
        $citytax->anni_max_bambini = $request->anni_max_bambini;
        $citytax->save();

        return response()->json(['message_update'=>'CityTax modificata correttamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $citytax = CityTax::where('id', $id);
        $citytax->delete();

        return response()->json(['message_destroy'=>'CityTax cancellata correttamente.']);

    }
}
