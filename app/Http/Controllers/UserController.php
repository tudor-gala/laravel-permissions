<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('read user');

        return view('users.index', [
            'users' => User::latest()->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('create user');

        return view('users.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create user');

        $data = $request->input();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        User::create($data);

        return redirect()->route('users.index');
    }

    public function edit(string $id)
    {
        $this->authorize('update user');

        return view('users.form', [
            'user' => User::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->authorize('update user');

        $data = $request->input();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        User::findOrFail($id)->update($data);

        return redirect()->route('users.index');
    }

    public function destroy(Request $request, string $id)
    {
        $this->authorize('delete user');

        if ((string) $request->user()->id === $id) {
            throw new \Exception('Can\'t delete yourself');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('users.index');
    }
}
