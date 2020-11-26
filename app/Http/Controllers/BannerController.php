<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bannering;
use App\BanneringType;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Bannering::all();
        return view('owner_dashboard.banner.all',compact('banners'));
    }

    public function create()
    {
      $bannerTypes = BanneringType::all();
      return view('owner_dashboard.banner.create',compact('bannerTypes'));
    }

    public function store(Request $request)
    {
        // return $request;

        $this->validate($request,[
          'bannering_type_id' => 'required|exists:bannering_types,id',
          'title' => 'required|unique:bannerings|max:30',
          'full_image' => 'required|image',
          'banner_link' => 'required|url',
        ]);


        $arr_request['title'] = $request->title;
        $arr_request['bannering_type_id'] = $request['bannering_type_id'];
        $arr_request['banner_link'] = $request->banner_link;

        /*if(isset($request->banner_link))
        {
        	$this->validate($request,[
                'banner_link' => 'url',
            ]);
          $arr_request['banner_link'] = $request->banner_link;
        }*/

        if ($request->image) {
            $fullImage = $request->file('full_image');
            $fullImageName = sha1($fullImage->getClientOriginalName() . time()) . '.' . $fullImage->getClientOriginalExtension();
            $destinationPath = public_path() . '/shop_images/banners//';
            $request->file('full_image')->move($destinationPath, $fullImageName);
            $image = $request->input('image');
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = time() . '_' . uniqid() . '.png';
            \File::put(public_path() . '/shop_images/banners//'. $imageName, base64_decode($image));
            // $arr_request[
            //   'image' => $imageName,
            //   'full_image' => $fullImageName,
            // ];
            $arr_request['image'] = $imageName;
            $arr_request['full_image'] = $fullImageName;
        }

        $banner = Bannering::create($arr_request);
        return redirect()->route('manage.banners')->withMessage(__('translations.banner_created_successfully'));;
    }

    public function show($id)
    {
        $banner = Bannering::find($id);
        return view('owner_dashboard.banner.show',compact('banner'));
    }

    public function edit($id)
    {
        $banner = Bannering::find($id);
        $bannerTypes = BanneringType::get();
        return view('owner_dashboard.banner.edit',compact('banner','bannerTypes'));
    }

    public function update(Request $request, $id)
    {
       $banner = Bannering::find($id);
      $this->validate($request,[
        'title' => 'required|max:255|unique:bannerings,title,'.$banner->id,
        'bannering_type_id' => 'required|exists:bannering_types,id',
        'full_image' => 'image',
        'banner_link' => 'required|url',
      ]);


      $arr_request['title'] = $request['title'];
      $arr_request['banner_link'] = $request->banner_link;
      if(isset($request->bannering_type_id))
      {
        $arr_request['bannering_type_id'] = $request->bannering_type_id;
      }
     
     /* if(isset($request->banner_link))
      {
      	$this->validate($request,[
                'banner_link' => 'url',
            ]);
        $arr_request['banner_link'] = $request->banner_link;
      }*/


      if ($request->hasFile('full_image')) {
          $fullImage = $request->file('full_image');
          $fullImageName = sha1($fullImage->getClientOriginalName() . time()) . '.' . $fullImage->getClientOriginalExtension();
          $destinationPath = public_path() . '/shop_images/banners//';
          $request->file('full_image')->move($destinationPath, $fullImageName);
          $image = $request->input('image');
          $image = str_replace('data:image/png;base64,', '', $image);
          $image = str_replace(' ', '+', $image);
          $imageName = time() . '_' . uniqid() . '.png';
          \File::put(public_path() . '/shop_images/banners//'. $imageName, base64_decode($image));
          $arr_request['image'] = $imageName;
          $arr_request['full_image'] = $fullImageName;
      }

      $banner = Bannering::find($id);
      $banner->update($arr_request);
      return redirect()->route('manage.banners')->withMessage(__('translations.banner_updated_successfully'));

    }

    public function destroy($id)
    {
        $banner = Bannering::destroy($id);
        return redirect()->route('manage.banners')->withMessage(__('translations.banner_deleted_successfully'));
    }
}
