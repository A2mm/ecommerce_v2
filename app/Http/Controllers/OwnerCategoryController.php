<?php

namespace App\Http\Controllers;

use App\Category;
use App\Icon;
use Datatables;
use Illuminate\Http\Request;
use App\History; 

class OwnerCategoryController extends Controller
{
    public function getShowAll()
    {
      $categories = Category::all();
      return view('owner_dashboard.categories.all',compact('categories'));
    }

    public function getCreate()
    {
        return view('owner_dashboard.categories.create',compact('icons'));
    }

    public function postStore(Request $request)
    {
        $this->validate($request, [
        'category_name' => 'required|min:3|unique:categories,name,NULL,id,deleted_at,NULL|regex:/^[\p{L} ]+$/u|max:50',
        ]);

        $arr_product = [
            'name' => $request['category_name'],
        ];

        $category = Category::create($arr_product);
        return redirect()->route('manage.category.all')->withMessage(__('translations.category_created_successfully'));
    }

    public function getEditCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
             return redirect()->route('manage.category.all')->withErrors(__('translations.category_not_found'));;
        }
        else {
            return view('owner_dashboard.categories.edit', compact('category'));
        }       
    }

    public function postEditCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {            
            return redirect()->route('manage.category.all')->withErrors(__('translations.category_not_found'));
        }

        $this->validate($request, [
            'category_name' => 'required|min:3|max:50|regex:/^[\p{L} ]+$/u|string',
        ]);

         $categoriesNames = Category::where('id', '!=', $id)->where('deleted_at', null)->pluck('name')->toArray();
         if (in_array($request->category_name, $categoriesNames)) {
             return redirect()->back()->withErrors(__('translations.categoryunique'));
         }
        $arr_product = [
            'name' => $request['category_name'],
        ];

        $old_name = $category->name;
        $new_name = $request->category_name; 
        if ($old_name == $new_name) {
            return redirect()->route('manage.category.all')->withMessage(__('translations.data_no_changed'));
         } 
         else
         {
            $category->update($arr_product);
            return redirect()->route('manage.category.all')->withMessage(__('translations.category_updated_successfully'));
         }
    }

    public function getDeleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {            
            return redirect()->route('manage.category.all')->withErrors(__('translations.category_not_found'));
        }
        $category->delete();

        return redirect()->route('manage.category.all')->withMessage(__('translations.category_deleted_successfully'));
    }
}
