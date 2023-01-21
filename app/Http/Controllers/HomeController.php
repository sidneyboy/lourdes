<?php

namespace App\Http\Controllers;

use App\Mail\Contact_us_mail;
use App\Mail\Cancel_reservations;
use App\Models\User;
use App\Models\Type;
use App\Models\About;
use App\Models\Accomodation;
use App\Models\Accomodation_images;
use App\Models\Carousel;
use App\Models\Contact_us;
use App\Models\Reservations;
use App\Models\Reservations_details;
use DB;
use DateTime;
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

        $reservation_monthly = Reservations_details::whereMonth('created_at', $month)->sum('payment');
        $reservation_yearly = Reservations_details::whereYear('created_at', $year)->sum('payment');

        $reserved_monthly = Reservations::whereMonth('created_at', $month)->count();
        $reserved_yearly = Reservations::whereYear('created_at', $year)->count();

        // $reservations = Reservations::whereDate('created_at', '>=', $date)
        //     ->orderBy('id', 'desc')
        //     ->get();

        $reservation_month = Reservations::select(
            DB::raw('month(date_from) as month'),
            DB::raw('year(date_from) as year'),
        )->groupBy('month')
            ->orderBy('created_at')
            ->get();

        foreach ($reservation_month as $key => $value) {
            $reservations[$value->month] = Reservations::whereMonth('date_from', $value->month)
                ->where('status', '!=', 'Cancelled')
                ->where('status', '!=', 'Pending')
                ->get();
        }

        return view('home', compact('widget'), [
            'message_count' => $message_count,
            'reservation_month' => $reservation_month,
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

        $reservations = Reservations::orderBy('id', 'desc')->where('status', 'Pending')->get();
        return view('reservations', compact('widget'), [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'reservations' => $reservations,
        ]);
    }

    public function paid_downpayment_proecss($id, $email)
    {

        Reservations::where('id', $id)
            ->update(['status' => 'Paid Downpayment']);

        $new = new Reservations_details([
            'reservation_id' => $id,
            'downpayment' => 500,
            'status' => 'Paid Downpayment',
        ]);

        $new->save();

        $subject = '';
        $messages = 'We are happy to tell you that your reservation has been acknowledge and approved. See you at Nikan Magdale Resort';
        Mail::to($email)->send(new Contact_us_mail($subject, $messages));

        return redirect('paid_downpayment')->with('success', 'Success');
    }

    public function paid_downpayment()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();


        $reservations = Reservations::orderBy('id', 'desc')->where('status', 'Paid Downpayment')->get();
        return view('paid_downpayment', compact('widget'), [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'reservations' => $reservations,
        ]);
    }

    public function partial_payment()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();


        $reservations = Reservations::orderBy('id', 'desc')->where('status', 'Partial Payment')->get();
        return view('partial_payment', compact('widget'), [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'reservations' => $reservations,
        ]);
    }

    public function full_paid()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();


        $reservations = Reservations::orderBy('id', 'desc')->where('status', 'Paid')->get();
        return view('full_paid', compact('widget'), [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'reservations' => $reservations,
        ]);
    }

    public function cancelled()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();


        $reservations = Reservations::orderBy('id', 'desc')->where('status', 'Cancelled')->get();
        return view('cancelled', compact('widget'), [
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
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        //return $request->input();

        if ($request->input('amount') == "500") {
            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Paid Downpayment',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'downpayment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Paid Downpayment',
            ]);

            $new->save();

            $subject = '';
            $messages = 'We are happy to tell you that your reservation has been acknowledge and approved. See you at Nikan Magdale Resort';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

            return redirect('paid_downpayment')->with('success', 'Success');
        } else if ($request->input('amount') == "6000") {
            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Paid',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Paid',
            ]);

            $new->save();

            $subject = '';
            $messages = 'We are happy to tell you that your reservation has been acknowledge and approved. See you at Nikan Magdale Resort';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

            return redirect('full_paid')->with('success', 'Success');
        } else if ($request->input('amount') > "500") {
            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Partial Payment',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Partial Payment',
            ]);

            $new->save();

            $subject = '';
            $messages = 'We are happy to tell you that your reservation has been acknowledge and approved. See you at Nikan Magdale Resort';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

            return redirect('partial_payment')->with('success', 'Success');
        } else {
            return redirect('reservations')->with('success', 'Cannot Proceed. Amount must be equal or greater than 500');
        }
    }

    public function paid_downpayment_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $reservation = Reservations_details::where('reservation_id', $request->input('id'))->get();

        foreach ($reservation as $key => $sum_data) {
            $total_amount[] = $sum_data->payment + $sum_data->downpayment;
        }


        $amount = array_sum($total_amount) + $request->input('amount');

        if ($amount == 6000) {

            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Paid',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Paid',
            ]);

            $new->save();

            $subject = '';
            $messages = 'We are happy to served you. Thank you for staying at Nikan Magdale Resort. See you again!';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

            return redirect('full_paid')->with('success', 'Success');
        } else if ($amount < 6000) {
            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Partial Payment',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Partial Payment',
            ]);

            $new->save();

            $subject = '';
            $messages = 'Partial payment acknowledge';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));
            return redirect('partial_payment')->with('success', 'Success');
        } else {
            return redirect('partial_payment')->with('success', 'Error, Final Payment + Partial Payment must be equal to 6000');
        }
    }

    public function partial_payment_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        //return $request->input('id');
        $reservation = Reservations_details::where('reservation_id', $request->input('id'))->get();

        foreach ($reservation as $key => $sum_data) {
            $total_amount[] = $sum_data->payment + $sum_data->downpayment;
        }


        $amount = array_sum($total_amount) + $request->input('amount');

        if ($amount == 6000) {

            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Paid',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Paid',
            ]);

            $new->save();

            $subject = '';
            $messages = 'We are happy to served you. Thank you for staying at Nikan Magdale Resort. See you again!';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

            return redirect('full_paid')->with('success', 'Success');
        } else if ($amount < 6000) {
            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Partial Payment',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Partial Payment',
            ]);

            $new->save();

            $subject = '';
            $messages = 'Partial payment acknowledge';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));
            return redirect('partial_payment')->with('success', 'Success');
        } else {
            return redirect('partial_payment')->with('success', 'Error, Final Payment + Partial Payment must be equal to 6000');
        }
    }

    public function reservation_process_final_data(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $reservation = Reservations_details::where('reservation_id', $request->input('id'))->get();

        foreach ($reservation as $key => $sum_data) {
            $total_amount[] = $sum_data->payment + $sum_data->downpayment;
        }


        $amount = array_sum($total_amount) + $request->input('amount');

        if ($amount == 6000) {
            Reservations::where('id', $request->input('id'))
                ->update([
                    'status' => 'Paid',
                ]);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Paid',
            ]);

            $new->save();

            $subject = '';
            $messages = 'We are happy to served you. Thank you for staying at Nikan Magdale Resort. See you again!';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

            return redirect('full_paid')->with('success', 'Success');
        } else {
            return redirect('reservations')->with('success', 'Error, Final Payment + Partial Payment must be equal to 6000');
        }
    }

    public function cancel_reservation(Request $request)
    {

        Reservations::where('id', $request->input('id'))
            ->update([
                'status' => 'Cancelled',
            ]);

        $subject = '';
        $messages = $request->input('cancel_description');
        Mail::to($request->input('email'))->send(new Cancel_reservations($subject, $messages));

        return redirect('cancelled')->with('success', 'Success');
    }

    public function accomodation_status($id, $status)
    {
        Accomodation::where('id', $id)
            ->update([
                'status' => $status,
            ]);

        return redirect('accomodation')->with('success', 'Success');
    }

    public function monthly_earning_report()
    {

        // return 'diri ang focus apil ang yearly';
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');


        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();
        return view('monthly_earning_report', [
            // 'reservations' => $reservations,
            // 'total' => $total,
            // 'reservation_paid' => $reservation_paid,
            // 'reservation_reserved' => $reservation_reserved,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            // 'cancelled' => $cancelled,
        ]);
    }

    public function monthly_earning_proceed(Request $request)
    {
        $monthly_sales = Reservations_details::select(
            DB::raw('year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('sum(payment) as total_sales'),
            DB::raw('sum(downpayment) as downpayment'),
        )->where(DB::raw('date(created_at)'), '>=', $request->input('year') . "-01-01")
            ->groupBy('year')
            ->groupBy('month')
            ->get()
            ->toArray();

        if (count($monthly_sales) != 0) {
            foreach ($monthly_sales as $monthly_sales_result) {
                $dateObj   = DateTime::createFromFormat('!m', $monthly_sales_result['month']);
                $monthName = $dateObj->format('F'); // March
                $month_label[] = $monthName;
                $monthly_total_sales[] = round($monthly_sales_result['total_sales'] + $monthly_sales_result['downpayment'], 2);
                $month[] = $monthly_sales_result['month'];
            }
        } else {
            $month_label = 0;
            $monthly_total_sales[] = '';
            $month[] = '';
        }



        return view('monthly_earning_proceed')
            ->with('month_label', $month_label)
            ->with('monthly_total_sales', $monthly_total_sales)
            ->with('month', $month)
            ->with('year', $request->input('year'));
    }

    public function monthly_earning_view_sales_report($month)
    {
        //return $month;
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $day = date('d');

        $sales = DB::table('reservations_details')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(payment) as total_sales'), DB::raw('sum(downpayment) as downpayment'))
            ->groupBy('date')
            ->whereMonth('created_at', $month)
            ->get()
            ->toArray();

        $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('F'); // March

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $cancelled = Reservations::select(
            DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as date"),
            DB::raw('count(*) as count')
        )
            ->orderBy('created_at')
            ->whereMonth('created_at', $month)
            ->groupBy('date')
            ->where('status', 'Cancelled')
            ->get();

        return view('monthly_earning_view_sales_report', [
            'sales' => $sales,
            'cancelled' => $cancelled,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
        ])->with('monthName', $monthName)
            ->with('month', $month);
    }


    public function monthly_earning_report_print($month)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $day = date('d');

        $sales = DB::table('reservations_details')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(payment) as total_sales'), DB::raw('sum(downpayment) as downpayment'))
            ->groupBy('date')
            ->whereMonth('created_at', $month)
            ->get()
            ->toArray();

        $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('F'); // March

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $cancelled = Reservations::select(
            DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as date"),
            DB::raw('count(*) as count')
        )
            ->orderBy('created_at')
            ->whereMonth('created_at', $month)
            ->groupBy('date')
            ->where('status', 'Cancelled')
            ->get();

        return view('monthly_earning_report_print', [
            'sales' => $sales,
            'cancelled' => $cancelled,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
        ])->with('monthName', $monthName)
            ->with('month', $month);
    }

    public function monthly_earning_print()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $cancelled = Reservations::select(
            DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as date"),
            DB::raw('count(*) as count')
        )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->where('status', 'Cancelled')
            ->get();

        $reservations = Reservations::whereMonth('created_at', $month)
            ->where('status', '!=', 'Pending')
            ->where('status', '!=', 'Cancelled')
            ->get();

        if (count($reservations) != 0) {
            foreach ($reservations as $key => $data) {
                $total[$data->id] = Reservations_details::where('reservation_id', $data->id)
                    ->sum('payment');
            }
        } else {
            $total[] = '';
        }


        $reservation_paid = Reservations::where('status', 'Paid')->count();
        $reservation_reserved = Reservations::where('status', '!=', 'Cancelled')
            ->where('status', '!=', 'Paid')
            ->where('status', '!=', 'Pending')
            ->count();



        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();
        return view('monthly_earning_print', [
            'reservations' => $reservations,
            'total' => $total,
            'reservation_paid' => $reservation_paid,
            'reservation_reserved' => $reservation_reserved,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'cancelled' => $cancelled,
        ]);
    }

    public function yearly_earning_report()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $sales = DB::table('reservations_details')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('sum(payment) as total_sales'), DB::raw('sum(downpayment) as downpayment'))
            ->groupBy('year')
            ->get()
            ->toArray();


        $reservation_paid = Reservations::where('status', 'Paid')->count();
        $reservation_reserved = Reservations::where('status', '!=', 'Cancelled')
            ->where('status', '!=', 'Paid')
            ->where('status', '!=', 'Pending')
            ->count();



        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();
        return view('yearly_earning_report', [
            'sales' => $sales,
            'reservation_paid' => $reservation_paid,
            'reservation_reserved' => $reservation_reserved,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            // 'cancelled' => $cancelled,
        ]);
    }

    public function yearly_earning_view_sales_report($year)
    {
        $sales = DB::table('reservations_details')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(payment) as total_sales'), DB::raw('sum(downpayment) as downpayment'))
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->toArray();

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $cancelled = Reservations::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as count')
        )
            ->orderBy('created_at')
            ->groupBy('month')
            ->whereYear('created_at', $year)
            ->where('status', 'Cancelled')
            ->get();

        return view('yearly_earning_view_sales_report', [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'sales' => $sales,
            'cancelled' => $cancelled,
            'year' => $year,
        ]);
    }

    public function yearly_earning_report_print($year)
    {
        $sales = DB::table('reservations_details')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(payment) as total_sales'), DB::raw('sum(downpayment) as downpayment'))
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->toArray();

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $cancelled = Reservations::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as count')
        )
            ->orderBy('created_at')
            ->groupBy('month')
            ->whereYear('created_at', $year)
            ->where('status', 'Cancelled')
            ->get();

        return view('yearly_earning_report_print', [
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'sales' => $sales,
            'cancelled' => $cancelled,
            'year' => $year,
        ]);
    }


    public function yearly_earning_print()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $cancelled = Reservations::select(
            DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as date"),
            DB::raw('count(*) as count')
        )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->where('status', 'Cancelled')
            ->get();

        $reservations = Reservations::whereYear('created_at', $year)
            ->where('status', '!=', 'Pending')
            ->where('status', '!=', 'Cancelled')
            ->get();

        if (count($reservations) != 0) {
            foreach ($reservations as $key => $data) {
                $total[$data->id] = Reservations_details::where('reservation_id', $data->id)
                    ->sum('payment');
            }
        } else {
            $total[] = '';
        }


        $reservation_paid = Reservations::where('status', 'Paid')->count();
        $reservation_reserved = Reservations::where('status', '!=', 'Cancelled')
            ->where('status', '!=', 'Paid')
            ->where('status', '!=', 'Pending')
            ->count();



        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();
        return view('yearly_earning_print', [
            'reservations' => $reservations,
            'total' => $total,
            'reservation_paid' => $reservation_paid,
            'reservation_reserved' => $reservation_reserved,
            'message_count' => $message_count,
            'reservation_count' => $reservation_count,
            'cancelled' => $cancelled,
        ]);
    }

    public function reservation_payment_process(Request $request)
    {
        $sum_payment = Reservations_details::where('reservation_id', $request->input('id'))
            ->sum('payment');

        $total_payment = $sum_payment + str_replace(',', '', $request->input('amount'));

        if ($total_payment == "6000") {
            Reservations::where('id', $request->input('id'))
                ->update(['status' => 'Paid']);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Paid',
            ]);

            $new->save();

            $subject = '';
            $messages = 'We are happy to served you. Thank you for staying at Nikan Magdale Resort. See you again!';
            Mail::to($request->input('email'))->send(new Contact_us_mail($subject, $messages));

            return redirect('full_paid')->with('success', 'Success');
        } else if ($total_payment < "6000") {
            Reservations::where('id', $request->input('id'))
                ->update(['status' => 'Partial Payment']);

            $new = new Reservations_details([
                'reservation_id' => $request->input('id'),
                'payment' => str_replace(',', '', $request->input('amount')),
                'status' => 'Partial Payment',
            ]);

            $new->save();
            return redirect('partial_payment')->with('success', 'Success');
        } elseif ($total_payment == 0) {
            return redirect('partial_payment')->with('error', 'Cannot Process');
        } else {
            return redirect('partial_payment')->with('error', 'Total payment must not be greater than ₱ 6,000.00');
        }
    }

    public function search_paid_downpayment(Request $request)
    {
        //return $request->input();
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $data_range = explode('-', $request->input('daterange'));
        $date_from = date('Y-m-d', strtotime($data_range[0]));
        $date_to = date('Y-m-d', strtotime($data_range[1]));
        $reservations = Reservations::whereBetween('created_at', [$date_from, $date_to])->where('status', 'Paid Downpayment')->get();

        return view('search_paid_downpayment', [
            'reservations' => $reservations,
            'reservation_count' => $reservation_count,
            'message_count' => $message_count,
        ]);
    }

    public function search_reservations(Request $request)
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $data_range = explode('-', $request->input('daterange'));
        $date_from = date('Y-m-d', strtotime($data_range[0]));
        $date_to = date('Y-m-d', strtotime($data_range[1]));
        $reservations = Reservations::whereBetween('created_at', [$date_from, $date_to])->where('status', 'Pending')->get();

        return view('search_reservations', [
            'reservations' => $reservations,
            'reservation_count' => $reservation_count,
            'message_count' => $message_count,
        ]);
    }

    public function search_partial_payment(Request $request)
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $data_range = explode('-', $request->input('daterange'));
        $date_from = date('Y-m-d', strtotime($data_range[0]));
        $date_to = date('Y-m-d', strtotime($data_range[1]));
        $reservations = Reservations::whereBetween('created_at', [$date_from, $date_to])->where('status', 'Partial Payment')->get();

        return view('search_partial_payment', [
            'reservations' => $reservations,
            'reservation_count' => $reservation_count,
            'message_count' => $message_count,
        ]);
    }

    public function search_full_paid(Request $request)
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $message_count = Contact_us::where('status', 'Pending')->count();
        $reservation_count = Reservations::where('status', 'Pending')->count();

        $data_range = explode('-', $request->input('daterange'));
        $date_from = date('Y-m-d', strtotime($data_range[0]));
        $date_to = date('Y-m-d', strtotime($data_range[1]));
        $reservations = Reservations::whereBetween('created_at', [$date_from, $date_to])->where('status', 'Paid')->get();

        return view('search_full_paid', [
            'reservations' => $reservations,
            'reservation_count' => $reservation_count,
            'message_count' => $message_count,
        ]);
    }
}
