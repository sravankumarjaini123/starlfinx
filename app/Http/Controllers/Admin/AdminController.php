<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::orderBy('id','desc')->get();
        return view('admin.index', compact('admins'));
    }

    public function adminUsers()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'mobile'   => 'nullable|regex:/^\+?[0-9]{10,15}$/',
            'role'     => 'required|in:admin,user',
            'status'   => 'nullable|in:active,inactive',
        ]);

        User::where('id',$id)->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'mobile'   => $request->mobile,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $request->status ?? 'active',
        ]);

        return redirect()
            ->route('admins.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        User::where('id',$id)->where('id','!=',1)->delete();
        return back()->with('success', 'Admin deleted');
    }
}
