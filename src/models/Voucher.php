<?php namespace Fastwebmedia\LaravelVouchering\models;

class Voucher extends \Eloquent
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
        return $this->hasOne('Vouchers\Campaign', 'id', 'campaign_id');
    }

    /**
     * generateHash function.
     *
     * @access public
     *
     * @return string $hash
     */
    public function generateHash()
    {
        $uniqueCode = false;

        do {
            $hash = md5(uniqid(rand(), true));

            //check if hash exists
            if (! $this::where('hash', '=', $hash)->first()):
                $uniqueCode = true;
            endif;
        } while ($uniqueCode == false);

        return $hash;
    }

    /**
     * checkExpiry function.
     *
     * @access public
     *
     * @param int $days
     *
     * @return boolean
     */
    protected function checkExpiry($days = 14)
    {
        $expiryDate = date('Y-m-d H:i:s', strtotime( $this->created_at . ' + ' .$days. ' days'));

        if (date('Y-m-d H:i:s') > $expiryDate):
            return true;
        endif;

        return false;
    }
}
