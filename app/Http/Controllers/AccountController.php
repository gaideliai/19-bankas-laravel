<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use App\Client;
use Validator;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request, Account $account)
    {   
        return view('account.add', ['account' => $account]);
    }

    public function deduct(Request $request, Account $account)
    {
        return view('account.deduct', ['account' => $account]);
    }

    public function addfunds(Request $request, Account $account)
    {
        if ($request->balance > 0) {
            $account->balance = $account->balance + $request->balance;
            $account->save();
            return redirect()->back()->with('success_message', 'Valio!');
        } else {
            return redirect()->back()->with('info_message', 'Įveskite sumą - teigiamą skaičių.');
        }
        
    }

    public function deductfunds(Request $request, Account $account)
    {
        if ($request->balance <= 0) {
            return redirect()->back()->with('info_message', 'Įveskite sumą - teigiamą skaičių.');
        }
        if ($account->balance >= $request->balance) {
            $account->balance = $account->balance - $request->balance;
            $account->save();
            return redirect()->back()->with('success_message', 'Valio!');
        } else {
            return redirect()->back()->with('info_message', 'Nepakanka lėšų. Operacija neįvykdyta.');
        }
        
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::orderBy('surname')->orderBy('name')->get();
        return view('account.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = new Account;
        return view('account.create', ['account' => $account]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required', 'min:3', 'max:64'],
            'surname' => ['required', 'min:3', 'max:64'],
            'id_no' => ['required']
        ],
        [
            'name.min' => 'Vardą turi sudaryti bent trys simboliai.',
            'surname.min' => 'Pavardę turi sudaryti bent trys simboliai.',
            'name.required' => 'Įveskite vardą.',
            'surname.required' => 'Įveskite pavardę.',
            'id_no.required' => 'Įveskite asmens kodą.'
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $account = new Account;
        $account->name = $request->name;
        $account->surname = $request->surname;
        $account->id_no = $request->id_no;     
        $account->account = $request->account;
        $account->balance = $request->balance;
        if ($account->verifyID($request->id_no)) {
            $account->save();
            return redirect()->back()->with('success_message', 'Sukurta sąskaita.');
        } else {            
            return redirect()->back()->with('info_message', 'Neteisingai įvestas asmens kodas.');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if($account->balance > 0) {
            return redirect()->route('account.index')->with('info_message', 'Nepavyko ištrinti sąskaitos.');
        }
        $account->delete();
        return redirect()->route('account.index')->with('success_message', 'Sąskaita ištrinta.');
    }

}
