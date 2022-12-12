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
        $room = Accomodation::where('type_id', 'room')->get();
        $meals = Accomodation::where('type_id', 'meals')->get();
        $liqour = Accomodation::where('type_id', 'liqour')->get();

        $gallery = Accomodation::get();

        $carousel = Carousel::where('status', 'active')->get();
        $carousel_first = Carousel::where('status', 'active')->orderBy('id', 'desc')->limit(1)->first();

        $about = About::orderBy('id', 'desc')->limit(1)->first();
        return view('index', [
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
        $date_from_checker = date('Y-m-d', strtotime($request->input('dates')));
        $checker = Reservations::where('date_from', $date_from_checker)
            ->where('status', '!=', 'Pending')
            ->count();

        if ($checker == 0) {
            $date_from = date('Y-m-d', strtotime($request->input('dates')));
            $date_to = '2022-01-01';
            return view('book_now')
                ->with('date_from', $date_from)
                ->with('date_to', $date_to);
        }else{
            return redirect('welcome')->with('date_error','Date Already Reserved. Please Pick Other Date');
        }
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
            'date_to' => $request->input('date_to'),
            'date' => $date,
            'status' => 'Pending',
        ]);

        $new->save();

        return redirect('/')->with('success', 'Success');
    }
}
