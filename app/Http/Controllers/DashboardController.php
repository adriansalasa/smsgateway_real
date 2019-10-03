<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Inbox;
use App\Outbox;
use App\Phonebook;
use App\buycredit;
use Auth;
use Month;
use Session;
use App\Group;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller

{

    public function __invoke(Request $request)

    {
        $inbox=Inbox::where('in_uid', Auth::user()->uid)->count();
        $outbox=Outbox::where('uid', Auth::user()->uid)->where('p_status', '3')->count();
        $queue=Outbox::where('uid', Auth::user()->uid)->where('p_status', '0')->count();
        $pb=Phonebook::where('uid', Auth::user()->uid)->count();
        $failed=Outbox::where('uid', Auth::user()->uid)->where('p_status', '2')->count();
        $notif=buycredit::where('confirmYn', 'N')->count();

    	$tahun=date('Y');
    	$tgl_inbox = Inbox::selectRaw('year(in_datetime) year, monthname(in_datetime) month, count(*) data')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->get();
        $b1 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '01')->where('in_uid', Auth::user()->uid)->count();
        $b2 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '02')->where('in_uid', Auth::user()->uid)->count();
        $b3 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '03')->where('in_uid', Auth::user()->uid)->count();
        $b4 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '04')->where('in_uid', Auth::user()->uid)->count();
        $b5 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '05')->where('in_uid', Auth::user()->uid)->count();
        $b6 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '06')->where('in_uid', Auth::user()->uid)->count();
        $b7 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '07')->where('in_uid', Auth::user()->uid)->count();
        $b8 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '08')->where('in_uid', Auth::user()->uid)->count();
        $b9 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '09')->where('in_uid', Auth::user()->uid)->count();
        $b10 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '10')->where('in_uid', Auth::user()->uid)->count();
        $b11 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '11')->where('in_uid', Auth::user()->uid)->count();
        $b12 = Inbox::whereYear('in_datetime', $tahun)->whereMonth('in_datetime', '12')->where('in_uid', Auth::user()->uid)->count();

        $bo1 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '01')->where('uid', Auth::user()->uid)->count();
        $bo2 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '02')->where('uid', Auth::user()->uid)->count();
        $bo3 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '03')->where('uid', Auth::user()->uid)->count();
        $bo4 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '04')->where('uid', Auth::user()->uid)->count();
        $bo5 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '05')->where('uid', Auth::user()->uid)->count();
        $bo6 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '06')->where('uid', Auth::user()->uid)->count();
        $bo7 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '07')->where('uid', Auth::user()->uid)->count();
        $bo8 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '08')->where('uid', Auth::user()->uid)->count();
        $bo9 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '09')->where('uid', Auth::user()->uid)->count();
        $bo10 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '10')->where('uid', Auth::user()->uid)->count();
        $bo11 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '11')->where('uid', Auth::user()->uid)->count();
        $bo12 = Outbox::whereYear('p_datetime', $tahun)->whereMonth('p_datetime', '12')->where('uid', Auth::user()->uid)->count();

        return view('admin.dashboard.index', compact('tgl_inbox', 'b1', 'b2', 'b3', 'b4', 'b5', 'b6', 'b7', 'b8', 'b9', 'b10', 'b11', 'b12', 'bo1', 'bo2', 'bo3', 'bo4', 'bo5', 'bo6', 'bo7', 'bo8', 'bo9', 'bo10', 'bo11', 'bo12', 'tahun', 'inbox', 'outbox', 'pb', 'failed', 'queue', 'notif'));

    }

}

