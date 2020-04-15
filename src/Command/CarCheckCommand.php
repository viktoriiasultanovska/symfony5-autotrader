<?php

namespace App\Command;

use App\Repository\CarRepository;
use App\Service\DataChecker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CarCheckCommand
 * @package App\Command
 */
class CarCheckCommand extends Command
{
    protected static $defaultName = 'app:car-check';

    /** @var CarRepository */
    private $carRepository;

    /** @var DataChecker */
    private $dataChecker;

    /**
     * CarCheckCommand constructor.
     *
     * @param CarRepository $carRepository
     * @param DataChecker $dataChecker
     * @param string|null $name
     */
    public function __construct(
        CarRepository $carRepository,
        DataChecker $dataChecker,
        string $name = null
    ) {
        parent::__construct($name);
        $this->carRepository = $carRepository;
        $this->dataChecker = $dataChecker;
    }

    protected function configure()
    {
        $this->setDescription('Car checker')
            ->addArgument('format', InputArgument::OPTIONAL, 'Progress Format')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Checks cars');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);

        $cars = $this->carRepository->findAll();

        $progressBar = new ProgressBar($io, count($cars));
        $progressBar->setFormat($input->getArgument('format'));
        $progressBar->start();

        foreach ($cars as $car) {
            $promoted = $this->dataChecker->checkCar($car);
            sleep(2);
            $message = 'Checking car %s';
            if ($promoted){
                $io->success(sprintf($message, $car->getVendor() . ' ' . $car->getModel()));
            } else {
                $io->warning(sprintf($message, $car->getVendor() . ' ' . $car->getModel()));
            }
            $progressBar->advance();
        }
        $progressBar->finish();

        return 0;
    }
}
