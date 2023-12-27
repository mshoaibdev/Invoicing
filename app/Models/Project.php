<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'contact_info',
        'price',
        'type',
        'time',
        'added_date',
        'last_worked_on',
        'description',
        'status',
        'user_id',
        'created_by',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    protected $appends = ['project_number'];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function scopeSearch($query, $queryString)
    {
        // dd($queryString);
        if (Str::startsWith($queryString, 'PRJ')) {
            $id = Str::after($queryString, 'PRJ');
            $query->where('id', $id);
        }

        // return $query->orWhere('site_address', 'like', '%'.$queryString.'%')
        //     ->orWhere('description', 'like', '%'.$queryString.'%')
        //     ->orWhere('total', 'like', '%'.$queryString.'%')
        //   ;
    }

    // created at
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    // added date

    protected function addedDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }

    // last work date

    protected function lastWorkedOn(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }

    // project number

    protected function projectNumber(): Attribute
    {
        // year 2 digit
        $year = Carbon::now()->format('y');

        return Attribute::make(
            get: fn () => "PRJ-{$year}-{$this->id}",
        );
    }

    // relations

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



  
    public function scopeApplyFilters($query, Request $request)
    {
        $user = auth()->user();
        $query
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->companyId, function ($query, $companyId) {
                $query->where('company_id', $companyId);
            })
            ->when($request->date_range, function ($query, $dateRange) {
                if (Str::contains($dateRange, 'to')) {
                    $dates = explode('to', $dateRange);
                    $date1 = Carbon::parse(trim($dates[0]))->format('Y-m-d');
                    $date2 = Carbon::parse(trim($dates[1]))->format('Y-m-d');
                    $query->whereBetween('created_at', [$date1, $date2]);
                }
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }


    protected static function booted()
    {
        static::deleting(function ($item) {
            // $item->students()->delete();
        });
    }
}
