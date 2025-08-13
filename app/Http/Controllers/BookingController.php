<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;


class BookingController extends Controller
{  
       public function __construct(){
        $this->middleware(['permission:bookings.view'])->only('List');
        $this->middleware(['permission:bookings.add'])->only('Store');
        $this->middleware(['permission:bookings.update'])->only('Update');
        $this->middleware(['permission:bookings.delete'])->only('Delete');

       }
    

       public function FormRegister(){
         $services = Service::all();
         $branches  = Branch::all();
        return view('Frontend.index',compact('services','branches'));
    }

    public function alert(){
          
         
        return view('Frontend.Alert');
    }

public function List(Request $request)
{
    $services = Service::all();
    $branches = Branch::all();
    $time = $request->input('time', 'this_week');

    if ($time === 'last_week') {
        $start = Carbon::now()->subWeek()->startOfWeek();
        $end = Carbon::now()->subWeek()->endOfWeek();
    } else {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
    }
    $confirmedBookings = Booking::where('status', 'confirmed')
        ->whereBetween('created_at', [$start, $end])
        ->count();
    $bookings = Booking::orderBy('created_at', 'desc')
        ->paginate(50) 
        ->withQueryString();

    return view('Backend.Booking.List', compact('bookings', 'services', 'branches', 'confirmedBookings', 'time'));
}

    public function Create(){
                        $services = Service::all();
                        $branches  = Branch::all();
                        return view('Backend.Booking.Create',compact('services','branches'));
                    }

public function Store(Request $request)
{ 
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'branch_id' => 'required|exists:branches,id',
        'service_id' => 'required|exists:services,id',
        'know_through' => 'required|in:1,2,3,4,5,6',
        'booking_date' => 'required|date',
        'booking_time' => 'required|date_format:H:i',
        'payment' => 'required|numeric|min:0',
        'status' => 'required|in:confirmed,processing,cancel',
        'note' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);

    $booking = new Booking();
    $booking->user_id = auth()->id();
    $booking->name = $request->name;
    $booking->phone = $request->phone;
    $booking->branch_id = $request->branch_id;
    $booking->service_id = $request->service_id;
    $booking->know_through = $request->know_through;
    $booking->booking_date = $request->booking_date;
    $booking->booking_time = $request->booking_time;
    $booking->status = $request->status;
    $booking->note = $request->note;
    $booking->payment = $request->payment;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('Booking'), $filename);
        $booking->image = $filename;
    }

    $booking->save();

        // ✅ Send Telegram notification
    $botToken = config('services.telegram.bot_token');
    $chatId   = config('services.telegram.chat_id');

    if ($botToken && $chatId) {
$message = "🆕 <b>New Booking Registered</b>\n\n"
    . "👤 <b>Name:</b> {$booking->name}\n\n"
    . "📞 <b>Phone:</b> {$booking->phone}\n\n"
    . "⏰ <b>Time:</b> {$booking->booking_time}\n\n"
    . "🛠️ <b>Service:</b> {$booking->service->name}\n\n"
    . "📍 <b>Branch:</b> {$booking->branch->name}";


        Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id'    => $chatId,
            'text'       => $message,
            'parse_mode' => 'HTML'
        ]);
    }

}


    public function formupdate($id){
                        $booking = Booking::findOrFail($id);
                        $services = Service::all();
                        $branches  = Branch::all();
        return view('Backend.Booking.Update',compact('booking','services','branches'));
    }  
    
    
    public function update(Request $request, $id)
{
                        $request->validate([
                            'name' => 'required|string|max:255',
                            'phone' => 'required|string|max:20',
                            'branch_id' => 'required|exists:branches,id',
                            'service_id' => 'required|exists:services,id',
                            'know_through' => 'required|in:1,2,3,4,5,6',
                            'booking_date' => 'required|date',
                            'booking_time' => 'required',
                            'status' => 'required|in:confirmed,processing,cancel',
                            'note' => 'nullable|string',
                            'payment'=>'required',
                            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
                        ]);

                        try {
                            $booking = Booking::findOrFail($id); // Find the existing booking

                            $booking->user_id = auth()->id(); 
                            $booking->name = $request->name;
                            $booking->phone = $request->phone;
                            $booking->branch_id = $request->branch_id;
                            $booking->service_id = $request->service_id;
                            $booking->know_through = $request->know_through;
                            $booking->booking_date = $request->booking_date;
                            $booking->booking_time = $request->booking_time;
                            $booking->status = $request->status;
                            $booking->note = $request->note;
                            $booking->payment = $request->payment;

                            if ($request->hasFile('image')) {
                                // Optional: delete old image file
                                if ($booking->image && file_exists(public_path('uploads/bookings/' . $booking->image))) {
                                    unlink(public_path('Booking/' . $booking->image));
                                }

                                $file = $request->file('image');
                                $extension = $file->getClientOriginalExtension();
                                $filename = time() . '_' . uniqid() . '.' . $extension;
                                $file->move(public_path('Booking'), $filename);
                                $booking->image = $filename;
                            }

                            $booking->save();

                            return redirect()->route('list.booking')->with('success', 'Booking updated successfully.');
                        } catch (\Exception $e) {
                            return back()->withInput()->with('error', 'Error updating booking: ' . $e->getMessage());
                }
}
    public function view($id)
{
                        $booking = Booking::findOrFail($id);
                        $services = Service::all();
                        $branches = Branch::all();

                        return view('Backend.Booking.View', compact('booking', 'services', 'branches'));
}


}