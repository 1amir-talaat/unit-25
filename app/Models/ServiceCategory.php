<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model {
    use HasFactory;

    /**
     * Get the services for the category.
     */
    public function services() {
        return $this->hasMany(Service::class);
    }
}
