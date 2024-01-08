<?php

namespace App\Http\Controllers;

use App\Models\letter_type;
use Illuminate\Http\Request;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letter_types = Letter_type::orderBy('id', 'ASC')->simplePaginate(5);
        return view('letters.klasifikasi.index', compact('letter_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('letters.klasifikasi.create');
    }

    public function letter_type_data(Request $request)
    {
        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
        ]);

        Letter_type::create([
            'letter_code' => $request->Letter_code,
            'name_type' => $request->name_type,
        ]);

        return redirect()->back()-with('success', 'berhasil menambahlan surat klasifikasi');
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
    public function show(letter_type $letter_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $letter_type = Letter_type::find($id);

        return view('letters.klasifikasi.edit', compact('letter_type'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'letter_code' => 'required|min:3',
            'name_type' => 'required',
        ]);
        $pw=password_hash($request->password, PASSWORD_DEFAULT);

        Letter_type::where('id', $id)->update([
            'letter_code' => $request->letter_code,
            'name_type' => $request->name_type,
        ]);

        return redirect()->route('letter_type.index')->with('success','Berhasil mengubah data klasifikasi surat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(letter_type $letter_type)
    {
        Letter_type::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
    }
}
