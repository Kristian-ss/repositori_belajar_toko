<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\orders;
use Illuminate\Support\Facades\Validator;
class ordersController extends Controller
{
  public function show(){
  $data_orders = orders::join('customers', 'customers.id_customer', 'orders.id_customer')->get();
  return Response()->json($data_orders);
}
public function detail($id_order){
    if(orders::where('id_order', $id_order)->exists()){
      $data_orders = orders::join('customers', 'customers.id_customer', 'orders.id_customer')->where('orders.id_order', '=', $id_order)->get();
      return Response()->json($data_orders);
    }
    else{
      return Response()->json(['message' => 'Tidak ditemukan']);
    }
}

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
              'nama_order' => 'required',
              'tanggal_order' => 'required',
              'alamat_order' => 'required',
              'id_customer' => 'required'

            ]
        );
      if($validator->fails()) {
        return Response()->json($validator->errors());
      }

      $simpan = orders::create([
        'nama_order' => $request->nama_order,
        'tanggal_order' => $request->tanggal_order,
        'alamat_order' => $request->alamat_order,
        'id_customer' => $request->id_customer
      ]);

      if($simpan){
        return Response()->json(['status'=>1]);
      }
      else{
        return Response()->json(['status'=>0]);
      }
    }
    public function update($id_order, Request $request)
    {
        $validator=Validator::make($request->all(),
            [
              'nama_order' => 'required',
              'tanggal_order' => 'required',
              'alamat_order' => 'required',
              'id_customer' => 'required'

            ]
        );
      if($validator->fails()) {
        return Response()->json($validator->errors());
      }

      $ubah = orders::where('id_order', $id_order)->update([
        'nama_order' => $request->nama_order,
        'tanggal_order' => $request->tanggal_order,
        'alamat_order' => $request->alamat_order,
        'id_customer' => $request->id_customer
      ]);

      if($ubah){
        return Response()->json(['status'=>1]);
      }
      else{
        return Response()->json(['status'=>0]);
      }
    }
    public function destroy($id_order)
 {
 $hapus = orders::where('id_order', $id_order)->delete();
 if($hapus) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }

  }
