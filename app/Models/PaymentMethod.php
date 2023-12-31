<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];


    protected $casts = [
        'is_default' => 'boolean',
        'is_enabled' => 'boolean',
        'is_gateway' => 'boolean',
    ];


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeWhereCompanyId($query, $id)
    {
        $query->where('company_id', $id);
    }

    public function scopeWhereCompany($query)
    {
        $query->where('company_id', request()->header('company'));
    }

    public function scopeWherePaymentMethod($query, $payment_id)
    {
        $query->orWhere('id', $payment_id);
    }

    public function scopeSearch($query, $search)
    {
        $query->where('name', 'LIKE', '%'.$search.'%');
    }

    public function scopeWhereSearch($query, $request)
    {
        $query->when($request->q, function ($query, $search) {
            $query->search($search);
        });
    }

    public function scopeApplyFilters($query, array $filters)
    {
        $filters = collect($filters);

        if ($filters->get('method_id')) {
            $query->wherePaymentMethod($filters->get('method_id'));
        }

        if ($filters->get('company_id')) {
            $query->whereCompany($filters->get('company_id'));
        }

        if ($filters->get('search')) {
            $query->whereSearch($filters->get('search'));
        }
    }

    public function scopePaginateData($query, $limit)
    {
        if ($limit == 'all') {
            return $query->get();
        }

        return $query->paginate($limit);
    }

    public static function createPaymentMethod($request)
    {
        $data = $request->getPaymentMethodPayload();

        $paymentMethod = self::create($data);

        return $paymentMethod;
    }

    
}
