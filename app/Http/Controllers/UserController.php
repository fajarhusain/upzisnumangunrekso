<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    protected $roles;

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');

        // Define $roles as a collection of objects
        $this->roles = collect([
            (object) ['name' => 'Admin', 'value' => 'admin'],
            (object) ['name' => 'Penghimpun', 'value' => 'penghimpun'],
            (object) ['name' => 'Penyalur', 'value' => 'penyalur'],
            (object) ['name' => 'Pelayan', 'value' => 'pelayan'],
            (object) ['name' => 'Pengawas', 'value' => 'pengawas'],
        ]);

        // Share $roles with all views rendered by this controller
        view()->share('roles', $this->roles);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();

        return view('user.index', compact('users'));
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
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:35',
            'email' => 'required|email',
            'role' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],

        ]);

        // dd($request->role);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:35',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Akun berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Akun berhasil dihapus');
    }
}
