<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Shipment ;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::all();
        return view('owner_dashboard.shipment.index' , compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('owner_dashboard.shipment.create');
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
          'area' => 'required|min:3|max:30|unique:shipments',
          'price' => 'required|numeric|min:1|max:200',
        ]);

        $requestData = $request->all();
        Shipment::create($requestData);
        return redirect()->route('shipment.index')->with('message' , 'تم اضافة الشحن!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);
        return view('owner_dashboard.shipment.edit' , compact('shipment'));
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

      $shipment = Shipment::findOrFail($id);
      $this->validate($request , [
        'area' => 'required|min:3|max:30|unique:shipments,area,' . $shipment->id,
        'price' => 'required|numeric|min:1|max:200',
      ]);

      $requestData = $request->all();
      $shipment->update($requestData);

      return redirect()->route('shipment.index')->with('message' , 'تم تعديل الشحن!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipmemt = Shipment::destroy($id);
        return redirect()->route('shipment.index')->with('message' , 'تم حذف الشحن!');
    }
}
