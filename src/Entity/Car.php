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
     * @ORM\ManyToOne(targetEntity="App\Entity\Model", inversedBy="cars")
     */
    private $model;

    /**
     * @var Vendor
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Vendor", inversedBy="cars")
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

    /**
     * @ORM\Column(type="boolean")
     */
    private $promote;

    /**
     * @ORM\Column(type="string")
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set model
     *
     * @param Model $model
     *
     * @return Car
     */
    public function setModel(Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set vendor
     *
     * @param Vendor $model
     *
     * @return Car
     */
    public function setVendor(Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
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

    public function getPromote()
    {
        return $this->promote;
    }

    public function setPromote($promote)
    {
        $this->promote = $promote;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
