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
        $contracts = Contract::with('contractStatus')->latest('id')->paginate(10);
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
            // Create contract and save file path
            Contract::create([
                'contract_number' => $contract['contract_number'],
                'customer_name' => $contract['customer_name'],
                'customer_email' => $contract['customer_email'],
                'number_phone' => $contract['number_phone'],
                'total_amount' => $contract['total_amount'],
                'contract_status_id' => '1',
                'note' => $contract['note'],
                'file' => $filePath,
            ]);

            return redirect()
                ->route('contract.index')
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
    public function edit(Contract $contract_number)
    {
        $data = Contract::where('contract_number', $contract_number)->firstOrFail();
        dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $data = $request->validated();
        $filePath = null;

        try {
            if ($request->hasFile('file')) {
                // Delete the old file if it exists
                if ($contract->file && Storage::disk('public')->exists($contract->file)) {
                    Storage::disk('public')->delete($contract->file);
                }
                // Store the new file
                $filePath = $request->file('file')->store('contracts', 'public');
            }

            // Update contract with new data
            $contract->update([
                'contract_number' => $data['contract_number'],
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'number_phone' => $data['number_phone'],
                'total_amount' => $data['total_amount'],
                'note' => $data['note'],
                'file' => $filePath ? $filePath : $contract->file, // Use old file if no new file is uploaded
            ]);

            return redirect()
                ->route('contract.index')
                ->with('success', 'Cập nhật hợp đồng thành công!');
        } catch (Exception $exception) {
            // Handle exception
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
