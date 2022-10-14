<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('read-users');
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-users');
        $roles = Role::get();
        $stations = Station::get();
        return view('users.create', compact('roles', 'stations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $this->authorize('create-users');
        $user = User::create(array_merge($request->except('password'), ['password' => bcrypt($request->password)]));
        $user->assignRole($request->role_id);

        return redirect()->route('app.users.index')->with('success', 'User Added');
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
    public function edit(User $user)
    {
        $this->authorize('update-users');

        $roles = Role::get();
        $stations = Station::get();

        return view('users.edit', compact('user', 'stations', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        $this->authorize('update-users');
        $user->update($request->all());
        $user->syncRoles($request->role_id);
        return redirect()->route('app.users.index')->with('success', 'User Updated');


    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // dd($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('app.users.index')->with('success', 'User Updated');


    }

    public function resetPasswordView($id)
    {
       $user = User::find($id);
        return view('users.reset-password', compact('user'));


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete-users');

        $user->delete();

        return back()->with('success', 'User Deleted');
    }
}
