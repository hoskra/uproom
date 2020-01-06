<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Room;
use App\Entity\Building;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $room1 = new Room();
        $building1 = new Building();

        $room1->setName("404");
        $building1->setName("FIT");
                
        $room1ss->addBuilding($building1);
        $building1->addRoom(room1);

        $manager->persist($room1);
        $manager->persist($building1);

        $manager->flush();
    }
}
