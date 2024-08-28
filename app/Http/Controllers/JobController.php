<?php

namespace App\Http\Controllers;

use App\Services\EmployeeManagement\Applicant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    public function __construct(private readonly Applicant $applicant)
    {
    }
    
    public function apply(Request $request): JsonResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Process the job application using the Applicant service
        $data = $this->applicant->applyJob($validatedData);
        
        return response()->json([
            'data' => $data
        ]);
    }
}