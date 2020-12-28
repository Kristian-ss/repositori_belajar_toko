<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use Illuminate\Support\Facades\Validator;
class productController extends Controller
{
  public function show(){
    $data_product = product::join('orders', 'orders.id_order', 'product.id_order')->get();
    return Response()->json($data_product);
  }
public function detail($id_product){
    if(product::where('id_product', $id_product)->exists()){
      $data_product = product::join('orders', 'orders.id_order', 'product.id_order')->where('product.id_product', '=', $id_product)->get();
      return Response()->json($data_product);
    }
    else{
      return Response()->json(['message' => 'Tidak ditemukan']);
    }
  }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
              'nama_product' => 'required',
              'jumlah_barang' => 'required',
              'id_order' => 'required'

            ]
        );
      if($validator->fails()) {
        return Response()->json($validator->errors());
      }

      $simpan = product::create([
        'nama_product' => $request->nama_product,
        'jumlah_barang' => $request->jumlah_barang,
        'id_order' => $request->id_order
      ]);

      if($simpan){
        return Response()->json(['status'=>1]);
      }
      else{
        return Response()->json(['status'=>0]);
      }
    }
    public function update($id_product, Request $request)
    {
        $validator=Validator::make($request->all(),
            [
              'nama_product' => 'required',
              'jumlah_barang' => 'required',
              'id_order' => 'required'

            ]
        );
      if($validator->fails()) {
        return Response()->json($validator->errors());
      }

    $ubah = product::where('id_product', $id_product)->update([
        'nama_product' => $request->nama_product,
        'jumlah_barang' => $request->jumlah_barang,
        'id_order' => $request->id_order
      ]);

      if($ubah){
        return Response()->json(['status'=>1]);
      }
      else{
        return Response()->json(['status'=>0]);
      }
    }
    public function destroy($id_product)
 {
 $hapus = product::where('id_product', $id_product)->delete();
 if($hapus) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }

  }
