<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books_loans;
use App\Models\User;
use App\Models\Books;
class BooksLoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Books_loans::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'book_id'=>'required',
            'added_by'=>'required'
        ]);
        return Books_loans::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Books_loans::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookLoans = Books_loans::find($id);
        $bookLoans->update($request->all());
        return $bookLoans;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Books_loans::destroy($id);
    }

//    public function getLoanDetails(Request $request)
//    {
//
//        // Validate the request
//        $request->validate([
//            'name' => 'required|string',
//            'type' => 'required|in:user,book',
//        ]);
//
//        // Determine whether to search by user name or book name
//        $columnName = ($request->type === 'user') ? 'users.name' : 'books.name';
//
//        // Retrieve the loan details
//        $data = DB::table('books_loans')
//            ->where($columnName, $request->name)
//            ->join('users', 'users.id', '=', 'books_loans.user_id')
//            ->join('books', 'books.id', '=', 'books_loans.book_id')
//            ->select(
//                'users.name as user_name',
//                'books.name as book_name',
//                'books_loans.*'
//            )
//            ->get();
//
//        if ($data->isEmpty()) {
//            return response()->json(['message' => 'Data not found'], 404);
//        }
//
//        return response()->json($data);
//    }

    public function getLoanDetails($loanId)
    {
        $loan = Books_loans::with(['user', 'book'])
            ->where('id', $loanId)
            ->first();

        if (!$loan) {
            return response()->json(['error' => 'Loan not found'], 404);
        }

        $loanDetails = [
            'user_name' => $loan->user->name,
            'book_name' => $loan->book->name,
            'due_date' => $loan->due_date,
            'status' => $loan->status,
            // Add other fields as needed
        ];

        return response()->json($loanDetails);
    }
    public function getAllLoanDetails()
    {
        $loans = Books_loans::with(['user', 'book'])
            ->get();

//        dd($loans);

        if ($loans->isEmpty()) {
            return response()->json(['error' => 'No loans found'], 404);
        }

        $loanDetails = $loans->map(function ($loan) {
            return [
                'user_name' => $loan->user->name,
                'book_name' => $loan->book->name,
                'due_date' => $loan->due_date,
                'status' => $loan->status,
                // Add other fields as needed
            ];
        });

        return response()->json($loanDetails);
    }


}
