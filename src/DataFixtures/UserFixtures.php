<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user0 = new User();
        $user0->setName("RobertBenesTMP");
        $user0->setPassword($this->passwordEncoder->encodePassword($user0, 'RobertBenes'));
        $manager->persist($user0);
        $user1 = new User();
        $user1->setName("JanNovakTMP");
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'JanNovak'));
        $manager->persist($user1);
        $user2 = new User();
        $user2->setName("RobertMoudryTMP");
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'RobertMoudry'));
        $manager->persist($user2);
        $user4 = new User();
        $user4->setName("DavidMichalTMP");
        $user4->setPassword($this->passwordEncoder->encodePassword($user4, 'DavidMichal'));
        $manager->persist($user4);
        $user5 = new User();
        $user5->setName("ZdenekVasutTMP");
        $user5->setPassword($this->passwordEncoder->encodePassword($user5, 'ZdenekVasut'));
        $manager->persist($user5);
        $user6 = new User();
        $user6->setName("IgorDvorakTMP");
        $user6->setPassword($this->passwordEncoder->encodePassword($user6, 'IgorDvorak'));
        $manager->persist($user6);
        $user7 = new User();
        $user7->setName("IgorSvobodaTMP");
        $user7->setPassword($this->passwordEncoder->encodePassword($user7, 'IgorSvoboda'));
        $manager->persist($user7);
        $user8 = new User();
        $user8->setName("JanCernyTMP");
        $user8->setPassword($this->passwordEncoder->encodePassword($user8, 'JanCerny'));
        $manager->persist($user8);
        $user9 = new User();
        $user9->setName("RobertKrejciTMP");
        $user9->setPassword($this->passwordEncoder->encodePassword($user9, 'RobertKrejci'));
        $manager->persist($user9);
        $user10 = new User();
        $user10->setName("DavidVeselyTMP");
        $user10->setPassword($this->passwordEncoder->encodePassword($user10, 'DavidVesely'));
        $manager->persist($user10);
        $user11 = new User();
        $user11->setName("ZdenekKuceraTMP");
        $user11->setPassword($this->passwordEncoder->encodePassword($user11, 'ZdenekKucera'));
        $manager->persist($user11);
        $user12 = new User();
        $user12->setName("IgorNovotnyTMP");
        $user12->setPassword($this->passwordEncoder->encodePassword($user12, 'IgorNovotny'));
        $manager->persist($user12);
        $user13 = new User();
        $user13->setName("RobertNemecTMP");
        $user13->setPassword($this->passwordEncoder->encodePassword($user13, 'RobertNemec'));
        $manager->persist($user13);
        $user14 = new User();
        $user14->setName("DavidProchazkaTMP");
        $user14->setPassword($this->passwordEncoder->encodePassword($user14, 'DavidProchazka'));
        $manager->persist($user14);
        $user15 = new User();
        $user15->setName("ZdenekPokornyTMP");
        $user15->setPassword($this->passwordEncoder->encodePassword($user15, 'ZdenekPokorny'));
        $manager->persist($user15);
        $user16 = new User();
        $user16->setName("IgorFialaTMP");
        $user16->setPassword($this->passwordEncoder->encodePassword($user16, 'IgorFiala'));
        $manager->persist($user16);
        $user17 = new User();
        $user17->setName("IgorRuzickaTMP");
        $user17->setPassword($this->passwordEncoder->encodePassword($user17, 'IgorRuzicka'));
        $manager->persist($user17);
        $user18 = new User();
        $user18->setName("JanJelinekTMP");
        $user18->setPassword($this->passwordEncoder->encodePassword($user18, 'JanJelinek'));
        $manager->persist($user18);

        $user10 = new User();
        $user10->setName("RobertBenes");
        $user10->setPassword($this->passwordEncoder->encodePassword($user10, 'admin'));
        $manager->persist($user10);
        $user11 = new User();
        $user11->setName("JanNovak");
        $user11->setPassword($this->passwordEncoder->encodePassword($user11, 'admin'));
        $manager->persist($user11);
        $user12 = new User();
        $user12->setName("RobertMoudry");
        $user12->setPassword($this->passwordEncoder->encodePassword($user12, 'admin'));
        $manager->persist($user12);
        $user14 = new User();
        $user14->setName("DavidMichal");
        $user14->setPassword($this->passwordEncoder->encodePassword($user14, 'admin'));
        $manager->persist($user14);
        $user15 = new User();
        $user15->setName("ZdenekVasut");
        $user15->setPassword($this->passwordEncoder->encodePassword($user15, 'admin'));
        $manager->persist($user15);
        $user16 = new User();
        $user16->setName("IgorDvorak");
        $user16->setPassword($this->passwordEncoder->encodePassword($user16, 'admin'));
        $manager->persist($user16);
        $user17 = new User();
        $user17->setName("IgorSvoboda");
        $user17->setPassword($this->passwordEncoder->encodePassword($user17, 'admin'));
        $manager->persist($user17);
        $user18 = new User();
        $user18->setName("JanCerny");
        $user18->setPassword($this->passwordEncoder->encodePassword($user18, 'admin'));
        $manager->persist($user18);
        $user19 = new User();
        $user19->setName("RobertKrejci");
        $user19->setPassword($this->passwordEncoder->encodePassword($user19, 'admin'));
        $manager->persist($user19);
        $user110 = new User();
        $user110->setName("DavidVesely");
        $user110->setPassword($this->passwordEncoder->encodePassword($user110, 'admin'));
        $manager->persist($user110);
        $user111 = new User();
        $user111->setName("ZdenekKucera");
        $user111->setPassword($this->passwordEncoder->encodePassword($user111, 'admin'));
        $manager->persist($user111);
        $user112 = new User();
        $user112->setName("IgorNovotny");
        $user112->setPassword($this->passwordEncoder->encodePassword($user112, 'admin'));
        $manager->persist($user112);
        $user113 = new User();
        $user113->setName("RobertNemec");
        $user113->setPassword($this->passwordEncoder->encodePassword($user113, 'admin'));
        $manager->persist($user113);
        $user114 = new User();
        $user114->setName("DavidProchazka");
        $user114->setPassword($this->passwordEncoder->encodePassword($user114, 'admin'));
        $manager->persist($user114);
        $user115 = new User();
        $user115->setName("ZdenekPokorny");
        $user115->setPassword($this->passwordEncoder->encodePassword($user115, 'admin'));
        $manager->persist($user115);
        $user116 = new User();
        $user116->setName("IgorFiala");
        $user116->setPassword($this->passwordEncoder->encodePassword($user116, 'admin'));
        $manager->persist($user116);
        $user117 = new User();
        $user117->setName("IgorRuzicka");
        $user117->setPassword($this->passwordEncoder->encodePassword($user117, 'admin'));
        $manager->persist($user117);
        $user118 = new User();
        $user118->setName("JanJelinek");
        $user118->setPassword($this->passwordEncoder->encodePassword($user118, 'admin'));
        $manager->persist($user118);

        $admin_user0 = new User();
        $admin_user0->setName("admin");
        $admin_user0->setPassword($this->passwordEncoder->encodePassword(
            $admin_user0,
            'heslo'
        ));
        $manager->persist($admin_user0);

        $admin_user1 = new User();
        $admin_user1->setName("admin1");
        $admin_user1->setPassword($this->passwordEncoder->encodePassword(
            $admin_user1,
            'heslo'
        ));
        $manager->persist($admin_user1);

        $admin_user2 = new User();
        $admin_user2->setName("admin2");
        $admin_user2->setPassword($this->passwordEncoder->encodePassword(
            $admin_user2,
            'heslo'
        ));
        $manager->persist($admin_user2);

        $manager->flush();

        $admin_user3 = new User();
        $admin_user3->setName("admin3");
        $admin_user3->setPassword($this->passwordEncoder->encodePassword(
            $admin_user3,
            'heslo'
        ));
        $manager->persist($admin_user3);

        $manager->flush();

        $admin_user4 = new User();
        $admin_user4->setName("admin4");
        $admin_user4->setPassword($this->passwordEncoder->encodePassword(
            $admin_user4,
            'heslo'
        ));
        $manager->persist($admin_user4);

        $manager->flush();
    }
}

// bin/console doctrine:fixtures:load --append