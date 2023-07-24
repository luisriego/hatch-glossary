<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Discipline;
use App\Entity\Glossary;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = Client::create('999', 'FAKE CLIENT');
        $manager->persist($client);

        $discipline = Discipline::create('999', 'FAKE DISCIPLINE');
        $manager->persist($discipline);

        $project = Project::create('H999999', 'FAKE PROJECT', $client);
        $manager->persist($project);

        $glossary = Glossary::create($discipline, $project);
        $glossary->setEn('crane');
        $glossary->setPt('ponte rolante');
        $manager->persist($glossary);

        $manager->flush();
    }
}
