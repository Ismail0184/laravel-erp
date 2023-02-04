<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccClass;
use App\Models\Accounts\AccSubClass;
use Illuminate\Http\Request;

class SubClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $subclasses, $classes;

    public function index()
    {
        $this->subclasses = AccSubClass::all();
        return view('modules.accounts.coa.subclass.index', ['subClasses'=>$this->subclasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->classes = AccClass::all()->where('status', 1);
        return view('modules.accounts.coa.subclass.create', ['classes' =>$this->classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccSubClass::storeSubClass($request);
        return redirect('/accounts/coa/sub-class/')->with('store_message','The sub-class has been successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return '<h1 style="text-align: center">Team is building the page</h1>';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->classes = AccClass::all()->where('status', 1);
        $this->subclasses = AccSubClass::find($id);
        return view('modules.accounts.coa.subclass.create', ['classes' =>$this->classes, 'subClasses'=>$this->subclasses]);
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
        AccSubClass::updateSubClass($request, $id);
        return redirect('/accounts/coa/sub-class/')->with('update_message','This Subclass (uid = '.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccSubClass::destroySubClass($id);
        return redirect('/accounts/coa/sub-class/')->with('destroy_message','This Subclass (uid = '.$id.') has been successfully deleted');


    }
}
