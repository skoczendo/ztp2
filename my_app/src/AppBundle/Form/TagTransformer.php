<?php
/**
 * Tags data transformer.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Tag;
use AppBundle\Repository\TagRepository;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class TagTransformer.
 *
 * @package AppBundle\Form
 */
class TagTransformer implements DataTransformerInterface
{
    /**
     * Tag repository.
     *
     * @var TagRepository|null $tagRepository
     */
    protected $tagRepository = null;

    /**
     * TagTransformer constructor.
     *
     * @param TagRepository $tagRepository Tag repository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Transform array of tags to string of names.
     *
     * @param array $tags Tags entity array
     *
     * @return string Result
     */
    public function transform($tags)
    {
        if (null == $tags) {
            return '';
        }

        $tagNames = [];

        foreach ($tags as $tag) {
            $tagNames[] = $tag->getName();
        }

        return implode(',', $tagNames);
    }

    /**
     * Transform string of tag names into array of Tag entities.
     *
     * @param string $string String of tag names
     *
     * @return array Result
     */
    public function reverseTransform($string)
    {
        $tagNames = explode(',', $string);

        $tags = [];
        foreach ($tagNames as $tagName) {
            if (trim($tagName) !== '') {
                $tag = $this->tagRepository->findOneByName($tagName);
                if (null == $tag) {
                    $tag = new Tag();
                    $tag->setName($tagName);
                    $this->tagRepository->save($tag);
                }
                $tags[] = $tag;
            }
        }

        return $tags;
    }
}