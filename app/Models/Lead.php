<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'priority',// Example: high, medium, low
        'stage_id',// Example: new, in progress, negotiated, closed
        'agent_id', //The ID of the agent assigned to this lead
        'notes',
    ];

    /**
     * Relationships.
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
