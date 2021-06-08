<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Text;
use App\Models\TextUser;
use App\Models\TypoUser;
use Illuminate\Http\Request;

class TextUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $text_id
     * @return \Illuminate\Http\Response
     */
    public function create($text_id)
    {
        $text = Text::find($text_id);
        $typo_user = new TypoUser;
        $operatori_typo = $this->getUsers();

        return view('backend.testo_utenti.create')
            ->with(compact('text'))
            ->with(compact('typo_user'))
            ->with(compact('operatori_typo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ($request->users as $user){
            $text_user_exist = TextUser::where('user_uid','=',$user)
                ->where('text_id','=', $request->input('text_id'))
                ->first();

            if($text_user_exist === NULL){
                TextUser::create([
                    'user_uid' => $user,
                    'text_id' => $request->input('text_id')
                ]);
                $message_success = 'Utenti assegnati con successo';
            } else {
                $message_warning = 'Utenti già assegnati';
            }
        }
        if($message_warning){
            return redirect('/backend/testo_utenti/create/'. $request->input('text_id'))
                ->with('message_warning',$message_warning);
        }

        return redirect('/backend/testo_utenti/create/'. $request->input('text_id'))
            ->with('message_success',$message_success);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
