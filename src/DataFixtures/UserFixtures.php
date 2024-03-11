<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserFixtures extends AbstractFixture
{
    public function __construct(
        private PasswordHasherInterface $passwordHasher,
    ) {
    }

    public function getEntityClass(): string
    {
        return User::class;
    }

    public function loadData(): iterable
    {
        yield [
            'email'    => 'test@test',
            'password' => $this->passwordHasher->hash('test')
        ];
    }

    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
    }
}
