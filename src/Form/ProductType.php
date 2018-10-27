<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class ProductType
 * @package App\Form
 */
class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please, inform a title'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 4000,
                        'minMessage' => 'The description must have be at least 2 characters long',
                        'maxMessage' => 'The description cannot be longer than 4000 characters'
                    ])
                ]
            ])
            ->add('image', FileType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please, upload the image brochure as a PNG or JPEG file.'
                    ]),
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Sorry, unsupported extension'
                    ])
                ]
            ])
            ->add('stock', IntegerType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Please, define the stock amount'
                    ]),
                    new GreaterThan(0),
                ]
            ])
            ->add('tags');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
