<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show','create','store']
        ]);
        $this->middleware('guest',[
            'only'  =>  ['create']
        ]);
    }
    //获取注册页面
    public function create(){
        return view('users.create');
    }
    //展示个人用户
    public function show(User $user){
        return view('users.show',compact('user'));
    }
    //处理注册逻辑
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:50|min:3',
            'email' => 'required|email|unique:users|max:255',
            'password'  => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        Auth::login($user);
        session()->flash('success','欢迎，您将在这里还是一段新的旅程！');
        return redirect()->route('users.show',[$user]);
    }

    //个人用户edit
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }
    //提交保存更新数据
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name'  => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success','个人资料更新！');
        return redirect()->route('users.show',$user->id);
    }
}
