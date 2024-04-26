<?php

namespace App\Form;

use App\Service\ExportService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExportFilterType extends AbstractType
{
    public function __construct(readonly ExportService $exportService)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('place', ChoiceType::class, ['attr' => ['class' => 'form-control'],
                'choices' => $this->prepareChoices(),
            ])
            ->add('date_from', DateType::class, ['label' => 'Data od', 'widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('date_to', DateType::class, ['label' => 'Data do', 'widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['label' => 'Zatwierdź', 'attr' => ['class' => 'btn btn-primary']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data' =>[
                'place' => null,
                'date_from' => (new \DateTime('-100 days'))->setTime(0, 0),
                'date_to' => (new \DateTime())->setTime(23,59, 99),
            ]
        ]);
    }

    private function prepareChoices()
    {
        $choices = ['Wszystkie' => null];
        foreach ($this->exportService->getAvailablePlaces() as $place) {
            $choices[$place['place']] = $place['place'];
        }
        return $choices;
    }

}
