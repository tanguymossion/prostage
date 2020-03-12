<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Stage;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCourt')
            ->add('nomLong')
            ->add('mesStages',EntityType::class,
                ['class' => Stage::class,
                'choice_label' => function(Stage $stage),
                {
                    return $stage->getTitre() . " : " . $stage->getMonEntreprise();
                },
                'multiple' => true,
                'expanded' => true,
                'label' => 'Stages disponibles'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
