<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Expense; 

class HomeController
{
    public function index()
    {
        $categoryCount = Category::where('user_id', Auth::id())->count();

        $totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');

        $thisMonthExpenses = Expense::where('user_id', Auth::id())
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        $monthlyData = [];
        $categoryByMonth = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyData[] = Expense::where('user_id', Auth::id())
                ->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', now()->year)
                ->sum('amount');

            $categoryExpenses = Expense::where('expenses.user_id', Auth::id())
                ->join('categories', 'expenses.category_id', '=', 'categories.id')
                ->whereMonth('expenses.transaction_date', $month)
                ->whereYear('expenses.transaction_date', now()->year)
                ->selectRaw('categories.name as category_name, SUM(expenses.amount) as total')
                ->groupBy('categories.name')
                ->get();

            $categoryByMonth[$month] = [
                'labels' => $categoryExpenses->pluck('category_name'),
                'data' => $categoryExpenses->pluck('total'),
            ];
        }

        return view('home', compact(
            'categoryCount',
            'totalExpenses',
            'thisMonthExpenses',
            'monthlyData',
            'categoryByMonth'
        ));
    }
}
