<?php

namespace App\Http\Controllers;

use App\CategoryOnline;
use Illuminate\Http\Request;

class CategoriesOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryOnline::all();
        return view('owner_dashboard.categories-online.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner_dashboard.categories-online.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
          'name' => 'required|min:3|max:30|unique:category_onlines,name',
           'description'          => 'required|min:30|max:1200',
        ]);

        $requestData = $request->all();
        $name = $requestData['name'] ;
        $description = $requestData['description'];
/**
 *         if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name) || preg_match('/[0-9]/', $name))
   *     {
    *        return redirect()->back()->withInput()->with('error' , 'يجب ان يتكون الاسم من حروف فقط');
     *   }

 */
        CategoryOnline::create($requestData);
        return redirect()->route('categories.online')->with('message' , 'تم اضافة فئة ');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryOnline  $categoryOnline
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryOnline $categoryOnline)
    {
        return view('owner_dashboard.categories-online.edit' , compact('categoryOnline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryOnline  $categoryOnline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryOnline $categoryOnline)
    {
      $this->validate($request , [
        'name' => 'required|min:3|max:30|unique:category_onlines,name,' . $categoryOnline->id ,
        'description'      => 'required|min:30|max:1200',
      ]);

      $requestData = $request->all();
      $name = $requestData['name'] ;
      $description = $requestData['description'] ;
/**      if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name) || preg_match('/[0-9]/', $name))
   *   {
    *      return redirect()->back()->withInput()->with('error' , 'يجب ان يتكون الاسم من حروف فقط');
     * }
 */
      $categoryOnline->update($requestData);
      return redirect()->route('categories.online')->with('message' , 'تم تعديل الفئة ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryOnline  $categoryOnline
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryOnline $categoryOnline)
    {
        $categoryOnline->delete();
        return redirect()->back()->with('message' , 'تم حذف الفئة') ;
    }
}
