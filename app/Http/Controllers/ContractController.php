<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract_type;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.contract.';

    public function index()
    {
        $contracts = Contract::with('order', 'contractType', 'contractStatus')->latest('id')->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::query()->pluck('slug', 'id');
        $types = Contract_type::query()->pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('orders', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        $contract = $request->validated();
        $filePath = null;
        try {
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('contracts', 'public');
            }
            $contract['contract_status_id'] = 1;
            // Tạo hợp đồng và lưu đường dẫn file
            Contract::create([
                'name' => $contract['name'],
                'order_id' => $contract['order_id'],
                'contract_type_id' => $contract['contract_type_id'],
                'contract_status_id' => $contract['contract_status_id'],
                'note' => $contract['note'],
                'file' => $filePath,
            ]);

            return redirect()
                ->route('hop-dong.index')
                ->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            dd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        dd($contract);
        $data = Contract::firstOrFail($contract);
        return view(self::PATH_VIEW . __FUNCTION__, compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $brand)
    {
        $data = $request->validated();
        try {
            $brand->update([
                'name' => $data['name'],
                'is_active' => isset($data['is_active']) ? 1 : 0,
            ]);
            return redirect()
                ->route('thuong-hieu.index')
                ->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
