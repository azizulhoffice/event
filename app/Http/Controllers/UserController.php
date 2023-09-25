<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(100);
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserAddRequest $request)
    {
        $user = User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User Added Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.users.edit',compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {   $user = User::where('id',$id)->first();
        if($request->password == null){
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'phone_number' => $request->phone_number,
                'remarks' => $request->remarks,
            ]);
        }
        else if($request->password != null&& $request->password == $request->password_confirmation){
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'remarks' => $request->remarks,
            ]);
        }
        return redirect()->route('users.index')->with('success', 'User Updated Successfully!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully!');
    }
    function allJudges(){
        $users = User::where('role','judge')->get();
        return view('admin.users.judges',compact('users'));
    }
}
