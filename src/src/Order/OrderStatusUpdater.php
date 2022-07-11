<?php

namespace App\Order;

use App\Contract\OrderRepositoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderStatusUpdater
{
    private OrderRepositoryInterface $orderRepository;

    private ValidatorInterface $validator;

    private string $requestedStatus;

    private int $orderId;

    private $order;

    public function __construct(OrderRepositoryInterface $orderRepository, ValidatorInterface $validator)
    {
        $this->orderRepository = $orderRepository;
        $this->validator = $validator;
    }

    /**
     * @throws \Exception
     */
    public function handle($orderId, $status)
    {
        $this->orderId = $orderId;
        $this->requestedStatus = $status;

        $this->prepare()
            ->validate()
            ->execute();
    }

    private function prepare(): static
    {
        $this->order = $this->orderRepository->findById($this->orderId);

        if(! $this->order) {
            throw new \Exception(
                'No order found!'
            );
        }

        $this->order->setStatus($this->requestedStatus);

        return $this;
    }

    private function validate(): static
    {
        $errors = $this->validator->validate($this->order);

        if (count($errors) > 0) {
            throw new \Exception(
                'Whoops... Something is wrong!'
            );
        }

        return $this;
    }

    private function execute()
    {
        $this->orderRepository->update();
    }
}