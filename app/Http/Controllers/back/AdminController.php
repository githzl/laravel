<?php

namespace App\Http\Controllers\back;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Cookie;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $email = $request->cookie('is_admin');
        $data = Admin::where('email',$email)->first();
        if($data){
            return redirect($request->getBaseUrl());
        }
        return view('back.login');
    }

    /**
     * this is logout function
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if(!Cookie::queue('is_admin','',-1)){
            return redirect($request->getBaseUrl());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->input('email','default');
        $password = $request->input('password','default');
        $remember = $request->input('remember',1);
        $data = Admin::where('email',$email)->where('password',$password)->first();
        if(!$data){
            return back();
        }else{
            Cookie::queue('is_admin',$email, $remember * 1440);
            return redirect($request->getBaseUrl());
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
