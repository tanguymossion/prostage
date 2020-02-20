<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Form\EntrepriseType;
use App\Entity\Formation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description',TextareaType::class)
            ->add('email',EmailType::class)
            ->add('monEntreprise',EntrepriseType::class)
            ->add('mesFormations',EntityType::class,
            ['class' => Formation::class,
            'choice_label' => 'nomLong',
            'multiple' => true,
            'expanded' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
