<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model", inversedBy="cars")
     */
    private $model;

    /**
     * @var Vendor
     *
     * @ORM\ManyToOne(targetEntity="Vendor", inversedBy="cars")
     */
    private $vendor;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="boolean")
     */
    private $navigation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getVendor()
    {
        return $this->vendor;
    }

    public function setVendor(string $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getNavigation()
    {
        return $this->navigation;
    }

    public function setNavigation($navigation): self
    {
        $this->navigation = $navigation;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
