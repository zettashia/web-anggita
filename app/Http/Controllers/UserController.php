<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password|min:8 ',
            'role',
            'status'
        ]);

        User::create($data);
        return redirect()->route('user.index')->with('message', 'The new user data with the name '. $request->name . ' has been sucessfully saved!');
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
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('admin.user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::find($id);
        $request->validate([
            'name' => 'required|unique:users,name,' .$id,
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        $data->update($request->all());
        $data->save();
        return redirect()->route('user.index')->with('message', 'User data with the name '. $request->name . ' updated sucessfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::where('id', $id)->delete();
        return back()->with('message', 'Data delete successfully!');
    }
}
