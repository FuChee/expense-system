<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = ['amount', 'transaction_date'];

        $sort = in_array($request->get('sort'), $allowedSorts)
            ? $request->get('sort')
            : 'transaction_date';

        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

        $query = Expense::where('user_id', auth()->id());

        // FILTER
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $expenses = $query->orderBy($sort, $direction)->get();

        // get categories for dropdown
        $categories = Category::where('user_id', auth()->id())->get();

        return view('expenses.index', compact('expenses', 'sort', 'direction', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())
                        ->orWhereNull('user_id')
                        ->get();
        return view('expenses.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        Expense::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'transaction_date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect('/expenses/index')->with('success', 'Expense added successfully!');
    }

    public function edit(Expense $expense)
    {
        Gate::authorize('update', $expense);
        $categories = Category::where('user_id', auth()->id())
                        ->orWhereNull('user_id')
                        ->get();
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
        return redirect('/expenses/index')->with('success', 'Expense deleted successfully!');
    }
}
