<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Car;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/our-cars", name="offer")
     */
    public function index(Request $request)
    {
        $cars = $this->getCarRepository()->findCarsWithDetails();

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        return $this->render('index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/car/{id}", name="show_car")
     */
    public function show($id)
    {
        $car = $this->getCarRepository()->findCarsWithDetailsById($id);

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