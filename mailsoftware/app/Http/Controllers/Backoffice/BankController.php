<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Color;
use App\Models\TypoHouses;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banks = Bank::where('id', '!=', 1)->get();

        if ($request->ajax()){
            $data = Bank::where('id', '!=', 1)->get();

            return Datatables::of($data)
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-link-warning font-weight-bolder font-size-sm editBanca">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-link-danger font-weight-bolder font-size-sm deleteBanca">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.banca.index')
            ->with(compact('banks'));
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

        Bank::create([
            'name' => $request->name,
            'nome_banca' => $request->nome_banca,
            'beneficiario' => $request->beneficiario,
            'indirizzo' => $request->indirizzo,
            'bic' => $request->bic,
            'swift' => $request->swift,
            'iban' => $request->iban,
            'causale' => $request->causale
        ]);

        return response()->json(['message_success'=>'Banca salvata correttamente.']);
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
        $bank = Bank::find($id);

        return response()->json($bank);

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
        $bank = Bank::find($id);
        $bank->name = $request->name;
        $bank->nome_banca = $request->nome_banca;
        $bank->beneficiario = $request->beneficiario;
        $bank->indirizzo = $request->indirizzo;
        $bank->bic = $request->bic;
        $bank->swift = $request->swift;
        $bank->iban = $request->iban;
        $bank->causale = $request->causale;
        $bank->save();

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
        $bank = Bank::where('id', $id);
        $bank->delete();

        return response()->json(['message_destroy'=>'Priorità cancellata correttamente.']);
    }
}
