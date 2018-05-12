<?php

namespace RoCloud\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class IngameAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userid')
            ->add('userPass', PasswordType::class)
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Male' => 'M',
                    'Female' => 'F',
                ],
            ]);
    }
}
