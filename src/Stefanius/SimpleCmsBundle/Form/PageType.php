<?php

namespace Stefanius\SimpleCmsBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class);
        $builder->add('slug', TextType::class);
        $builder->add('body', CKEditorType::class);
        $builder->add('description', TextareaType::class);
        $builder->add('robotsIndex', CheckboxType::class);
        $builder->add('robotsFollow', CheckboxType::class);
    }
}
