<?php

namespace Stefanius\SimpleCmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class);
        $builder->add('slug', TextType::class);
        $builder->add('body', TextareaType::class);
        $builder->add('description', TextareaType::class);
        $builder->add('robotsIndex', CheckboxType::class);
        $builder->add('robotsFollow', CheckboxType::class);
    }
}