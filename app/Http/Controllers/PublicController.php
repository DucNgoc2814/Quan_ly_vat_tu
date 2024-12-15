<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Import_order;
use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;
use JWTAuth;
use Session;

class PublicController extends Controller
{

    public function update(Request $request, $type, $id)
    {
        try {
            switch ($type) {
                case 'order':
                    $model = Order::findOrFail($id);
                    break;
                case 'importOrder':
                    $model = Import_order::findOrFail($id);
                    if (!in_array($model->status, [1, 2, 3])) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Không thể thay đổi người phụ trách cho đơn hàng này'
                        ], 403);
                    }
                    break;
                case 'contract':
                    $model = Contract::findOrFail($id);
                    break;
                default:
                    throw new \Exception('Invalid type');
            }

            $model->update([
                'employee_id' => $request->employee_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật người phụ trách thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
