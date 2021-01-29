<?php

namespace App\Repositories\Payment;

use App\Payment;
use App\Repositories\BaseRepository;

class PaymentRepository extends BaseRepository implements PaymentInterface
{
    /**
     * @var ModelName
     */
    protected $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function getAllPayment()
    {
        return $this->model->all();
    }

    public function getPaymentId($id)
    {
        return $this->model->find($id);
    }

    public function createOrUpdate($id = null, $data)
    {
        if (is_null($id)) {
            $payment = $this->model->create($data);
            return $payment;
        } else {
            $payment = $this->model->find($id);
            return $payment->update($data);
        }
    }

    public function deletePayment($id)
    {
        return $this->model->destroy($id);
    }
}
