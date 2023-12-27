<?php

namespace App\Models;

use Carbon\Carbon;
use NumberFormatter;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Plank\Mediable\Mediable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model implements Auditable
{
    use HasFactory, Mediable, HasUuids,\OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id',
        'stackholder_id',
        'contact_id',
        'quote_date',
        'valid_date',
        'note',
        'site_address',
        'tax_amount',
        'shipping',
        'items',
        'total',
        'subtotal',
        'tax_percentage',
        'lat',
        'lng',
        'status',
        'description',
        'revision_id',
        'is_project_created',
    ];

    protected $casts = [
        'revision_id' => 'integer',
        'stackholder_id' => 'integer',
        'contact_id' => 'integer',
        'company_id' => 'integer',
        'total' => 'float',
        'subtotal' => 'float',
        'shipping' => 'float',
        'tax_amount' => 'float',
        'items' => 'array',
        'is_project_created' => 'boolean',
        'is_project_created_at' => 'datetime',

    ];

    protected $appends = ['quote_id', 'quote_title'];

    protected $auditExclude = [
        'lat',
        'lng',
        'items',
    ];

    public function transformAudit(array $data): array
    {
        if (Arr::has($data, 'new_values.stackholder_id')) {
            $data['old_values']['stackholder_name'] = Stackholder::find($this->getOriginal('stackholder_id'))->name;
            $data['new_values']['stackholder_name'] = Stackholder::find($this->getAttribute('stackholder_id'))->name;
        }
        if (Arr::has($data, 'new_values.contact_id')) {
            $data['old_values']['contact_name'] = Contact::find($this->getOriginal('contact_id'))->name;
            $data['new_values']['contact_name'] = Contact::find($this->getAttribute('contact_id'))->name;
        }
        if (Arr::has($data, 'new_values.company_id')) {
            $data['old_values']['company_name'] = Company::find($this->getOriginal('company_id'))->name;
            $data['new_values']['company_name'] = Company::find($this->getAttribute('company_id'))->name;
        }

        return $data;
    }

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
        if (Str::startsWith($queryString, 'QT')) {
            $id = Str::after($queryString, 'QT');
            $query->where('id', $id);
        }

        return $query->orWhere('site_address', 'like', '%'.$queryString.'%')
            ->orWhere('description', 'like', '%'.$queryString.'%')
            ->orWhere('total', 'like', '%'.$queryString.'%')
            ->orWhere('subtotal', 'like', '%'.$queryString.'%')
            ->orWhere('shipping', 'like', '%'.$queryString.'%')
            ->orWhere('tax_amount', 'like', '%'.$queryString.'%')
            ->whereHas('stackholder', function ($query) use ($queryString) {
                return $query->where('name', 'like', $queryString.'%');
            });
    }

    // created at
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    protected function quoteId(): Attribute
    {
        return Attribute::make(
            get: fn () => "QT{$this->id}",
        );
    }

    protected function quoteTitle(): Attribute
    {
        $formatter = new NumberFormatter($this->stackholder->currency, NumberFormatter::CURRENCY);
        $total = $formatter->formatCurrency($this->total, $this->stackholder->currency);

        return Attribute::make(
            get: fn () => "QT{$this->id} - {$this->stackholder->name} - {$total}",
        );
    }

    protected function quoteDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }

    protected function revisionId(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str_pad($value, 3, '0', STR_PAD_LEFT),
        );
    }

    protected function validDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
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
            ->when($request->stackholderId, function ($query, $stackholderId) {
                $query->where('stackholder_id', $stackholderId);
            })
            ->when($request->contactId, function ($query, $contactId) {
                $query->where('contact_id', $contactId);
            })
            ->when($request->companyId, function ($query, $companyId) {
                $query->where('company_id', $companyId);
            })
            ->when($request->is_project_created, function ($query, $is_project_created) {
                $query->where('is_project_created', $is_project_created);
            })
            ->when($request->date_range, function ($query, $dateRange) {
                if (Str::contains($dateRange, 'to')) {
                    $dates = explode('to', $dateRange);
                    $date1 = Carbon::parse(trim($dates[0]))->format('Y-m-d');
                    $date2 = Carbon::parse(trim($dates[1]))->format('Y-m-d');
                    $query->whereBetween('quote_date', [$date1, $date2]);
                }
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }

    /**
     * Get the stackholder that owns the Contact
     */
    public function stackholder(): BelongsTo
    {
        return $this->belongsTo(Stackholder::class);
    }

    /**
     * Get the quotes that owns the Contact
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the quotes that owns the company
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    // has many projects
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    protected static function booted()
    {
        // static::deleting(function ($item) {
        //     // $item->students()->delete();
        // });
    }
}
