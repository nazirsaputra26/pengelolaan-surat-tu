<?php

namespace App\Http\Controllers;

use App\Models\letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // public function authLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email:dns',
    //         'password' => 'required',
    //     ]);

    //     // simpan data dr inputan email dan password ke dlm variable untuk memudahkan pemanggilanya
    //     $user = $request->only(['email', 'password']);
    //     // attempt : mengecek kecocokan email dan password kemudian menyimpannya ke dalam class auth(memberi identitas data riwayat login ke projectnya)
    //     if (Auth::attempt($user)) {
    //         // perbaikan redirect( dan redirect ()->route??) redirect -> path / route -> name
    //         return redirect('/dashboard');
    //     } else {
    //         return redirect()->back()->with('failed', 'Login gagal silahkan coba lagi');
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(letter $letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, letter $letter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(letter $letter)
    {
        //
    }
}
