<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'amount'           => 'required|numeric|min:0',
            'description'      => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        Expense::create([
            'user_id'          => auth()->id(),
            'category_id'      => $request->category_id,
            'amount'           => $request->amount,
            'description'      => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'amount'           => 'required|numeric|min:0',
            'description'      => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $expense->update([
            'category_id'      => $request->category_id,
            'amount'           => $request->amount,
            'description'      => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }
}