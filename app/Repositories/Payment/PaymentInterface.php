<?php

namespace App\Repositories\Payment;

interface PaymentInterface
{
    public function getAllPayment();

    public function getPaymentId($id);

    public function createOrUpdate($id = null, $data);

    public function deletePayment($id);
}
