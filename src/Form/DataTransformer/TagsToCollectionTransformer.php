<?php

namespace App\Form\DataTransformer;
 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Collections\ArrayCollection;
 
class TagsToCollectionTransformer implements DataTransformerInterface
{
 
    private $manager;
 
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
 
    public function transform($tags)
    {
        return $tags;
    }
 
    public function reverseTransform($tags)
    {
        $tagCollection = new ArrayCollection();
 
        
 
        foreach ($tags as $tag) {
            $tagsRepository = $this->manager
                ->getRepository('App:Tag');
 
            $tagInRepo = $tagsRepository->findOneByName($tag->getName());
 
            if ($tagInRepo !== null) {
                $tagCollection->add($tagInRepo);
            }
            else {
                $tagCollection->add($tag);
            }
        }
 
        return $tagCollection;
    }
 
}