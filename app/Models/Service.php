<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];


    public function category(): BelongsTo {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
