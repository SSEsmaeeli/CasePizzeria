<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use App\Service\OrderStatusHandler;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    private OrderStatusHandler $orderStatusHandler;
    private array $actions = [];
    private string $next;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Pizza::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    /**
     * @Assert\NotBlank
     */
    private $pizza;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $bodem;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $topping;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPizza(): ?Pizza
    {
        return $this->pizza;
    }

    public function setPizza(?Pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    public function getBodem(): ?string
    {
        return $this->bodem;
    }

    public function setBodem(string $bodem): self
    {
        $this->bodem = $bodem;

        return $this;
    }

    public function getTopping(): ?string
    {
        return $this->topping;
    }

    public function setTopping(string $topping): self
    {
        $this->topping = $topping;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNext(): string
    {
        return $this->next;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function setStatusStuff()
    {
        $this->orderStatusHandler = new OrderStatusHandler();
        $this->orderStatusHandler->setStatus($this->getStatus());
        $this->actions = $this->generateActions();
        $this->next = $this->generateNext();
    }

    public function generateActions(): array
    {
        return $this->orderStatusHandler->getStatusInstance()->actions();
    }

    public function generateNext()
    {
        return $this->orderStatusHandler->getStatusInstance()->next();
    }
}
