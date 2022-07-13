<?php

namespace App\Service;

use App\Traits\OrderStatusUpdateEventTrigger;
use App\Validator\OrderValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class OrderUpdaterService
{
    use OrderStatusUpdateEventTrigger;

    private OrderProvider $orderProvider;
    private ValidatorInterface $validator;
    private OrderStatusUpdater $orderStatusUpdater;
    private Request $request;

    public function __construct(
        OrderProvider $orderProvider,
        ValidatorInterface $validator,
        OrderStatusUpdater $orderStatusUpdater)
    {
        $this->orderProvider = $orderProvider;
        $this->validator = $validator;
        $this->orderStatusUpdater = $orderStatusUpdater;
    }

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $order = $this->orderProvider->findOrder($this->request->get('id'))
            ->setOrderStatus($this->request->get('status'))
            ->getOrder();

        (new OrderValidator($this->validator, $order))
            ->validate();

        $this->orderStatusUpdater->handle();

        $this->triggerOrderStatusUpdate($order);
    }

    public function setRequest(Request $request): static
    {
        $this->request = $request;

        return $this;
    }
}