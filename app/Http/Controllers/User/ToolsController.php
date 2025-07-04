<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ToolsController extends Controller
{
    public function index()
    {
        return view('user.tools.index');
    }

    public function dateToDate()
    {
        return view('user.tools.date-to-date');
    }

    public function addSubtractDate()
    {
        return view('user.tools.add-subtract-date');
    }

    public function ageCalculator()
    {
        return view('user.tools.age-calculator');
    }

    public function timeZones()
    {
        return view('user.tools.time-zones');
    }

    public function currencyConverter()
    {
        return view('user.tools.currency-converter');
    }

    public function calculateDateDifference(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'include_time' => 'nullable'
            ]);

            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $diff = $startDate->diff($endDate);

            $result = [
                'years' => $diff->y,
                'months' => $diff->m,
                'days' => $diff->d,
                'total_days' => $startDate->diffInDays($endDate),
                'total_weeks' => $startDate->diffInWeeks($endDate),
                'total_months' => $startDate->diffInMonths($endDate),
                'total_years' => $startDate->diffInYears($endDate)
            ];

            if ($request->include_time) {
                $result['hours'] = $diff->h;
                $result['minutes'] = $diff->i;
                $result['seconds'] = $diff->s;
                $result['total_hours'] = $startDate->diffInHours($endDate);
                $result['total_minutes'] = $startDate->diffInMinutes($endDate);
            }

            return response()->json($result);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while calculating date difference',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addSubtractFromDate(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'years' => 'nullable|integer|min:0',
                'months' => 'nullable|integer|min:0',
                'weeks' => 'nullable|integer|min:0',
                'days' => 'nullable|integer|min:0',
                'hours' => 'nullable|integer|min:0',
                'minutes' => 'nullable|integer|min:0',
                'seconds' => 'nullable|integer|min:0'
            ]);

            $date = Carbon::parse($request->date);

            // Get values and their operations
            $units = ['years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'];
            
            foreach ($units as $unit) {
                $value = (int) $request->get($unit, 0); // Cast to integer
                $operation = $request->get($unit . '_operation', 'add');
                
                if ($value > 0) {
                    $methodName = $operation === 'add' ? 'add' . ucfirst($unit) : 'sub' . ucfirst($unit);
                    $date = $date->$methodName($value);
                }
            }

            return response()->json([
                'result_date' => $date->format('Y-m-d H:i:s'),
                'formatted_date' => $date->format('l, F j, Y g:i A'),
                'day_of_week' => $date->format('l')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while calculating date',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function calculateAge(Request $request)
    {
        try {
            $request->validate([
                'birth_date' => 'required|date|before_or_equal:today',
                'calculation_date' => 'nullable|date|after_or_equal:birth_date'
            ]);

            $birthDate = Carbon::parse($request->birth_date);
            $calculationDate = $request->calculation_date ? Carbon::parse($request->calculation_date) : Carbon::now();

            $diff = $birthDate->diff($calculationDate);
            $nextBirthday = $birthDate->copy()->year($calculationDate->year);
            
            if ($nextBirthday->lt($calculationDate)) {
                $nextBirthday->addYear();
            }

            $daysToNextBirthday = $calculationDate->diffInDays($nextBirthday);
            $monthsToNextBirthday = $calculationDate->diffInMonths($nextBirthday);

            $result = [
                'age' => [
                    'years' => $diff->y,
                    'months' => $diff->m,
                    'days' => $diff->d
                ],
                'total_days' => $birthDate->diffInDays($calculationDate),
                'total_weeks' => $birthDate->diffInWeeks($calculationDate),
                'total_months' => $birthDate->diffInMonths($calculationDate),
                'total_years' => $birthDate->diffInYears($calculationDate),
                'next_birthday' => [
                    'date' => $nextBirthday->format('Y-m-d'),
                    'days_remaining' => $daysToNextBirthday,
                    'months_remaining' => $monthsToNextBirthday
                ]
            ];

            return response()->json($result);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while calculating age',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getExchangeRates(Request $request)
    {
        $request->validate([
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3',
            'amount' => 'required|numeric|min:0'
        ]);

        $apiKey = '1cda016580278401b496ff32';
        $from = strtoupper($request->from);
        $to = strtoupper($request->to);
        $amount = $request->amount;

        try {
            $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/pair/{$from}/{$to}");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['result'] === 'success') {
                    $rate = $data['conversion_rate'];
                    $convertedAmount = $amount * $rate;
                    
                    return response()->json([
                        'success' => true,
                        'from' => $from,
                        'to' => $to,
                        'rate' => $rate,
                        'amount' => $amount,
                        'converted_amount' => round($convertedAmount, 2),
                        'last_updated' => $data['time_last_update_utc'] ?? null
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Currency conversion failed'
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'API request failed'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error connecting to currency API'
            ], 500);
        }
    }

    public function getAllRates(Request $request)
    {
        $apiKey = '1cda016580278401b496ff32';
        $baseCurrency = strtoupper($request->get('base', 'USD'));

        try {
            $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$baseCurrency}");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['result'] === 'success') {
                    return response()->json([
                        'success' => true,
                        'base' => $baseCurrency,
                        'rates' => $data['conversion_rates'],
                        'last_updated' => $data['time_last_update_utc']
                    ]);
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch exchange rates'
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error connecting to currency API'
            ], 500);
        }
    }

    // Debug endpoint for testing
    public function debugTest(Request $request)
    {
        return response()->json([
            'message' => 'Debug endpoint working',
            'request_data' => $request->all(),
            'carbon_test' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
