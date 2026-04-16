<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where('user_id', auth()->id())->get();
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);
        Expense::create([
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'transaction_date' => $request->date,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect('/expenses/index')->with('success', 'Expense added successfully!');
    }

    public function edit(Expense $expense)
    {
        Gate::authorize('update', $expense);
        $categories = Category::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense->update([
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'transaction_date' => $request->date,
            'description' => $request->description,
        ]);
        return redirect('/expenses/index')->with('success', 'Expense details updated!'); 
    }

    public function destroy(Expense $expense)
    {
        Gate::authorize('delete', $expense);
        $expense->delete();
        return redirect('/expenses/index')->with('success', 'Expense deleted!');
    }
}
