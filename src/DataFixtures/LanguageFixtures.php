<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $languages = [
            'React.js',
            'Vue.js',
            'Angular',
            'Symfony',
            'Laravel',
            'Django',
            'Flask',
            'Express.js',
            'Ruby on Rails',
            'ASP.NET Core',
            'JavaScript',
            'TypeScript',
            'PHP',
            'Python',
            'Ruby',
            'Java',
            'C#',
            'Swift',
            'Go',
            'Dart'
        ];

        foreach ($languages as $name) {
            $language = new Language();
            $language->setName($name);
            $manager->persist($language);
        }

        $manager->flush();
    }
}
