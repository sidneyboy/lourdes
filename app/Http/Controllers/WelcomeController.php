<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\About;
use App\Models\Carousel;
use App\Models\Contact_us;
use App\Models\Reservations;
use App\Mail\lacastilla_mail;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $room = Accomodation::where('type_id', 'room')->where('status', 'activated')->get();
        $meals = Accomodation::where('type_id', 'meals')->where('status', 'activated')->get();
        $liqour = Accomodation::where('type_id', 'liqour')->where('status', 'activated')->get();

        $gallery = Accomodation::where('status', 'activated')->get();

        $carousel = Carousel::where('status', 'active')->get();
        $carousel_first = Carousel::where('status', 'active')->orderBy('id', 'desc')->limit(1)->first();

        $about = About::orderBy('id', 'desc')->limit(1)->first();

        $reservations_dates = Reservations::where('status', 'Paid Downpayment')
            ->orWhere('status', 'Partial Payment')
            ->orWhere('status', 'Paid')
            ->get();


        // $reserved_dates = array();


        if (count($reservations_dates) != 0) {
            foreach ($reservations_dates as $key => $value) {
                $reserved_dates[] = $value->date_from;
            }
        } else {
            $reserved_dates[] = '';
        }

        return view('index', [
            'reserved_dates' => $reserved_dates,
            'room' => $room,
            'carousel_first' => $carousel_first,
            'carousel' => $carousel,
            'about' => $about,
            'gallery' => $gallery,
            'meals' => $meals,
            'liqour' => $liqour,
        ]);
    }

    public function book_now(Request $request)
    {
        //return $request->input();
        $date_from = date('Y-m-d', strtotime($request->input('dates')));
        $date_to = '2022-01-01';
        return view('book_now')
            ->with('date_from', $date_from)
            ->with('date_to', $date_to);
    }

    public function contact_us_process(Request $request)
    {

        $new = new Contact_us([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'message' => $request->input('message'),
            'status' => 'Pending',
        ]);

        $new->save();

        return redirect('welcome')->with('success', 'Success');
    }

    public function reservation_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $imageName = time() . rand(1, 99) . '.' . $request->images->extension();
        $request->images->move(public_path('storage'), $imageName);

        $new = new Reservations([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'receipt' => $imageName,
            'date_from' => $request->input('date_from'),
            'date' => $date,
            'status' => 'Pending',
        ]);

        $new->save();

        return redirect('welcome')->with('success', 'Thank you for choosing Nikan Resort');
    }
}
