<?php namespace Fastwebmedia\LaravelVouchering\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher_entries';
    protected $fillable = [
        'hash',
        'campaign_id',
        'is_redeemed',
        'is_expired',
        'is_valid',
    ];

    public function campaign()
    {
        return $this->hasOne('Fastwebmedia\LaravelVouchering\Models\Campaign', 'id', 'campaign_id');
    }

    /**
     * getExpiryDate function.
     *
     * @access public
     *
     * @param int $days
     *
     * @return date
     */
    public function getExpiryDate($days = false)
    {
        if (! $days) {
            $days = $this->campaign->expiry_limit;
        }

        return $expiryDate = date('Y-m-d H:i:s', strtotime($this->created_at.' + '.$days.' days'));
    }
}
