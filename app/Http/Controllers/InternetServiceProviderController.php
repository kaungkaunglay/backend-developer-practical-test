<?php

namespace App\Http\Controllers;

use App\Factories\InternetServiceProviderFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InternetServiceProviderController extends Controller
{
    public function getInvoiceAmount(Request $request, string $provider)
    {
        try {
            $month = $request->input('month', 1);
            if (!is_numeric($month) || $month < 0) {
                return response()->json([
                    'status'  => Response::HTTP_BAD_REQUEST,
                    'message' => 'Invalid month value',
                ], Response::HTTP_BAD_REQUEST);
            }

            $serviceProvider = InternetServiceProviderFactory::create($provider);
            $serviceProvider->setMonth((int)$month);
            $amount = $serviceProvider->calculateTotalAmount();

            return response()->json([
                'status'  => Response::HTTP_OK,
                'amount'  => $amount,
            ], Response::HTTP_OK);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'status'  => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}