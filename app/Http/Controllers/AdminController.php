<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruko;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_ruko'      => Ruko::count(),
            'available_ruko'  => Ruko::where('status', 'available')->count(),
            'rented_ruko'     => Ruko::where('status', 'rented')->count(),
            'total_bookings'  => Booking::count(),
            'pending_bookings'=> Booking::where('status', 'pending')->count(),
            'approved_bookings'=> Booking::where('status', 'approved')->count(),
            'rejected_bookings'=> Booking::where('status', 'rejected')->count(),
            'total_users'     => User::where('role', 'user')->count(),
            'monthly_revenue' => Booking::where('bookings.status', 'approved')
                ->join('ruko', 'bookings.ruko_id', '=', 'ruko.ruko_id')
                ->sum(\Illuminate\Support\Facades\DB::raw('ruko.price * bookings.duration_months')),
        ];

        $recentBookings = Booking::with(['user', 'ruko'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentRukos = Ruko::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentRukos'));
    }
}
