<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
//use App\models\Status;

class StatusesController extends Controller
{
    /**
     * StatusesController constructor.
     * 登录才能调用
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'content' => 'required|max:140'
        ]);
        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success','发布成功！');
        return redirect()->back();

    }
}
