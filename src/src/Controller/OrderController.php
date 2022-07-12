<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contract\OrderRepositoryInterface;
use App\Contract\PizzaRepositoryInterface;
use App\Enum\OrderStatus;
use App\Order\OrderSaver;
use App\Order\OrderStatusUpdater;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\OrderStatusUpdateEventTrigger;

class OrderController extends  AbstractController
{
    use OrderStatusUpdateEventTrigger;

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
    public function store(Request $request, OrderSaver $orderSaver): RedirectResponse
    {
        $orderSaver->prepare($request)
            ->validate()
            ->handle();

        return $this->redirectToRoute('order_index');
    }

    /**
     * @throws \Exception
     */
    public function updateStatus(Request $request, OrderStatusUpdater $orderStatusUpdater): RedirectResponse
    {
        $order = $orderStatusUpdater->handle(
            $request->get('id'),
            $request->get('status')
        )->getOrder();

        $this->triggerOrderStatusUpdate($order);

        return $this->redirectToRoute('admin_order_index');
    }
}
