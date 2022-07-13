<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\OrderRepositoryInterface;
use App\Contract\PizzaRepositoryInterface;
use App\Entity\Order;
use App\Enum\OrderStatus;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderSaver
{
    private $orderRepository;

    private $order;

    private $validator;

    private $pizzaRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, PizzaRepositoryInterface $pizzaRepository, ValidatorInterface $validator)
    {
        $this->orderRepository = $orderRepository;
        $this->pizzaRepository = $pizzaRepository;
        $this->validator = $validator;
    }

    public function handle()
    {
        $this->orderRepository->store($this->order);
    }

    public function prepare($request)
    {
        $order = new Order();
        $order->setBodem($request->get('bodem'));
        $order->setTopping($request->get('topping'));
        $order->setStatus(OrderStatus::BESTELLING_ONTVANGEN->value);
        $order->setPizza($this->getPizzaInstance($request->get('pizza_id')));
        $this->order = $order;
        return $this;
    }

    public function validate()
    {
        $errors = $this->validator->validate($this->order);

        if(count($errors)) {
            throw new \Exception(
                (string) $errors
            );
        }

        return $this;
    }

    private function getPizzaInstance($pizzaId)
    {
        return $this->pizzaRepository->findById($pizzaId);
    }
}
