<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Poste;
use AppBundle\Entity\Examen;
use AppBundle\Entity\Specialite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{

  public function load(ObjectManager $manager)
      {

        // $specialite = new Specialite();
        // $specialite->
        //   $examen = new Examen();
        //   $examen->set

              $poste1 = new Poste();
              $poste1->setObservation("Ingénieur principal");
              $poste1->setDiplome("Ingénieur principal");
              $manager->persist($poste1);
              $manager->flush();

              $poste2 = new Poste();
              $poste2->setObservation("technicien superieur informatique");
              $poste2->setDiplome("technicien superieur informatique");
              $manager->persist($poste2);
      }
}
