<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use App\Service\DataChecker;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/car")
 */
class CarController extends AbstractController
{
    /**
     * @var DataChecker
     */
    private $dataChecker;
    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * CarController constructor.
     *
     * @param DataChecker $dataChecker
     * @param FileUploader $fileUploader
     */
    public function __construct(DataChecker $dataChecker,FileUploader $fileUploader)
    {
        $this->dataChecker = $dataChecker;
        $this->fileUploader = $fileUploader;
    }
    /**
     * @Route("/", name="car_index", methods={"GET"})
     * @Template()
     * @param CarRepository $carRepository
     *
     * @return array
     */
    public function index(CarRepository $carRepository): array
    {
        return [
            'cars' => $carRepository->findAll(),
        ];
    }

    /**
     * @param $id
     * @Route("/promote/{id}", name="car_promote", methods={"GET"})
     * @Template()
     *
     * @return RedirectResponse
     */
    public function promote($id): RedirectResponse
    {
        $car = $this->getCarRepository()->find($id);
        $result = $this->dataChecker->checkCar($car);
        if ($result) {
            $this->addFlash('success', 'Car promoted');
        } else {
            $this->addFlash('warning', 'Car not applicable');
        }


        return $this->redirectToRoute('car_index');
    }

    /**
     * @Route("/new", name="car_new", methods={"GET","POST"})
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form['image']->getData();
            if ($imageFile) {
                $imageFileName = $this->fileUploader->upload($imageFile);
                $car->setImage($imageFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/new.html.twig', [
            'car'  => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="car_show", methods={"GET"})
     * @param Car $car
     *
     * @return Response
     */
    public function show(Car $car): Response
    {
        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="car_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Car $car
     *
     * @return Response
     */
    public function edit(Request $request, Car $car): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form['image']->getData();
            if ($imageFile) {
                $imageFileName = $this->fileUploader->upload($imageFile);
                $car->setImage($imageFileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/edit.html.twig', [
            'car'  => $car,
            'form' => $form->createView(),
            'image' => $car->getImage()
        ]);
    }

    /**
     * @Route("/{id}", name="car_delete", methods={"DELETE"})
     * @param Request $request
     * @param Car $car
     *
     * @return Response
     */
    public function delete(Request $request, Car $car): Response
    {
        if ($this->isCsrfTokenValid('delete' . $car->getId(),
            $request->request->get('_token'))
        ) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car_index');
    }

    protected function getCarRepository()
    {
        return $this->getDoctrine()
            ->getRepository(Car::class);
    }
}
