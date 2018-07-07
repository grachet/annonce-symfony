<?php

namespace OC\PlatformBundle\Form;

use OC\PlatformBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {


    $builder
      ->add('date',      DateTimeType::class)
      ->add('title',     TextType::class)
      ->add('author',    TextType::class)
        ->add('mail',    TextType::class)
      ->add('content',   CkeditorType::class)
      ->add('image',     ImageType::class, array('required' => false, 'label' => false))
      ->add('categories', EntityType::class, array(
        'class'         => 'OCPlatformBundle:Category',
        'choice_label'  => 'name',
          'multiple'      => true,
        'expanded'      => true,

          'choice_label' => function ($currencies) {
              /** @var Currencies $currencies */
              return $currencies->getName() . "                ";
          }
      ))
      ->add('Publier',      SubmitType::class)
    ;


    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,
      function(FormEvent $event) {

        $advert = $event->getData();


        if (null === $advert) {
          return;
        }


        if (!$advert->getPublished() || null === $advert->getId()) {

          $event->getForm()->add('published', CheckboxType::class, array('required' => false));
        } else {

          $event->getForm()->remove('published');
        }
      }
    );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'OC\PlatformBundle\Entity\Advert'
    ));
  }
}
