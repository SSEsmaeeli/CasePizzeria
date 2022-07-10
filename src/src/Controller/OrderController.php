<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contract\OrderRepositoryInterface;
use App\Contract\PizzaRepositoryInterface;
use App\Enum\OrderStatus;
use App\Order\OrderSaver;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends  AbstractController
{
    public function index(PizzaRepositoryInterface $pizzaRepository): Response
    {
        $pizzas = $pizzaRepository->get();

        return $this->render('client/order_index.html.twig', compact('pizzas'));
    }

    public function adminIndex(OrderRepositoryInterface $orderRepository): Response
    {
        $orderAvailableStatus = OrderStatus::cases();
        $orders = $orderRepository->get();
        return $this->render('admin/order_index.html.twig', compact('orderAvailableStatus', 'orders'));
    }

    /**
     * @throws \Exception
     */
    public function store(Request $request, OrderSaver $orderSaver): JsonResponse
    {
        $orderSaver->prepare($request)
            ->validate()
            ->handle();

        return $this->json('done!');
    }

    public function updateStatus(Request $request)
    {
        return $this->json($request->get('status'));
    }
}
