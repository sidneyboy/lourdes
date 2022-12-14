<?php

namespace App\Http\Controllers;

use App\Mail\Contact_us_mail;
use App\Models\User;
use App\Models\Type;
use App\Models\About;
use App\Models\Accomodation;
use App\Models\Accomodation_images;
use App\Models\Carousel;
use App\Models\Contact_us;
use App\Models\Reservations;


use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $reservation_monthly = Reservations::whereMonth('created_at', $month)->sum('payment');
        $reservation_yearly = Reservations::whereYear('created_at', $year)->sum('payment');

        $reserved_monthly = Reservations::whereMonth('created_at', $month)->count();
        $reserved_yearly = Reservations::whereYear('created_at', $year)->count();

        $reservations = Reservations::where('status', 'Paid')->orderBy('id', 'desc')->get();
        return view('home', compact('widget'), [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'reservation_monthly' => $reservation_monthly,
            'reservation_yearly' => $reservation_yearly,
            'reserved_monthly' => $reserved_monthly,
            'reserved_yearly' => $reserved_yearly,
            'reservations' => $reservations,
        ]);
    }

    public function about()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $about_count = About::count();

        $about = About::all();

        return view('about', compact('widget'), [
            'message_count' => $message_count,
            'about' => $about,
            'about_count' => $about_count,
            'reservation_count' => $reservation_count,
        ]);
    }

    public function about_edit_process(Request $request)
    {
        About::where('id', $request->input('about_id'))
            ->update(['about' => $request->input('about_edit')]);

        return redirect('about')->with('success', 'Success');
    }

    public function about_process(Request $request)
    {
        //dd($request->all());
        $imageName = time() . rand(1, 99) . '.' . $request->images->extension();
        $request->images->move(public_path('storage'), $imageName);

        $new = new About([
            'about' => $request->input('description'),
            'image' => $imageName,
        ]);

        $new->save();

        return redirect('about')->with('success', 'Success');
    }

    public function about_edit_image(Request $request)
    {
        $imageName = time() . rand(1, 99) . '.' . $request->images->extension();
        $request->images->move(public_path('storage'), $imageName);

        About::where('id', $request->input('about_id'))
            ->update(['image' => $imageName]);

        return redirect('about')->with('success', 'Success');
    }

    public function carousel()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();
        $carousel = Carousel::all();

        return view('carousel', compact('widget'), [
            'message_count' => $message_count,
            'carousel' => $carousel,
            'reservation_count' => $reservation_count,
        ]);
    }

    public function carousel_active($id, $status)
    {
        Carousel::where('id', $id)
            ->update(['status' => $status]);

        return redirect('carousel')->with('success', 'Success');
    }

    public function carousel_process(Request $request)
    {
        foreach ($request->images as $key => $image) {
            $imageName = time() . rand(1, 99) . '.' . $image->extension();
            $image->move(public_path('storage'), $imageName);

            $new_image = new Carousel([
                'image' => $imageName,
                'status' => 'active',
            ]);

            $new_image->save();
        }

        return redirect('carousel')->with('success', 'Success');
    }

    public function message()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $contact_us = Contact_us::all();
        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();


        return view('message', compact('widget'), [
            'contact_us' => $contact_us,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
        ]);
    }


    public function accomodation()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $type = Type::all();

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $accomodation = Accomodation::all();


        return view('accomodation', compact('widget'), [
            'type' => $type,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'accomodation' => $accomodation,
        ]);
    }

    public function accomodation_type()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $type = Type::all();

        return view('accomodation_type', compact('widget'), [
            'type' => $type,
        ]);
    }

    public function accomodation_type_process(Request $request)
    {
        $new = new Type([
            'type' => $request->input('type'),
        ]);

        $new->save();

        return redirect('accomodation_type')->with('success', 'Success');
    }

    public function accomodation_type_edit_process(Request $request)
    {
        Type::where('id', $request->input('id'))
            ->update(['type' => $request->input('type')]);

        return redirect('accomodation_type')->with('success', 'Success');
    }

    public function accomodation_process(Request $request)
    {
        //dd($request->all());
        $imageName = time() . rand(1, 99) . '.' . $request->images->extension();
        $request->images->move(public_path('storage'), $imageName);
        $new_accomodation = new Accomodation([
            'type_id' => $request->input('type_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imageName,
            'status' => 'activated',
        ]);

        $new_accomodation->save();

        return redirect('accomodation')->with('success', 'Success');
    }



    public function message_process(Request $request)
    {
        //return $request->input();

        $subject = '';
        $messages = $request->input('message');
        Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

        Contact_us::where('id', 1)
            ->update(['status' => 'replied']);

        return redirect('message')->with('success', 'Success');
    }

    public function reservations()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();


        $reservations = Reservations::all();
        return view('reservations', compact('widget'), [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'reservations' => $reservations,
        ]);
    }

    public function accomodation_list()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $accomodation = Accomodation::all();
        $accomodation_image = Accomodation_images::all();

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();


        return view('accomodation_list', compact('widget'), [
            'accomodation' => $accomodation,
            'accomodation_image' => $accomodation_image,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
        ]);
    }

    public function reservation_process_data(Request $request)
    {
        Reservations::where('id', $request->input('id'))
            ->update([
                'payment' => $request->input('amount'),
                'status' => 'For Final Payment',
            ]);


        $subject = '';
        $messages = 'We are happy to tell you that your reservation has been acknowledge and approved. See you at Nikan Magdale Resort';
        Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

        return redirect('reservations')->with('success', 'Success');
    }

    public function reservation_process_final_data(Request $request)
    {
        $reservation = Reservations::find($request->input('id'));

        $amount = $reservation->payment + $request->input('amount');
        Reservations::where('id', $request->input('id'))
            ->update([
                'payment' => $amount,
                'status' => 'Paid',
            ]);

        $subject = '';
        $messages = 'We are happy to served you. Thank you for staying at Nikan Magdale Resort. See you again!';
        Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

        return redirect('reservations')->with('success', 'Success');
    }

    public function cancel_reservation($id, $email)
    {

        Reservations::where('id', $id)
            ->update([
                'status' => 'Cancelled',
            ]);

        $subject = '';
        $messages = 'Due to unpaid downpayment your reservation has been cancelled.';
        Mail::to($email)->send(new Contact_us_mail($subject, $messages));

        return redirect('reservations')->with('success', 'Success');
    }

    public function accomodation_status($id, $status)
    {
        Accomodation::where('id', $id)
            ->update([
                'status' => $status,
            ]);

        return redirect('accomodation')->with('success', 'Success');
    }
}
