<?php namespace Fastwebmedia\LaravelVouchering\models;

class Campaign extends \Eloquent
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
        return $this->hasMany('Vouchers\Voucher', 'entry_id', 'id');
    }
}
