<?php namespace Fastwebmedia\LaravelVouchering\models;

class Campaign extends \Eloquent
{
    protected $table = 'voucher_campaigns';
    protected $fillable = [
        'name',
        'code',
        'type',
        'api_route',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    public function vouchers()
    {
        return $this->hasMany('Vouchers\Voucher', 'entry_id', 'id');
    }

    /**
     * getByUrn function.
     *
     * @access public
     *
     * @param string $campaignUrn
     *
     * @return Campaign
     */
    public function getByUrn($campaignUrn)
    {
        return $this->where('urn', '=', $campaignUrn)->first();
    }
}
