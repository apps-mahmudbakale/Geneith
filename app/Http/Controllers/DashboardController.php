<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use NumberFormatter;
use App\Models\Product;
use App\Models\Station;
use Illuminate\Http\Request;
use App\Classes\CustomReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
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
        $users = User::count();
        $products = Product::count();
        $sales = Sale::count();
        $sales_cash = Sale::sum('amount');
        $products_cash = Product::all()->sum(function($t){
            return $t->selling_price * $t->qty;
        });
        $query = DB::table('sales')
                        ->join('products', 'products.id', '=', 'sales.product_id')
                        ->select(DB::raw('SUM(products.selling_price * sales.qty) - SUM(products.buying_price * sales.qty) as profit'))->first();
        $profit = $query->profit;
        // dd($query->profit);
        return view('home', compact('users', 'products','sales', 'sales_cash', 'products_cash', 'profit'));
    }

    public function generalReport()
    {
        $sales = DB::table('sales')
            ->select('sales.*', 'products.name as product', 'users.name as user', 'stations.name as station')
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->join('stations', 'stations.id', '=', 'sales.station_id')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->orderBy('sales.station_id', 'asc')
            ->get();
        $sum    = DB::table('sales')
            ->selectRaw('sum(amount) as total')
            ->first();
        $inWords = new NumberFormatter("En", NumberFormatter::SPELLOUT);
        $words = $inWords->format($sum->total);
        return view('reports.general', compact('sales', 'sum', 'words'));
    }
    public function endOfDayView()
    {
        $stations = Station::get();
        return view('reports.end_day_view', compact('stations'));
    }
    public function endOfDayReport(Request $request)
    {
        $sales = DB::table('sales')
            ->select('sales.*', 'products.name as product', 'users.name as user', 'stations.name as station')
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->join('stations', 'stations.id', '=', 'sales.station_id')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->where('sales.station_id', $request->station)
            ->whereRaw('Date(sales.created_at) = CURDATE()')
            ->get();
        return view('reports.endDay', compact('sales'));
    }

    public function customReportView()
    {
        $products = Product::get();
        $stations = Station::get();
        $users = User::where('name', '!=','Admin')->get();
            return view('reports.custom', compact('products', 'stations', 'users'));
    }
    public function customReport(Request $request, CustomReport $report)
    {
        $reports = $report->filter($request);
        $products = Product::get();
        $stations = Station::get();
        $users = User::where('name', '!=','Admin')->get();
        $words = $reports['words'];
        $sales = $reports['filter'];
        $sum = $reports['sum'];
            return view('reports.custom', compact('products', 'stations', 'users', 'sales', 'words', 'sum'));
        
    }
    public function showChangePasswordGet() {
        return view('change-password');
    }
    public function changePasswordPost(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        #Match The Old Password
        if(Hash::check($request->current_password, auth()->user()->password)){
            // dd(Hash::make($request->new_password));
            DB::table('users')
                ->where('id', auth()->user()->id)
                ->update([
                    'password' => Hash::make($request->new_password)
                ]);
        return redirect()->back()->with("success","Password successfully changed!");
        }else{
             return back()->with("error", "Old Password Doesn't match!");
        }      
    }
}
