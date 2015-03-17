<?php namespace Fastwebmedia\LaravelVouchering\core\Repositories;

use \Fastwebmedia\LaravelVouchering\models\Voucher;

class VoucherRepository
{
    /**
     * @var Voucher
     */
    protected $model;

    public function __construct()
    {
        $this->model = New Voucher;
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
        if ($voucher = $this->model->where('hash', '=', $hash)->first()):
            $voucher->is_redeemed = 1;
            $voucher->redeemed_at = date('Y-m-d H:i:s');
            if ($voucher->save()):
                    return $voucher;
            endif;
        endif;

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
        if ($voucher = $this->model->where('hash', '=', $hash)->first()):
            $voucher->is_expired = 1;
            $voucher->expired_at = date('Y-m-d H:i:s');
            if ($voucher->save()):
                    return $voucher;
            endif;
        endif;

        return false;
    }
}
