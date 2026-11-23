<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'absences',
        'grade',
    ];

    protected $appends = ['equivalence'];

    protected function casts(): array
    {
        return [
            'absences' => 'integer',
            'grade' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getEquivalenceAttribute(): string
    {
        return match (true) {
            $this->grade <= 69 => 'NA',
            $this->grade <= 79 => 'SA',
            $this->grade <= 89 => 'DE',
            default => 'AU',
        };
    }
}
