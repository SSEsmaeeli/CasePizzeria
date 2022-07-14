<?php

namespace App\Tests\Order;
use App\OrderStatus\BestellingOntvangen;
use App\Service\OrderStatusHandler;
use PHPUnit\Framework\TestCase;

class OrderStatusHandlerTest extends TestCase
{
    private OrderStatusHandler $orderStatusHandler;

    /**
     * @test
     */
    public function status_is_valid()
    {
        $status = BestellingOntvangen::VALUE;

        $this->initOrderStatusHandlerAndSetStatusTo($status);

        $this->assertEquals($status, $this->orderStatusHandler->getStatusInstance()->getValue());
    }

    /**
     * @test
     */
    public function throw_exception_over_invalid_status()
    {
        $orderStatusHandler = new OrderStatusHandler();

        $this->expectException(
            \Exception::class
        );

        $orderStatusHandler->setStatus('non valid status');
    }

    /**
     * @test
     */
    public function check_next_value()
    {
        $status = BestellingOntvangen::VALUE;
        $this->initOrderStatusHandlerAndSetStatusTo($status);

        $this->assertEquals(BestellingOntvangen::NEXT, $this->orderStatusHandler->getStatusInstance()->next());
    }

    /**
     * @test
     */
    public function check_action_values()
    {
        $status = BestellingOntvangen::VALUE;
        $this->initOrderStatusHandlerAndSetStatusTo($status);

        $this->assertEquals(BestellingOntvangen::ACTIONS, $this->orderStatusHandler->getStatusInstance()->actions());
    }

    private function initOrderStatusHandlerAndSetStatusTo($status)
    {
        $this->orderStatusHandler = new OrderStatusHandler();
        $this->orderStatusHandler->setStatus($status);
    }
}