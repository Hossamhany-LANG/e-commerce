<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Main_Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function login(){
        return view('backend.login');
    }
    public function forgot_password(){
        return view('backend.forgot-password');
    }
    public function index(){
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders')
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')->orderBy('month')->get()
        ->pluck('total_orders', 'month')->toArray();

        $months = [];
        $totals = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = $m;
            $totals[] = $orders[$m] ?? 0; 
        }

        $orderStatus = Order::selectRaw('order_status, COUNT(*) as count')
        ->groupBy('order_status')->get()
        ->pluck('count', 'order_status')->toArray();

        $pieLabels = array_keys($orderStatus); 
        $pieValues = array_values($orderStatus);

        $targetCategoryIds = [1, 3, 5, 7, 11]; 
    
        $categoriesData = Main_Category::whereIn('id', $targetCategoryIds)
            ->withCount('orderItems as sales_count') 
            ->get();

        $totalSales = $categoriesData->sum('sales_count');

        $colors = [
            1 => 'bg-danger',   
            3 => 'bg-warning', 
            5 => 'bg-primary',
            7 => 'bg-info',     
            11 => 'bg-success'  
        ];

        $categoryStats = $categoriesData->map(function($category) use ($totalSales, $colors) {
            $percent = $totalSales > 0 ? ($category->sales_count / $totalSales) * 100 : 0;
            
            return [
                'name' => $category->name, 
                'percentage' => $percent,
                'color' => $colors[$category->id] ?? 'bg-secondary'
            ];
        });

        return view('backend.index', compact(
            'months', 'totals', 'pieLabels', 'pieValues', 'categoryStats'
        ));
    }
}