<?php
/**
 *
 */
namespace AppBundle\Form\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;

class FieldsDefaultValueEventSubscriber implements EventSubscriberInterface {
    public static function getSubscribedEvents(){
        return [
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }
    public function preSubmit(FormEvent $event){
        $form = $event->getForm();
        $data = $event->getData();
        $formData = $form->getData();

        if($formData->getId()){

            $propertyAccessor = PropertyAccess::createPropertyAccessor();

            foreach ($form->all() as $item) {
                $fieldName = $item->getName();
                $fieldPropertyPath = $item->getPropertyPath();
                $passed = $item->getConfig()->getAttribute('data_collector/passed_options');
                $attr = isset($passed['attr']) ? $passed['attr'] : [];

                if($attr) {
                    if (isset($attr['readonly']) && $attr['readonly']) {
                        $data[$fieldName] = $propertyAccessor->getValue($formData, $fieldPropertyPath);
                    }
                }

            }

            //dump($form);

            $data['url'] = $formData->getUrl();
            $event->setData($data);
        }


    }
}