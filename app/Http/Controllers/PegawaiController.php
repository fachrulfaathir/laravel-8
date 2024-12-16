<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;







class PegawaiController extends Controller
{
       /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table posts
        $pegawai = Pegawai::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $pegawai
        ], 200);

    }

         /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $pegawai = Pegawai::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $pegawai
        ], 200);

    }

     /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
            'alamat' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $pegawai = Pegawai::create([
            'nama'     => $request->nama,
            'alamat'   => $request->alamat
        ]);

        //success save to database
        if($pegawai) {

            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data'    => $pegawai
            ], 201);

        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
        ], 409);

    }

       /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, pegawai $post)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
            'alamat' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $pegawai = Pegawai::findOrFail($post->id);

        if($pegawai) {

            //update post
            $pegawai->update([
                'nama'     => $request->nama,
                'alamat'   => $request->alamat
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post Updated',
                'data'    => $pegawai
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);

    }

    public function destroy($id)
    {
        //find post by ID
        $pegawai = Pegawai::findOrfail($id);

        if($pegawai) {

            //delete post
            $pegawai->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
    }
}


