<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'badge',
        'icon',
        'featured_image',
        'overview',
        'content',
        'features',
        'benefits',
        'ideal_for',
        'quick_features',
        'price_type',
        'price',
        'price_note',
        'whatsapp_number',
        'cta_text',
        'meta_description',
        'status',
        'sort_order',
        'views',
    ];

    protected $casts = [
        'features' => 'array',
        'benefits' => 'array',
        'ideal_for' => 'array',
        'quick_features' => 'array',
        'price' => 'decimal:2',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    /**
     * Scope for published services.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for ordering by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        if ($this->price_type === 'contact') {
            return 'Contact for Price';
        } elseif ($this->price_type === 'custom') {
            return 'Custom Pricing';
        } elseif ($this->price_type === 'from') {
            return 'From $' . number_format($this->price, 2);
        } else {
            return '$' . number_format($this->price, 2);
        }
    }

    /**
     * Get status badge class.
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'published' => 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400',
            'draft' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400',
            'archived' => 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
