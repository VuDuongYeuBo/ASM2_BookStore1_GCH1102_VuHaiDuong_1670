<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public $viewprefix;
    public $viewnamespace;

    public function __construct()
    {   //$this->middleware('CheckAdminLogin');
        $this->viewprefix = 'admin.user.';
        $this->viewnamespace = 'panel/user';
    }

    public function index(UserRequest $request)
    {
        $users = User::all();
        return view($this->viewprefix . 'index', compact('users'));
    }

    public function create(UserRequest $request)
    {
        return view('admin.user.add');
    }

    public function store(UserRequest $request)
    {
        $this->validate($request, [
            'txtname' => 'required',
            'txtemail' => 'required',
            'txtpassword' => 'required',
            'role' => 'required'
        ]);

        $user = new User;
        $user->name = $request->txtname;
        $user->email = $request->txtemail;
        $user->role = $request->role;
        $user->password = Hash::make($request->txtpassword);
        $user->status = $request->status;
        $user->save();
        return redirect('panel/user');
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view($this->viewprefix . 'edit', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $this->validate($request, [
            'txtname' => 'required',
            'txtemail' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->txtname;
        $user->email = $request->txtemail;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->txtpassword) {
            $user->password = Hash::make($request->txtpassword);
        }

        if ($user->save())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect('panel/user');
    }

    public function delete(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->delete())
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect('panel/user');
    }
}
