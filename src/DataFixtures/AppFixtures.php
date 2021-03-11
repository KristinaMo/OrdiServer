<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Reparation;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $c1 = new Category();
        $c1->setNomReparation('Apple');

        $manager->persist($c1);

        $v1 = new Ville();
        $v1->setNomReparation('Pessac');

        $manager->persist($v1);

        $r1 = new Reparation();
        $r1->setNom('Philippe Gerland')
            ->setPrix(30)
            ->setComment('CDR est la clinique du téléphone portable, smartphone, ordinateur
             PC et MAC')
            ->setImage('master.png')
            ->setContact(5569433566)
            ->setCategory($c1)
            ->setVille($v1)
        ;

        $manager->persist($r1);

        $c2 = new Category();
        $c2->setNomReparation('Dell, Toshiba, Leonova');

        $manager->persist($c2);

        $v2 = new Ville();
        $v2->setNomReparation('Bordeaux');

        $manager->persist($v2);

        $r2 = new Reparation();
        $r2->setNom('Marcel Lero')
            ->setPrix(50)
            ->setComment('Dépannage informatique, réparation dordinateur. Vent de PC')
            ->setImage('master1.png')
            ->setContact(5569433577)
            ->setCategory($c2)
            ->setVille($v2)
        ;

        $manager->persist($r2);

        $c3 = new Category();
        $c3->setNomReparation('Toutes marques');

        $manager->persist($c3);

        $v3 = new Ville();
        $v3->setNomReparation('Paris');

        $manager->persist($v3);

        $r3 = new Reparation();
        $r3->setNom('Mateo Messi')
            ->setPrix(40)
            ->setComment('Lordinateur toutes marques et réparation dimprimantes toutes marques et de parcs informatiques')
            ->setImage('master2.png')
            ->setContact(5569433588)
            ->setCategory($c3)
            ->setVille($v3)
        ;
        $manager->persist($r3);

        $c4 = new Category();
        $c4->setNomReparation('Asus, Dell, HP, Lenovo, Toshiba, Canon, Microsoft, Orange, Box Internet');

        $manager->persist($c4);

        $v4 = new Ville();
        $v4->setNomReparation('Libourne');

        $manager->persist($v4);

        $r4 = new Reparation();
        $r4->setNom('Avril Eddy')
            ->setPrix(35)
            ->setComment('Le dépannage à domicile de vos PC de bureau ou PC portables
            Du remplacement de tous vos composants défectueux
            De linstallation des antivirus')
            ->setImage('master3.png')
            ->setContact(5569433599)
            ->setCategory($c4)
            ->setVille($v4)
        ;

        $manager->persist($r4);

        $manager->flush();
    }
}
