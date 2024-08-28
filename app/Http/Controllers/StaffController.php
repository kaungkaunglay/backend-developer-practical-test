<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    public function __construct(private readonly Staff $staff)
    {
    }
    
    public function payroll(Request $request): JsonResponse
    {
        // Optionally, validate the request data if needed
        // $validatedData = $request->validate([
        //     'employee_id' => 'required|integer',
        // ]);

        // Process the payroll using the Staff service
        $data = $this->staff->salary();
    
        return response()->json([
            'data' => $data
        ]);
    }
}