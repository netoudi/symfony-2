<?php

namespace Code\CarBundle\Controller;

use Code\CarBundle\Entity\Car;
use Code\CarBundle\Entity\Manufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CarController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Car::class);

        $cars = $repo->findAll();

        if (!count($cars)) {
            $data = [
                'fiat' => [
                    '147',
                    '500',
                    'Brava',
                    'Bravo',
                    'Doblô',
                    'Ducato',
                    'Elba',
                    'Fiorino',
                    'Freemont',
                    'Grand Siena',
                    'Idea',
                    'Linea',
                    'Marea',
                    'Palio',
                    'Punto',
                    'Siena',
                    'Stilo',
                    'Strada',
                    'Tempra',
                    'Tipo',
                    'Uno',
                ],
                'chevrolet' => [
                    'A20',
                    'Agile',
                    'Astra',
                    'Blazer',
                    'Bonanza',
                    'C10',
                    'C14',
                    'C20',
                    'Calibra',
                    'Camaro',
                    'Captiva',
                    'Caravan',
                    'Celta',
                    'Chevette',
                    'Chevrolet 63',
                    'Cobalt',
                    'Corsa',
                    'Cruze',
                    'D10',
                    'D20',
                    'Grand Blazer',
                    'Impala',
                    'Ipanema',
                    'Kadett',
                    'Malibu',
                    'Meriva',
                    'Montana',
                    'Monza',
                    'Omega',
                    'Onix',
                    'Opala',
                    'Prisma',
                    'S10',
                    'Silverado',
                    'Sonic',
                    'Spin',
                    'Tracker',
                    'TrailBlazer',
                    'Vectra',
                    'Zafira',
                ],
                'ford' => [
                    '1418',
                    '29',
                    'Belina',
                    'Cargo',
                    'Corcel',
                    'Courier',
                    'Del Rey',
                    'Ecosport',
                    'Edge',
                    'Escort',
                    'F100',
                    'F1000',
                    'F2000',
                    'F250',
                    'F350',
                    'F4000',
                    'Fiesta',
                    'Focus',
                    'Ford - F4000',
                    'Fusion',
                    'Jeep',
                    'Ka',
                    'Mondeo',
                    'Mustang',
                    'Pampa',
                    'Ranger',
                    'TRANSIT',
                    'Verona',
                    'Versailles',
                ],
                'bmw' => [
                    '116',
                    '118',
                    '120',
                    '125',
                    '316',
                    '318',
                    '320',
                    '325',
                    '328',
                    '330',
                    '335',
                    '428',
                    '535i',
                    'F 650',
                    'F 800',
                    'G 650',
                    'GS',
                    'K 1200',
                    'K 1600',
                    'M235',
                    'M3',
                    'M6',
                    'R',
                    'R 1150',
                    'R 1200',
                    'S 1000',
                    'X1',
                    'X3',
                    'X4',
                    'X5',
                    'X6',
                    'Z4',
                ],
                'hyundai' => [
                    'Azera',
                    'Elantra',
                    'H100',
                    'HB20',
                    'HR',
                    'i30',
                    'I30 CW',
                    'ix35',
                    'Santa Fé',
                    'Sonata',
                    'Tucson',
                    'Tuscani',
                    'Veloster',
                    'Vera Cruz',
                ],
                'kia' => [
                    'Besta',
                    'Bongo',
                    'Cadenza',
                    'Carens',
                    'Cerato',
                    'K2500',
                    'Mohave',
                    'Optima',
                    'Picanto',
                    'Sorento',
                    'Soul',
                    'Sportage',
                ],
            ];

            $colors = [
                'Blue',
                'Black',
                'White',
                'Green',
                'Yellow',
            ];

            foreach ($data as $manufacturer => $models) {
                $newManufacturer = new Manufacturer();
                $newManufacturer->setName($manufacturer);

                foreach ($models as $model) {
                    $car = new Car();
                    $car->setModel($model);
                    $car->setYear(mt_rand(2000, 2016));
                    $car->setColor($colors[mt_rand(0, 4)]);
                    $car->setManufacturer($newManufacturer);

                    $newManufacturer->addCar($car);
                }

                $em->persist($newManufacturer);
                $em->flush();
            }

            $cars = $repo->findAll();
        }

        $repoManufacturer = $em->getRepository(Manufacturer::class);
        $manufacturers = $repoManufacturer->findAll();

        return array('cars' => $cars, 'manufacturers' => $manufacturers);
    }
}
