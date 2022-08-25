<?php

namespace App\Http\Controllers;

use App\Models\Kangaroo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KangarooController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kangaroos'] = Kangaroo::orderBy('id','asc')->paginate(5);
   
        return view('kangaroo', $data);
    }

    /**
     * Display a listing of the resource in grid.
     *
     * @return \Illuminate\Http\Response
     */
    public function grid()
    {
        $data['kangaroos'] = Kangaroo::orderBy('id','asc')->paginate(5);
   
        return view('grid', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|alpha_num",
            'weight' => "required|numeric",
            'height' => "required|numeric",
            'gender' => "required|in:male,female",
            'birthday' => "required|date",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $kangaroo = Kangaroo::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name, 
                'nickname' => $request->nickname,
                'weight' => $request->weight,
                'height' => $request->height,
                'gender' => $request->gender,
                'color' => $request->color,
                'friendliness' => $request->friendliness,
                'birthday' => $request->birthday
            ]
        );

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kangaroo  $kangaroo
     * @return \Illuminate\Http\Response
     */
    public function show(Kangaroo $kangaroo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kangaroo  $kangaroo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = [
            'id' => $request->id
        ];

        $kangaroo = Kangaroo::where($where)->first();
 
        return response()->json($kangaroo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kangaroo  $kangaroo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kangaroo $kangaroo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kangaroo  $kangaroo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kangaroo = Kangaroo::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }

    private function validator($request)
    {
        return $request->validate([
            'name' => "required|alpha_num",
            'weight' => "required|numeric",
            'height' => "required|numeric",
            'gender' => "required|in:male,female",
            'birthday' => "required|date",
        ]);
    }
}
