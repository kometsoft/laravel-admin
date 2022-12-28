<?php

namespace Tabler\App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Tabler\App\DataTables\UsersDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('tabler::admin.user.index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tabler::admin.user.modify', [
            'user' => new User,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'max:255', 'unique:users,email'],
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt('password'),
        ]);

        $user->syncRoles($r->roles);

        // $status = Password::sendResetLink(['email' => $user->email]);

        // if ($status == Password::RESET_LINK_SENT) {
        return redirect()->route('admin.user.index')->with('success', 'Saved! Password reset link was sent to the user email.');
        // }

        // throw ValidationException::withMessages([
        //     'email' => [trans($status)],
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('tabler::admin.user.show', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('tabler::admin.user.modify', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $r
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, User $user)
    {
        $r->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $r->name,
            'email' => $r->email,
        ]);

        $user->syncRoles($r->roles);

        return redirect()->route('admin.user.index')->with('success', 'Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
