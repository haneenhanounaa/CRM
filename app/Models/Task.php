<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [
    //     'title',
    //     'description',
    //     'agent_id',
    //     'lead_id',
    //     'status',
    //     'due_date',
    // ];

    protected $guarded = [];

    /**
     * Relationships.
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
