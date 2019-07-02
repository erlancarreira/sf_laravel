<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;

use App\Models\AccountBank;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AccountBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = AccountBank::all();

        return view('admin.panel.account-bank.list.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = auth()->user()->id; 
        $users      = User::where('user_id', $id)->orWhere('id', $id)->get();
        return view('admin.panel.account-bank.index', compact('users', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $accountBank = new AccountBank; 

        $request->validate([  
            'ref'            => 'required|integer',
            'user_id'        => 'required|integer',
            'type'           => 'required|string',
            'full_name'      => 'required|string',
            'cpf'            => 'required|string',
            'agency'         => 'required|string',
            'account_number' => 'required|string',
            
        ]);

        $accountBank->user_id        = $request->user_id; 
        $accountBank->ref            = $request->ref;
        $accountBank->type           = $request->type;
        $accountBank->full_name      = $request->full_name; 
        $accountBank->cpf            = $request->cpf;
        $accountBank->agency         = $request->agency;
        $accountBank->account_number = $request->account_number;
        $accountBank->save();

        return redirect('/admin/bancos-listar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountBank  $accountBank
     * @return \Illuminate\Http\Response
     */
    public function show(AccountBank $accountBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountBank  $accountBank
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountBank $bank)
    {
        $id      = auth()->user()->id;
        $bank_id = $bank->id;
        $bank    = AccountBank::where('user_id', $id)->with('users')->get()->first();
        
        return view('admin.panel.account-bank.edit.index', compact('bank', 'bank_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountBank  $accountBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountBank $accountBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountBank  $accountBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountBank $bank)
    {
        
        $bank->delete();  
        return redirect('/admin/banco-listar');  
    }
}
