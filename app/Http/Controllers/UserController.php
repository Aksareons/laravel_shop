<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\EditUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        // dd($user);
        return view('admin.users.edit', compact('user'));
    }

    public function update(EditUserRequest $request, User $user)
    {
        
        $this->authorize('update', $user);

        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_admin' => $request->has('is_admin') ? $request->is_admin : false,
            'is_manager' => $request->has('is_manager') ? $request->is_manager : false,
        ]);

        return redirect()->route('admin.users.index');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
