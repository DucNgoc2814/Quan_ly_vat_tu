<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Http\Request;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = " Danh sách Slider";
        $sliders = Slider::query()->get();
        return view('admin.compoents.sliders.index',compact('sliders','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Thêm Slider";
        return view('admin.compoents.sliders.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request  $request)
    {
        if($request->isMethod('POST')){
            // dd($request);
            $params['status'] = $request->has('status') ? 1 : 0;
            if($request->hasFile('url_')){
                $filpath=$request->file('url_')->store('uploads/sliders','public');
                $array =[
                    "url_"=>$filpath,
                    "description" => $request->description,
                    "date_start" => $request->date_start,
                    "date_end" => $request->date_end,
                    "status"=>1

                    ];
            }else{
                $array =[
                    "url_"=>'',
                    "description" => $request->description,
                    "date_start" => $request->date_start,
                    "date_end" => $request->date_end,
                    "status"=>1
                    
                    ];
            }
            Slider:: create($array);
            return redirect()->route('sliders.index')->with('msg','Thêm slider  thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
