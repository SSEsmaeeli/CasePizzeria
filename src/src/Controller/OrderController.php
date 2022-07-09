<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contract\PizzaRepositoryInterface;
use App\Entity\Pizza;
use App\Order\OrderSaver;
use App\Repository\PizzaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends  AbstractController
{
//    private $pizzaRepository;
//
//    public function __construct(ManagerRegistry $doctrine)
//    {
//        $this->pizzaRepository = $doctrine->getRepository(Pizza::class);
//    }

    public function index(PizzaRepositoryInterface $pizzaRepository): Response
    {
        $pizzas = $pizzaRepository->get();

        return $this->render('client/order_index.html.twig', compact('pizzas'));
    }

    public function store(Request $request, OrderSaver $orderSaver)
    {
        $orderSaver->setData($request)
            ->validate()
            ->handle();

        return $this->json('done!');
    }
}
