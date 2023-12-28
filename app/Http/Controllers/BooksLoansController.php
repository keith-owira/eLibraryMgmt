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

    public function getLoanDetails(Request $request)
    {
        $input = $request->validate([
            'search_term' => 'required|string',
            'search_by' => 'required|in:book_name,user_name'
        ]);

        $loanDetails = null;

        if ($input['search_by'] === 'book_name') {
            // Search by book name
            $book = Books::where('name', $input['search_term'])->first();

            if ($book) {
                $loanDetails = Books_loans::where('book_id', $book->id)->first();
            }
        } else {
            // Search by user name
            $user = User::where('name', $input['search_term'])->first();

            if ($user) {
                $loanDetails = Books_loans::where('user_id', $user->id)->first();
            }
        }

        if ($loanDetails) {
            $loanDetails = $loanDetails->load('user', 'book');
            // Retrieve user name and book name
            $loanDetails['user_name'] = $loanDetails->user->name;
            $loanDetails['book_name'] = $loanDetails->book->name;
        }

        return response()->json($loanDetails);
    }

}
