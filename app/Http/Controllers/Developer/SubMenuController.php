<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Developer\DevMainMenu;
use App\Models\Developer\DevSubMenu;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $submenus,$submenu,$mainmenus;

    public function index()
    {
        $this->submenus = DevSubMenu::query()->orderBy('main_menu_id')->orderBy('sub_menu_id')->get();
        return view('modules.developer.submenu.index', ['submenus'=>$this->submenus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainmenus = DevMainMenu::where('status', 1)->orderBy('main_menu_id')->get();
        return view('modules.developer.submenu.create',compact('mainmenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DevSubMenu::storeSubMenu($request);
        return redirect('/developer/sub-menu/')->with('store_message','A sub-menu has been successfully created!!');
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
        $mainmenus = DevMainMenu::where('status', 1)->orderBy('main_menu_id')->get();
        $submenu=DevSubMenu::find($id);
        return view('modules.developer.submenu.create',compact(['mainmenus','submenu']));
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
        DevSubMenu::updateSubMenu($request,$id);
        return redirect('/developer/sub-menu/')->with('update_message','This sub-menu (uid='.$id.') has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DevSubMenu::destroySubMenu($id);
        return redirect('/developer/sub-menu/')->with('destory_message','This sub-menu (uid='.$id.') has been successfully updated');
    }
}
