<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarType
 * @package App\Form
 */
class CarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price')
            ->add('year')
            ->add('navigation')
            ->add('description', TextareaType::class)
            ->add('model')
            ->add('vendor')
            ->add('promote')
            ->add(
                'image',
                HiddenType::class,
                [
                    'data_class' => null,
                    // make it optional so you don't have to re-upload the image file
                    // every time you edit the Car details
                    'required' => true,
                ]
            )
            ->add(
                'image_file',
                FileType::class,
                [
                    'label' => 'Photo (png, jpeg)',
                    'mapped' => false,
                    'required' => false
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
