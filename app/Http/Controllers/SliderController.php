<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = " Danh sách Slider";
        $sliders = Slider::query()->get();
        return view('admin.components.sliders.index', compact('sliders', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm Slider";
        return view('admin.components.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->all());
            $params['status'] = $request->has('status') ? 1 : 0;
            if ($request->hasFile('url')) {
                $filpath = $request->file('url')->store('uploads/sliders', 'public');
                $array = [
                    "url" => $filpath,
                    "description" => $request->description,
                    "date_start" => $request->date_start,
                    "date_end" => $request->date_end,
                    "status" => 1

                ];
            } else {
                $array = [
                    "url" => '',
                    "description" => $request->description,
                    "date_start" => $request->date_start,
                    "date_end" => $request->date_end,
                    "status" => 1

                ];
            }
            Slider::create($array);
            return redirect()->route('sliders.index')->with('msg', 'Thêm slider  thành công');
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
    public function edit(string $id)
    {
        $title = "Cập nhật slider";
        $sliders = Slider::findOrFail($id);
        return view('admin.components.sliders.edit', compact('sliders','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            // dd($request);
            $params = $request->post();
            $sliders = Slider::findOrFail($id);
            if ($request->hasFile('url')) {
                if ($sliders->url && Storage::disk('public')->exists('uploads/sliders')) {
                    Storage::disk('public')->delete($sliders->url);
                }
                $filpath = $request->file('url')->store('uploads/sliders', 'public');
                $array = [
                    "url" => $filpath,
                    "description" => $request->description,
                    "date_start" => $request->date_start,
                    "date_end" => $request->date_end,
                    "status" => $params['status']

                ];
            } else {
                $array = [
                    "url" => $sliders->url,
                    "description" => $request->description,
                    "date_start" => $request->date_start,
                    "date_end" => $request->date_end,
                    "status" => $params['status'],

                ];
            }
            $sliders->update($array);
            return redirect()->route('sliders.index')->with('msg', 'Thêm slider  thành công');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            $slider->delete();
            if ($slider->url && Storage::disk('public')->exists('uploads/sliders')) {
                Storage::disk('public')->delete($slider->url);
            }
            return back()->with('delete', 'Xóa slider thành công!');

        } else {
            return back()->with('error', 'slider không tồn tại!');
        }
    }
}
