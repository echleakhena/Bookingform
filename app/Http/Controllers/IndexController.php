<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:dashboard.view'])->only('dashboard');
    }

    public function dashboard()
    {
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('payment');

        // Weekly revenue comparison
        $lastWeekRevenue = Booking::where('status', 'confirmed')
            ->whereBetween('created_at', [
                now()->subWeek()->startOfWeek(),
                now()->subWeek()->endOfWeek()
            ])->sum('payment');

        $thisWeekRevenue = Booking::where('status', 'confirmed')
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->sum('payment');

        $percentIncrease = $lastWeekRevenue > 0
            ? (($thisWeekRevenue - $lastWeekRevenue) / $lastWeekRevenue * 100)
            : ($thisWeekRevenue > 0 ? 100 : 0);


        $todaysBookings = Booking::whereDate('created_at', today())->count();
        $yesterdaysBookings = Booking::whereDate('created_at', today()->subDay())->count();

        $trend = $yesterdaysBookings > 0
            ? (($todaysBookings - $yesterdaysBookings) / $yesterdaysBookings * 100)
            : ($todaysBookings > 0 ? 100 : 0);
        $processingCount = Booking::where('status', 'processing')->count();
        $cancelledCount = Booking::where('status', 'cancel')->count();
        $thisMonthPayment = Booking::whereMonth('created_at', now()->month)
            ->where('status', 'confirmed')->sum('payment');

        $lastMonthPayment = Booking::whereMonth('created_at', now()->subMonth()->month)
            ->where('status', 'confirmed')->sum('payment');

        return view('Backend.Index', compact(
            'thisWeekRevenue', 'lastWeekRevenue',
            'totalRevenue', 'percentIncrease',
            'confirmedBookings', 'processingCount', 'cancelledCount',
            'todaysBookings', 'trend', 'totalBookings',
            'thisMonthPayment', 'lastMonthPayment'
        ));
    }

    public function getChartData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'period' => 'required|in:this_week,last_week,this_month,last_month'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid period'], 400);
        }

        $period = $request->query('period', 'this_week');
        
        switch ($period) {
            case 'last_week':
                $startDate = now()->subWeek()->startOfWeek();
                $endDate = now()->subWeek()->endOfWeek();
                break;
            case 'this_month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'last_month':
                $startDate = now()->subMonth()->startOfMonth();
                $endDate = now()->subMonth()->endOfMonth();
                break;
            default: // this_week
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
        }

        // Generate daily data
        $labels = [];
        $data = [];
        $currentDate = clone $startDate;
        
        while ($currentDate <= $endDate) {
            $labels[] = $currentDate->format('D');
            $data[] = Booking::whereDate('created_at', $currentDate)->count();
            $currentDate->addDay();
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function filterData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'period' => 'required|in:this_week,last_week,this_month,last_month'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $period = $request->input('period');
        $query = Booking::query();

        switch ($period) {
            case 'last_week':
                $query->whereBetween('created_at', [
                    now()->subWeek()->startOfWeek(),
                    now()->subWeek()->endOfWeek()
                ]);
                break;
            case 'this_month':
                $query->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth()
                ]);
                break;
            case 'last_month':
                $query->whereBetween('created_at', [
                    now()->subMonth()->startOfMonth(),
                    now()->subMonth()->endOfMonth()
                ]);
                break;
            default: // this_week
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
        }

        $filteredBookings = $query->get();
        $filteredConfirmedBookings = $filteredBookings->where('status', 'confirmed');

        // Today's bookings trend (always calculated for current day, not filtered period)
        $todaysBookings = Booking::whereDate('created_at', today())->count();
        $yesterdaysBookings = Booking::whereDate('created_at', today()->subDay())->count();
        $trend = $yesterdaysBookings > 0
            ? (($todaysBookings - $yesterdaysBookings) / $yesterdaysBookings * 100)
            : ($todaysBookings > 0 ? 100 : 0);

        return response()->json([
            'todaysBookings' => $todaysBookings,
            'trend' => round($trend, 2),
            'totalRevenue' => $filteredConfirmedBookings->sum('payment'),
            'totalBookings' => $filteredBookings->count(),
            'confirmedBookings' => $filteredConfirmedBookings->count(),
            'processingCount' => $filteredBookings->where('status', 'processing')->count(),
            'cancelledCount' => $filteredBookings->where('status', 'cancel')->count(),
            'thisWeekPayment' => Booking::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('status', 'confirmed')->sum('payment'),
            'lastWeekPayment' => Booking::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
                ->where('status', 'confirmed')->sum('payment'),
            'thisMonthPayment' => Booking::whereMonth('created_at', now()->month)
                ->where('status', 'confirmed')->sum('payment'),
            'lastMonthPayment' => Booking::whereMonth('created_at', now()->subMonth()->month)
                ->where('status', 'confirmed')->sum('payment')
        ]);
    }
}