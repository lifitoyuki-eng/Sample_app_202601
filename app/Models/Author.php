<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Author extends Model
{
    use HasFactory;

    public function detail(): HasOne
    {
        return $this->HasOne(AuthorDetail::class);
    }

    public function books() : BelongToMany
    {
        return $this->belongToMany(Book::class)->withTimestamps();
    }
    //
}
