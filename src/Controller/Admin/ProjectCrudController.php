<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $LanguageField = AssociationField::new('languages', 'languages')
                                             ->onlyOnForms()
                                             ->setFormTypeOptions([
                                                 'by_reference' => false,
                                                 'multiple' => true,
                                                 'class' => Language::class,
                                                 'choice_label' => 'name',
                                                 'required' => 'true',
                                             ]);

        if (Crud::PAGE_DETAIL === $pageName) {
            $LanguageField = ArrayField::new('languages', 'Languages')
                                           ->onlyOnDetail();
        }

        if (Crud::PAGE_INDEX === $pageName) {
            $LanguageField = CollectionField::new('languages', 'Languages')
                                                ->onlyOnIndex();
        }

        $fields = [
            TextField::new('name', 'Nom'),
            ImageField::new('imagePath')->setUploadDir('public/upload/thumbnail')->setBasePath('upload'),
            AssociationField::new('category', 'Catégorie')
                            ->setRequired(true),
            $LanguageField,
        ];

        if (in_array($pageName, [Crud::PAGE_DETAIL, Crud::PAGE_NEW, Crud::PAGE_EDIT])) {
            $fields[] = DateField::new('startedAt', 'Date de début')->setFormTypeOption('input', 'datetime');
            $fields[] = DateField::new('finishedAt', 'Date de fin')->setFormTypeOption('input', 'datetime');
            $fields[] = DateField::new('createdAt', 'Date de création')->onlyOnDetail();
            $fields[] = DateField::new('updatedAd', 'Date de modification')->onlyOnDetail();
            $fields[] = TextField::new('imagePath', 'Lien');
            $fields[] = TextEditorField::new('description');
        }

        return $fields;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Project) {
            return;
        }

        $now = new \DateTime();
        $entityInstance->setCreatedAt($now);
        $entityInstance->setUpdatedAt($now);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Project) return;

        $entityInstance->setUpdatedAt(new \DateTime());
        parent::updateEntity($entityManager, $entityInstance);
    }


    public function configureActions(Actions $actions): Actions
    {
        $viewAction = Action::new('view', 'Voir')
                            ->linkToCrudAction(Action::DETAIL)
                            ->setIcon('fa fa-eye');

        return $actions
            ->add(Crud::PAGE_INDEX, $viewAction)
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('Modifier');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('Supprimer');
            });
    }

}
