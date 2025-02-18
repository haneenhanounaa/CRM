<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'order',
    ];

    
    /**
     * Relationships.
     */
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function scopeOrdered($query)
{
    return $query->orderBy('order');
}

}
