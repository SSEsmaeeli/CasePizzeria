<?php

namespace App\Service;

use App\Order\OrderProvider;
use App\Order\OrderStatusUpdater;
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
        $order = $this->orderProvider->setData(
            $this->request->get('id'),
            $this->request->get('status')
        )->prepare()->getOrder();

        (new OrderValidator($this->validator, $order))
            ->validate();

        $this->orderStatusUpdater->handle();
    }

    public function setRequest(Request $request): static
    {
        $this->request = $request;

        return $this;
    }
}