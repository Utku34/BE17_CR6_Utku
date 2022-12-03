<?php
namespace App\Form;

use App\Entity\Status;
use App\Entity\Todo;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["attr"=>["placeholder"=>"please type the todo name", "class"=>"form-control mb-2"]])
            ->add('description', TextareaType::class,["attr"=>["placeholder"=>"please type the todo name", "class"=>"form-control mb-2", "id"=>"name"]])
            ->add('category', TextType::class, ["attr"=>["placeholder"=>"category", "class"=>"form-control mb-2"]])
            ->add('priority', ChoiceType::class,[
                'choices'  => [
                    "movie"=>"movie",
                    "sport"=>"sport",
                    "music" => "music",
                    "theater" => "theater"
                ]
                , "attr"=> ["class"=>"form-control"]]
                )
            ->add('fk_status', EntityType::class, [
                // looks for choices from this entity
                'class' => Status::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'attr' => array("class"=>"form-control")
                  # []
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            
            ->add('date', DateTimeType::class, ["attr"=>[ "class"=>"form-control mb-2"]])
            ->add('picture', FileType::class, [
                'label' => 'Image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid picture document',
                    ])
                ],
            ])
            ->add('Save', SubmitType::class, ["attr"=>[ "class"=>"btn btn-primary"]])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class
        ]);
    }
}