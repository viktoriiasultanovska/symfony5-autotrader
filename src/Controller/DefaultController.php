<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Car;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/our-cars", name="offer")
     */
    public function index()
    {
        $cars = $this->getCarRepository()->findCarsWithDetails();

        return $this->render('index.html.twig', [
            'cars' => $cars
        ]);
    }

    /**
     * @Route("/car/{id}", name="show_car")
     */
    public function show($id)
    {
        $car = $this->getCarRepository()->find($id);

        if (!$car) {
            throw $this->createNotFoundException(
                'No car found for id ' . $id
            );
        }

        return $this->render('show.html.twig', [
            'car' => $car
        ]);
    }

    protected function getCarRepository()
    {
        return $this->getDoctrine()
            ->getRepository(Car::class);
    }
}