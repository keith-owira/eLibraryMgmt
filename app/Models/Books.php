<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'publisher',
        'isbn',
        'category',
        'sub_category',
        'pages',
        'image',
        'added_by'
    ];
    public function bookLoans()
    {
        return $this->hasMany(BookLoan::class);
    }
}
