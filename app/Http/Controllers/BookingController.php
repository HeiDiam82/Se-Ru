<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // User endpoints
    public function store(Request $request)
    {
        $request->validate([
            'ruko_id'         => 'required|exists:ruko,ruko_id',
            'duration_months' => 'required|integer|min:1',
            'usage_plan'      => 'required|string',
            'ktp_proof'       => 'nullable',
            'transfer_proof'  => 'nullable',
        ]);

        // KTP — bisa file upload atau URL (jika sudah ada link)
        if ($request->hasFile('ktp_proof')) {
            $ktpPath = $request->file('ktp_proof')->store('ktp', 'public');
        } else {
            $ktpPath = $request->input('ktp_proof');
        }

        // Bukti Transfer — bisa file upload atau URL
        if ($request->hasFile('transfer_proof')) {
            $transferPath = $request->file('transfer_proof')->store('transfer_proofs', 'public');
        } else {
            $transferPath = $request->input('transfer_proof');
        }

        Booking::create([
            'user_id'         => Auth::id(),
            'ruko_id'         => $request->ruko_id,
            'duration_months' => $request->duration_months,
            'usage_plan'      => $request->usage_plan,
            'ktp_proof'       => $ktpPath,
            'transfer_proof'  => $transferPath,
            'status'          => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan sewa berhasil dikirim dan sedang menunggu validasi admin.');
    }

    public function userDashboard()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('ruko')->orderBy('created_at', 'desc')->get();
        return view('user.dashboard', compact('bookings'));
    }

    // Admin endpoints
    public function adminIndex(Request $request)
    {
        $query = Booking::with(['user', 'ruko'])->orderBy('created_at', 'desc');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function adminShow(Booking $booking)
    {
        $booking->load(['user', 'ruko']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $booking->update(['status' => $request->status]);

        if ($request->status === 'approved') {
            $booking->ruko->update(['status' => 'rented']);
        }

        // Jika di-reject, kembalikan status ruko ke available (jika tidak ada booking approved lain)
        if ($request->status === 'rejected') {
            $hasOtherApproved = Booking::where('ruko_id', $booking->ruko_id)
                ->where('status', 'approved')
                ->exists();
            if (!$hasOtherApproved) {
                $booking->ruko->update(['status' => 'available']);
            }
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}
