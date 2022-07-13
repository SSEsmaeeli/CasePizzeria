<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contract\OrderRepositoryInterface;
use App\Contract\PizzaRepositoryInterface;
use App\Enum\OrderStatus;
use App\Service\OrderProvider;
use App\Service\OrderSaver;
use App\Service\OrderUpdaterService;
use App\Validator\OrderValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends  AbstractController
{
    public function index(PizzaRepositoryInterface $pizzaRepository, OrderRepositoryInterface $orderRepository): Response
    {
        $pizzas = $pizzaRepository->get();
        $orders = $orderRepository->get();

        return $this->render('client/order_index.html.twig', compact('pizzas', 'orders'));
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
    public function store(Request $request, ValidatorInterface $validator, OrderProvider $orderProvider, OrderSaver $orderSaver): RedirectResponse
    {
        $order = $orderProvider->createOrder($request)
            ->getOrder();

        (new OrderValidator($validator, $order))
            ->validate();

        $orderSaver->handle($order);

        return $this->redirectToRoute('order_index');
    }

    /**
     * @throws \Exception
     */
    public function updateStatus(Request $request, OrderUpdaterService $orderUpdaterService): RedirectResponse
    {
        $orderUpdaterService->setRequest($request)
            ->handle();

        return $this->redirectToRoute('admin_order_index');
    }
}
