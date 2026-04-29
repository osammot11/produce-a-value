<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'industry',
        'service',
        'summary',
        'challenge',
        'solution',
        'result',
        'metric_one_label',
        'metric_one_value',
        'metric_two_label',
        'metric_two_value',
        'metric_three_label',
        'metric_three_value',
        'status',
        'visual_image',
        'visual_label',
        'visual_caption',
        'before_state',
        'after_state',
        'problems_solved',
        'testimonial_quote',
        'testimonial_author',
        'testimonial_role',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * @return array<int, string>
     */
    public function problemsSolvedList(): array
    {
        if (! $this->problems_solved) {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $this->problems_solved))
            ->map(fn (string $item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
