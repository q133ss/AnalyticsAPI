<?php

namespace App\Models;

use App\Traits\SortTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, SortTrait;
    protected $guarded = [];
}
