<?php namespace Fastwebmedia\LaravelVouchering\Repositories;

use Fastwebmedia\LaravelVouchering\Models\Voucher;

class VoucherRepository
{
    /**
     * @var Voucher
     */
    protected $model;

    /**
     * Constructs models.
     *
     * @param Voucher $model
     */
    public function __construct(Voucher $model)
    {
        $this->model = $model;
    }

    /**
     * getVoucher function.
     *
     * @access public
     *
     * @param string $hash
     *
     * @return Voucher
     */
    public function getVoucher($hash)
    {
        return $this->model->where('hash', '=', $hash)->first();
    }

    /**
     * redeemVoucher function.
     *
     * @access public
     *
     * @param string $hash
     *
     * @return Voucher
     */
    public function redeemVoucher($hash)
    {
        if ($voucher = $this->model->where('hash', '=', $hash)->first()) {
            $voucher->is_redeemed = 1;
            $voucher->redeemed_at = date('Y-m-d H:i:s');

            if ($voucher->save()) {
                return $voucher;
            }
        }

        return false;
    }

    /**
     * expireVoucher function.
     *
     * @access public
     *
     * @param string $hash
     *
     * @return Voucher
     */
    public function expireVoucher($hash)
    {
        if ($voucher = $this->model->where('hash', '=', $hash)->first()) {
            $voucher->is_expired = 1;
            $voucher->expired_at = date('Y-m-d H:i:s');

            if ($voucher->save()) {
                return $voucher;
            }
        }

        return false;
    }

    /**
     * checkExpiry function.
     *
     * @access public
     *
     * @param date $date
     * @param int  $days
     *
     * @return boolean
     */
    public function checkExpiry($date, $days)
    {
        $expiry_date = date('Y-m-d H:i:s', strtotime($date.' + '.$days.' days'));

        if (date('Y-m-d H:i:s') > $expiry_date) {
            return true;
        }

        return false;
    }
}
