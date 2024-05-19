<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Api\ProjectController;


class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'image',
    ];
}
