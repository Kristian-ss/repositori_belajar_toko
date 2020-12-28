<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customers;
use Illuminate\Support\Facades\Validator;
class customersController extends Controller
{
  public function show()
  {
    return customers::all();
  }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
              'nama_customer' => 'required',
              'alamat' => 'required',
              'nomor_telephone' => 'required'

            ]
        );
      if($validator->fails()) {
        return Response()->json($validator->errors());
      }

      $simpan = customers::create([
        'nama_customer' => $request->nama_customer,
        'alamat' => $request->alamat,
        'nomor_telephone' => $request->nomor_telephone
      ]);

      if($simpan){
        return Response()->json(['status'=>1]);
      }
      else{
        return Response()->json(['status'=>0]);
      }
    }
    public function destroy($id_customer)
 {
 $hapus = customers::where('id_customer', $id_customer)->delete();
 if($hapus) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }

  }
