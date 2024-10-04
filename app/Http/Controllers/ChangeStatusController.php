<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangeStatusController extends Controller
{
    public function updateStatus(Request $request)
    {
        $updated = DB::table($request->nameTable)
            ->where('id', $request->id)
            ->update(['is_active' => $request->is_active]);
    }
}
