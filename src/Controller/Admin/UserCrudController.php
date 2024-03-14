<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('password'),
            ChoiceField::new('roles', 'Rôles')
                       ->setChoices([
                           'ROLE_USER' => 'ROLE_USER',
                           'ROLE_ADMIN' => 'ROLE_ADMIN',
                       ])
                       ->allowMultipleChoices(true)
                       ->setFormTypeOption('choice_translation_domain', 'messages')
        ];
    }

}
