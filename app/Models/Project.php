<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ["title", "description", 'owner_id'];

    /**
     * @return string
     */
    public function path(): string
    {
        return '/projects/' . $this->id;
    }

    /**
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
