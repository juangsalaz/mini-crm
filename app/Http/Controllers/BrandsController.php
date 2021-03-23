<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function index()
    {
        $data['brands'] = DB::table('brands')->paginate(10);

        return view('brand.index', $data);
    }

    public function add()
    {
        return view('brand.add');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name' => 'required',
        ]);

        DB::table('brands')->insert([
            'name'       => $request->name,
            'website'    => $request->website,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('brand');
    }

    public function edit($id)
    {
        $data['brand'] = DB::table('brands')->where('id', $id)->get();

        return view('brand.edit', $data);
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name' => 'required',
        ]);

        DB::table('brands')->where('id', $id)->update([
            'name'       => $request->name,
            'website'    => $request->website,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('brand');
    }

    public function delete($id)
    {
        DB::table('brands')->where('id', $id)->delete();
    }
}
