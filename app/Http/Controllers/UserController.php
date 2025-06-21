<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type_menu = 'user';

        // ambil data dari tabel user berdasarkan nama jika terdapat request
        $keyword = trim($request->input('name'));

        // Query users dengan filter pencarian dan role
        $users = User::when($keyword, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        })
            
            ->latest()
            ->paginate(10);

        // Tambahkan parameter query ke pagination
        $users->appends(['name' => $keyword]);

        // arahkan ke file pages/users/index.blade.php
        return view('pages.users.index', compact('type_menu', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = 'user';

        // arahkan ke file pages/users/create.blade.php
        return view('pages.users.create', compact('type_menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data dari form tambah user
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        //masukan data kedalam tabel users
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        //jika proses berhsil arahkan kembali ke halaman users dengan status success
        return Redirect::route('user.index')->with('success', 'User ' . $validatedData['name'] . ' berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(User $user)
    {
        $type_menu = 'user';

        // arahkan ke file pages/users/edit
        return view('pages.users.edit', compact('user', 'type_menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, User $user)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, 
            'password' => 'nullable|min:8', 
        ]);

        // Update the user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if (!empty($request->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return Redirect::route('user.index')->with('success', 'User ' . $user->name . ' berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('user.index')->with('success', 'User berhasil di hapus.');
    }
    public function show($id)
    {
        $type_menu = 'user';
        $user = User::find($id);

        // arahkan ke file pages/users/edit
        return view('pages.users.show', compact('user', 'type_menu'));
    }
}
