<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $formationDUTInfo = new Formation();
        $formationDUTInfo->setNom("DUT Informatique");

        $manager->persist($formationDUTInfo);

        $manager->flush();
    }
}
