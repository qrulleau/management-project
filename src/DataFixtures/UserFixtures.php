<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
    ) {
    }

    public function getEntityClass(): string
    {
        return User::class;
    }

    public function loadData(ObjectManager $manager): iterable
    {
        yield [
            'name'    => 'test',
            'password' => $this->passwordEncoder->hashPassword(new User(), 'test')
        ];
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->loadData($manager) as $data) {
            $user = new User();
            $user->setName($data['name']);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($data['password']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
