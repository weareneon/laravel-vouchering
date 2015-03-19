<?php namespace Fastwebmedia\LaravelVouchering\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'voucher_campaigns';
    protected $fillable = [
        'name',
        'brand',
        'urn',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    public function vouchers()
    {
        return $this->hasMany('Fastwebmedia\LaravelVouchering\Models\Voucher', 'entry_id', 'id');
    }
}
