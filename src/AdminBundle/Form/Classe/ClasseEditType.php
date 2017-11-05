<?php

namespace AdminBundle\Form\Classe;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use StatBundle\Entity\Classe;
use StatBundle\Entity\Faction;
use StatBundle\Entity\Team;

class ClasseEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Name'))
            ->add('description', TextareaType::class, array('required' => false, 'label' => 'Descritption'))
            ->add('goal', TextareaType::class, array('required' => false, 'label' => 'goal'))
            ->add('visible')
            ->add('faction', EntityType::class, array(
				'class'		 => 'StatBundle:Faction',
				'choice_label'	=> 'name',
				'multiple' => false,
				'expanded' => false,
				'required' => true,
				'label' => 'Faction'
			))
            ->add('team', EntityType::class, array(
                'class'		 => 'StatBundle:Team',
                'choice_label'	=> 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'label' => 'Team'
            ))->add('type', EntityType::class, array(
                'class'		 => 'StatBundle:Type',
                'choice_label'	=> 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'label' => 'Type'
            ))
            ->add('save', SubmitType::class, array('label' => 'edit'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StatBundle\Entity\Classe',
        ));
    }
}
