<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Product;
use App\Models\DeliveryArea;
use App\Models\Sale;
use App\Models\OrderItems;
use App\Models\OrderDelivery;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user_level = Auth()->user()->user_level;
        
        if($user_level == 2)
        {
            return redirect()->route('dashboard');
        }
        else if($user_level == 1)
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function admin_dashboard()
    {
        $count_users = User::count();
        $count_blogs = Blog::count();
        $count_comments = Comment::count();
        $count_products = Product::count();
        $count_delivery_areas = DeliveryArea::count();
        $count_orders = Sale::where('order_type', 1)->count();

        $gross_sales = Sale::sum('total_amount');
        $net_sales = Sale::sum('total_amount') - Sale::sum('discount');
        $cost_of_sales = OrderItems::sum('buying_price');
        $gross_profit = $net_sales - $cost_of_sales;

        // Sales for each month of the current year
        $monthly_sales = Sale::selectRaw("MONTH(created_at) as month, SUM(total_amount) as total_sales")
            // ->where('status', 'processed')
            // ->where('paid', true)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_sales', 'month');

        // Initialize an array to hold sales data for each month of the year
        $sales_data = [];

        // Loop through each month of the year and get sales data
        for ($month = 1; $month <= 12; $month++) {
            if (isset($monthly_sales[$month])) {
                $sales_data[] = $monthly_sales[$month];
            } else {
                $sales_data[] = 0;
            }
        }

        $locations_data = OrderDelivery::select('location', \DB::raw('COUNT(*) as total_orders'))
        ->groupBy('location')
        ->orderBy('total_orders', 'desc')
        ->get();

        // Map the data for cities and orders
        $locations_labels = $locations_data->pluck('location')->toArray();
        $locations_orders = $locations_data->pluck('total_orders')->toArray();

        return view('admin.dashboard', compact(
            'count_users',
            'count_blogs',
            'count_comments',
            'count_products',
            'count_delivery_areas',
            'count_orders',

            'gross_sales',
            'net_sales',
            'cost_of_sales',
            'gross_profit',

            'sales_data',
            'locations_labels',
            'locations_orders',
        ));
    }
}
