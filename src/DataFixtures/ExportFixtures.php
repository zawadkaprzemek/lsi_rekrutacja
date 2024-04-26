<?php

namespace App\DataFixtures;

use App\Entity\Export;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExportFixtures extends Fixture
{
    const places = [
        'Gabinet Dyrektora', 'Sekretariat', 'Gabinet Prezesa', 'Bibioteka', 'Pokój 1', 'Pokój 2'
    ];


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0; $i < 40; $i++){
            $export = new Export();
            $export->setName('export_'.($i+1));
            $export->setDateTime($faker->dateTimeBetween('-60 days', '0 days'));
            $export->setUsername($faker->userName());
            $export->setPlace(self::places[$faker->numberBetween(0, count(self::places)-1)]);
            $manager->persist($export);
        }

        $manager->flush();
    }
}
