<?php

namespace App\Http\Controllers\Developer\Builder;

use App\Http\Controllers\Controller;
use App\Models\Developer\Builder\DevMainMenu;
use App\Models\Developer\Builder\DevModule;
use Illuminate\Http\Request;

class MainMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $mainmenus,$mainmenu,$modules;

    public function index()
    {
        $this->mainmenus = DevMainMenu::all();
        return view('modules.developer.mainmenu.index', ['mainmenus' => $this->mainmenus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->modules = DevModule::where('status', 1)->get();
        return view('modules.developer.mainmenu.create' ,['modules' =>$this->modules]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DevMainMenu::storeMainMenu($request);
        return redirect('/developer/main-menu/')->with('store_message','New main menu inserted successfully!!');
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
        $this->mainmenu = DevMainMenu::find($id);
        $this->modules = DevModule::all();
        return view('modules.developer.mainmenu.create', ['mainmenu' => $this->mainmenu],['modules'=> $this->modules]);
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
        DevMainMenu::updateMainMenu($request, $id);
        return redirect('/developer/main-menu/')->with('update_message','This main menu (uid = '.$id.') has been successfully updated');


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
