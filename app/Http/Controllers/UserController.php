<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = 'staff';
        // proses ambil data
        $users = User::where('role', 'staff')->orderBy('name', 'ASC')->simplePaginate(5);
        // manggil html yg ada di folder resourse/views/user/index.blade.php
        // compact : mengirim data ke blade
        return view('user.index', compact('users'));
    }

    public function authLogin(Request $request) 
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        // simpan data dr inputan email dan password ke dlm variable untuk memudahkan pemanggilanya
        $user = $request->only(['email', 'password']);
        // attempt : mengecek kecocokan email dan password kemudian menyimpannya ke dalam class auth(memberi identitas data riwayat login ke projectnya)
        if (Auth::attempt($user)) {
            // perbaikan redirect( dan redirect ()->route??) redirect -> path / route -> name
            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('failed', 'Login gagal silahkan coba lagi');
        }
    }

    public function logout()
    {
        // menghapus/menghilangkan data session login
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function user_data(Request $request)
    // untuk mengambil data yang diinput user
    // validasi biar user mengisi data dengan benar

    {
        // validasi
        // 'name_input' => 'validasi1/validasi2'
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
        ]);
        $namaku=substr($request->name,0,3);
        $emailku=substr($request->email,0,3);
        $pw= hash::make($namaku.$emailku);
        // $pw=password_hash ('', $request->password);
        // simpan data ke db : 'nama_column' => $request->name_input
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pw,
            'role' => 'staff',
        ]);

        // abis simpen, arahin ke halaman mana
        return redirect()->back()->with('succes', 'berhasil menambahkan data staff!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        // mengembalikan bentuk json dikirim data y diambil dengan response status code 200
        // response status code api :
        // 200 -> success/ok
        // 400 an -> error kode/validasi input user
        // 419 -> error token csrf
        // 500 an -> error server hosting
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //mebgambil data yg akan dimunculkan
        // find : Mencari berdasarkan column id
        // bisa juga : where('id', $id)->first()
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //validasi
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => '',
        ]);
        $pw=password_hash($request->password,PASSWORD_DEFAULT);

        // carai berdasarkan id, trs update
        User::where('id', $id)->update
        ([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'staff',    
            'password' => $pw,
        ]);
        //redirect ke hlmn data 
        return redirect()->route('user.data')->with('success', 'data berhasil mengubah staff!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // cari dan hapus data
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'berhasil menghapus data!');
    }

    public function stockData()
    {
        $users = User::orderBy('stock', 'ASC')->simplePaginate(5);
        return view('user.stock', compact('users'));
    }

    public function updateStock(Request $request, $id)
    {
        // validasi input
        $request->validate([
            'stock' => 'required|numeric',
        ], [
            'stock.required' => 'Input stock harus diisi!',
        ]);
        // ambil dala sblm update, untuk dibandingkan
        $userBefore = User::where('id', $id)->first();
        if ($request->stock <= $userBefore['stock']) {
            // jika stock yg diinput <= stock sblmnya, kiri format error
            return response()->json(['message' => 'stock tidak boleh lebih/sama dengan stock sebelumnya!'], 400);
        }
        // kalau gamasuk ke if
        $userBefore->update(['stock' => $request->stock]);
        return response()->json('berhasil', 200);
    }
}
