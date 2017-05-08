<?php
/**
 * Bookmark type.
 */
namespace AppBundle\Form;
use AppBundle\Entity\Bookmark;
use AppBundle\Form\EventListener\FieldsDefaultValueEventSubscriber;
use AppBundle\Repository\TagRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Tag;
/**
 * Class BookmarkType.
 *
 * @package AppBundle\Form
 */
class BookmarkType extends AbstractType
{
    protected $tagRepository = null;
    public function __construct(TagRepository $repository)
    {
        $this->tagRepository = $repository;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'url',
            TextType::class,
            [
                'label' => 'label.url',
                'required' => true,
                'attr' => [
                    'max_length' => 255,
                    'readonly' => (isset($options['data']) && $options['data']->getId()),
                ],
            ]
        );
        $builder->add(
            'tags',
            TextType::class,
            [
//                'class' => Tag::class,
//                'choice_label' => function ($tag) {
//                    return $tag->getName();
//                },
//                'label' => 'label.tag',
//                'required' => false,
//                'expanded' => true,
//                'multiple' => true,
                'label' => 'label.tag',
                'required' => true,
            ]
        );
        $builder->get('tags')->addModelTransformer(
            new TagTransformer($this->tagRepository)
        );
/*
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $formData = $form->getData();

                if($formData->getId()){
                    $data['url'] = $formData->getUrl();
                    $event->setData($data);
                }


                dump($form);
                dump($data);
                dump($formData);
            }
        );
*/
        $builder->addEventSubscriber(
            new FieldsDefaultValueEventSubscriber()
        );

    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Bookmark::class,
                'validation_groups' => 'bookmark-default',
            ]
        );
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bookmark_type';
    }
}