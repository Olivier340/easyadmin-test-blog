<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
         //   IdField::new('id'),
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('slug')->hideOnForm(),
            TextEditorField::new('content'),
            DateField::new('createdAt')->hideOnForm(),
           // TextField::new('category'),
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdAt' => 'DESC']);
    }
 
}
