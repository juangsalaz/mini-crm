<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        $data['products'] = DB::table('products')->select('products.*', 'brands.name as name_brand', 'brands.id as id_brand')
                                                ->leftJoin('brands', 'brands.id', 'products.id_brand')
                                                ->paginate(10);

        return view('product.index', $data);
    }

    public function add()
    {
        $data['brands'] = DB::table('brands')->get();

        return view('product.add', $data);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name'  => 'required',
            'model' => 'required',
        ]);

        DB::table('products')->insert([
            'name'       => $request->name,
            'model'    => $request->model,
            'id_brand'   => $request->id_brand,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('product');
    }

    public function edit($id)
    {
        $data['product'] = DB::table('products')->where('id', $id)->get();
        $data['brands'] = DB::table('brands')->get();

        return view('product.edit', $data);
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name'  => 'required',
            'model' => 'required',
        ]);

        DB::table('products')->where('id', $id)->update([
            'name'       => $request->name,
            'model'      => $request->model,
            'id_brand'   => $request->id_brand,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('product');
    }

    public function delete($id)
    {
        DB::table('products')->where('id', $id)->delete();
    }
}
