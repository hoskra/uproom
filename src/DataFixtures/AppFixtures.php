<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Room;
use App\Entity\Building;
use App\Entity\User;
use App\Entity\UserGroup;
use App\Entity\Reservation;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // USERS //
        $user1 = new User(); $user2 = new User(); $user3 = new User(); $user4 = new User(); $user5 = new User(); $user6 = new User(); $user7 = new User(); $user8 = new User(); $user9 = new User(); $user10 = new User();
        $user1->setName("Brumbal");
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'brumbal'));
        $user2->setName("Geralt");
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'geralt'));
        $user3->setName("Kara");
        $user3->setPassword($this->passwordEncoder->encodePassword($user2, 'kara'));
        $user4->setName("Jaina");
        $user4->setPassword($this->passwordEncoder->encodePassword($user4, 'jaina'));
        $user5->setName("Lux");
        $user5->setPassword($this->passwordEncoder->encodePassword($user5, 'Lux'));
        $user6->setName("Ferda");
        $user6->setPassword($this->passwordEncoder->encodePassword($user6, 'ferda'));
        $user7->setName("Kazma");
        $user7->setPassword($this->passwordEncoder->encodePassword($user7, 'kazma'));
        $user8->setName("CJ");
        $user8->setPassword($this->passwordEncoder->encodePassword($user8, 'cj'));
        $user9->setName("Algernon");
        $user9->setPassword($this->passwordEncoder->encodePassword($user9, 'algernon'));
        $user10->setName("Escher");
        $user10->setPassword($this->passwordEncoder->encodePassword($user9, 'escher'));

        // ADMIN //
        $admin = new User();
        $admin->setName("admin");
        $admin->setSuperuser(true);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'heslo' ));
        $manager->persist($admin);

        // BUILDINGS AND ROOMS //
        $building1 = new Building();
        $building1->setName("Vysoká");
        $building2 = new Building();
        $building2->setName("Široká");

        $room1 = new Room();
        $room1->setName("404");
        $room2 = new Room();
        $room2->setName("23");
        $room3 = new Room();
        $room3->setName("666");

        $room1->setBuilding($building1);
        $room2->setBuilding($building1);
        $room3->setBuilding($building2);

        $building1->addRoom($room1);
        $building1->addRoom($room2);
        $building2->addRoom($room3);

        $manager->persist($room1);
        $manager->persist($room2);
        $manager->persist($room3);
        $manager->persist($building1);
        $manager->persist($building2);

        // GROUPS //
        $group1 = new UserGroup();
        $group1->setName("FIT");
        $group1->setManager($user1);
        $group1->addMember($user2);
        $group1->addMember($user3);
        $group2 = new UserGroup();
        $group2->setName("FA");
        $group2->setManager($user5);
        $group2->addMember($user6);

        $user1->setGroupManager($group1);

        $user2->addMemberOfGroup($group1);
        $user3->addMemberOfGroup($group1);

        $user5->setGroupManager($group2);
        $user6->addMemberOfGroup($group2);

        $manager->persist($group1);
        $manager->persist($group2);


        $manager->persist($user1); $manager->persist($user2); $manager->persist($user3); $manager->persist($user4); $manager->persist($user5); $manager->persist($user6); $manager->persist($user7); $manager->persist($user8); $manager->persist($user9); $manager->persist($user10);


        // REZERVATIONS //
        $reservation1 = new Reservation();
        $reservation1->setCreatedBy($user1);
        $reservation1->setTargetUser($user1);
        $reservation1->setRoom($room1);
        $reservation1->setDate(\DateTime::createFromFormat('Y-m-d', "2020-02-02"));


        $manager->flush();
    }
}

/*

sqlite3 uproom.db < delete_from_tables.sql && bin/console doctrine:fixtures:load --append

*/