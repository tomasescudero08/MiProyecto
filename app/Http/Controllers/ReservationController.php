<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Mail\ReservationConfirmationMail;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('room')->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create(Room $room)
    {
        return view('reservations.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($request->room_id);

        $checkIn = new \DateTime($request->check_in);
        $checkOut = new \DateTime($request->check_out);
        $nights = $checkIn->diff($checkOut)->days;
        $nights = $nights > 0 ? $nights : 1;

        $pricePerNight = $room->price_per_night ?? $room->price ?? 0;

        $totalPrice = $nights * $pricePerNight;

        $reservation = Reservation::create([
            'room_id' => $request->room_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'special_requests' => $request->special_requests,
        ]);

        try {
            Mail::to($reservation->customer_email)
                ->send(new ReservationConfirmationMail($reservation));
        } catch (\Exception $e) {
        }

        return redirect()->route('reservations.success', $reservation->id)
            ->with('success', '¡Reserva realizada con éxito y correo de confirmación enviado!');
    }

    public function success(Reservation $reservation)
    {
        return view('success', compact('reservation'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('success', 'La reserva ha sido eliminada.');
    }
}
