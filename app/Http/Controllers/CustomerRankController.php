<?php

namespace App\Http\Controllers;

use App\Models\Customer_rank;
use App\Http\Requests\StoreCustomer_rankRequest;
use App\Http\Requests\UpdateCustomer_rankRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerRankController extends Controller
{

    const PATH_VIEW = 'admin.components.CustomerRanks.';

    public function index()
    {
        $data = DB::table('customer_ranks')->get();
        return view(self::PATH_VIEW . 'index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . 'create', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'discount' => 'required|min:1',
            'amount' => 'required|min:1',
        ]);
        $data = [
            'name' => $request->name,
            'discount' => $request->discount,
            'amount' => $request->amount,
        ];
        // dd($data);  
        DB::table('customer_ranks')->insert($data);

    return redirect()->route('customer_ranks.index')->with('success', 'Giảm giá đã được thêm thành công.');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer_rank $customer_rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {

        $data = Customer_rank::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'discount' => 'required|min:1',
            'amount' => 'required|min:1',
        ]);
        $data = [
            'name' => $request->name,
            'discount' => $request->discount,
            'amount' => $request->amount,
        ];
        DB::table('customer_ranks')
        ->where('id', $id)
        ->update($data);

    return redirect()->route('customer_ranks.index')->with('success', 'Giảm giá đã được cập nhật thành công.');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // DB::table('customer_ranks')
        // ->where('id', $id)
        // ->delete();
        // return redirect()->route('customer_ranks.index')->with('success', 'Giảm giá đã được xóa thành công.');

    }
}
