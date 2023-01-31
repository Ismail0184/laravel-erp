<?php

namespace App\Http\Controllers\Accounts\COA;

use App\Http\Controllers\Controller;
use App\Models\Accounts\AccClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $classes;

    public function index()
    {
        $this->classes = AccClass::all();
        return view('modules.Accounts.coa.class.index', ['classes' =>$this->classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.Accounts.coa.class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccClass::storeClass($request);
        return redirect('/accounts/coa/class/')->with('store_message','The class has been successfully inserted');
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
        $this->class=AccClass::find($id);
        return view('modules.Accounts.coa.class.create', ['class' =>$this->class]);
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
        AccClass::updateClass($request, $id);
        return redirect('/accounts/coa/class/')->with('update_message','This class (uid = '.$id.') has been successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccClass::destroyClass($id);
        return redirect('/accounts/coa/class/')->with('destroy_message','The Class has been successfully deleted');
    }
}
