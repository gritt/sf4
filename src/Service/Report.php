<?php

namespace App\Service;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Report
 * @package App\Service
 */
class Report
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * Report constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }


    /**
     * @return array
     */
    public function getTagsByProducts(): array
    {
        try {

            $tags = $this->findTags();

            $tagNames = [];
            $tagProductsNumber = [];

            /** @var Tag $tag */
            foreach ($tags as $tag) {
                $tagNames[] = $tag->getName();
                $tagProductsNumber[] = $tag->getProducts()->count();
            }

            return [
                'status' => 'success',
                'message' => 'report built successfully',
                'data' => [
                    'tagsNames' => $tagNames,
                    'tagProductsNumber' => $tagProductsNumber,
                ]
            ];

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function findTags(): array
    {
        $tags = $this->entityManager->getRepository('App:Tag')->findAll();

        if (empty($tags)) {
            throw new \Exception('ProductReport Error: Could not find any tags');
        }

        return $tags;
    }
}