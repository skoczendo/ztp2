<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;
use AppBundle\Repository\TagRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DataTagTransformer implements DataTransformerInterface
{

    public function transform($tags)
    {
        dump($tags);
        $result = '';
        foreach ($tags as $tag) {
            $result .= $tag->getName().', ';
        }
        return $result;
    }


    public function reverseTransform($value)
    {
        dump('reverse transform');
        dump($value);
        return $value;
    }
}