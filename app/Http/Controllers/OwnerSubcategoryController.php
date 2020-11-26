<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\AttributeType;
use App\Attribute;
use App\AttributeSubcategory;

class OwnerSubcategoryController extends Controller
{
    public function getShowAll()
    {
        $subcategories = Subcategory::all();
        foreach ($subcategories as $cat) {
            $cat['cat_name'] = $cat->category->name;
        }
        return view('owner_dashboard.subcategories.all', compact('subcategories'));
    }

    public function getView($id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory) {
            return view('owner_dashboard.subcategories.view', compact('subcategory'));
        }
        abort(404);
    }

    public function getCreate()
    {
       // return $request->url(); 
        $categories = Category::get();
        return view('owner_dashboard.subcategories.create', compact('categories'));
    }

    public function postStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30|unique:subcategories',
            'category_id' => 'required|exists:categories,id'
        ]);

        $arr_product = [
            'name' => $request['name'],
            'category_id' => $request['category_id'],
        ];

        $subcategory = Subcategory::create($arr_product);

        return redirect()->route('manage.subcategory.all')->withMessage(__('translations.subcategory_created_succ'));
    }

    public function getEditCategory($id)
    {
        $subcategory = Subcategory::find($id);
        if (!$subcategory) {            
            return redirect()->route('manage.subcategory.all')->withErrors(__('translations.subcategory_not_found'));
        }
            $categories = Category::get();
            return view('owner_dashboard.subcategories.edit', compact('categories', 'subcategory'));
    }

    public function postEditCategory(Request $request, $id)
    {
         $subcategory = Subcategory::find($id);
        if (!$subcategory) {            
            return redirect()->route('manage.subcategory.all')->withErrors(__('translations.subcategory_not_found'));
        }

        $this->validate($request, [
            'name' => 'required|string|max:30|unique:subcategories,name,'.$subcategory->id,   
            'category_id' => 'required|exists:categories,id',           
        ]);

        $arr_product = [
            'name'        => $request['name'],
            'category_id' => $request['category_id'],
        ];

        $old_name        = $subcategory->name;
        $old_category_id = $subcategory->category_id;
        $new_name        = $request->name; 
        $new_category_id = $request->category_id; 

        if ($old_name == $new_name && $old_category_id == $new_category_id) {
            return redirect()->route('manage.subcategory.all')->withMessage(__('translations.data_no_changed'));
         } 
         else
         {
            $subcategory->update($arr_product);   
            $latestCategory_id = $subcategory->category_id;   
            $subProducts = $subcategory->products;   
            foreach ($subProducts as $subProduct) 
            {
                   $subProduct->update(['category_id' => $latestCategory_id]);
            }   
            return redirect()->route('manage.subcategory.all')->withMessage(__('translations.subcategory_updated_succ'));
         }  
    }

    public function getDeleteCategory($id)
    {
        $subcategory = Subcategory::find($id);
        if (!$subcategory) {            
            return redirect()->route('manage.subcategory.all')->withErrors(__('translations.subcategory_not_found'));
        }
            $subcategory->products()->delete();
            $subcategory->delete();
            return redirect()->route('manage.subcategory.all')->withMessage(__('translations.subcategory_deleted_succ'));
    }
}
