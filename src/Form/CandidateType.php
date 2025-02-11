<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Gender;
use DateTimeImmutable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'name',
                'required' => false,
                'attr' => [
                    'id' => 'gender',
                ],
                'label' => 'Gender',
                'label_attr' => [
                    'class' => 'active',
                ],
                'placeholder' => 'Choose an option...',
            ])

            ->add('firstName', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'first_name',
                ],
                'label' => 'First name',
            ])

            ->add('lastName', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'last_name',
                ],
                'label' => 'Last name',
            ])

            ->add('currentLocation', TextType::class, [
                'required' => false,
                'label' => 'Current location',
                'attr' => [
                    'id' => 'current_location',
                ],
            ])

            ->add('address', TextType::class, [
                'required' => false,
                'label' => 'Address',
                'attr' => [
                    'id' => 'address',
                ],
            ])

            ->add('country', TextType::class, [
                'required' => false,
                'label' => 'Country',
                'attr' => [
                    'id' => 'country',
                ],
            ])

            ->add('nationality', TextType::class, [
                'required' => false,
                'label' => 'Nationality',
                'attr' => [
                    'id' => 'nationality',
                ],
            ])

            ->add('birthDay', BirthdayType::class, [
                'required' => false,
                'label' => 'Birthdate',
                'attr' => [
                    'class' => 'datepicker',
                    'id' => 'birth_date',
                ],
                'label_attr' => [
                    'class' => 'datepicker',
                    'class' => 'active',
                    'format' => 'yyyy-MM-dd',
                ],
            ])

            ->add('birthPlace', TextType::class, [
                'required' => false,
                'label' => 'Birthplace',
                'attr' => [
                    'id' => 'birth_place',
                ],
            ])

            ->add('profilePicture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => '.jpg,.png,.gif,.jpeg',
                    'size' => 200000000,
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '200M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])

            ->add('passportPicture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.jpeg',
                    'size' => 200000000,
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '200M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])

            ->add('cvPicture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.jpeg',
                    'size' => 200000000,
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '200M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])

            ->addEventListener(FormEvents::POST_SUBMIT, $this->setUpdatedAt(...))
            ;
        }
        
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }

    public function setUpdatedAt(FormEvent $event): void
    {
        $candidate = $event->getData();
        $candidate->setUpdatedAt(new DateTimeImmutable());
    }
}

