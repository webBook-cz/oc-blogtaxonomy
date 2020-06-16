<?php

namespace Webbook\BlogTaxonomy\Classes;

/**
 * Trait TranslateArrayTrait
 *
 * @package Webbook\BlogTaxonomy\Classes
 */
trait TranslateArrayTrait
{
    /**
     * Calls e(trans()) for every item to support translation
     *
     * @param string[] $items
     *
     * @return array
     */
    public function translate(array $items): array
    {
        return array_map(function(string $item) {
            return e(trans($item));
        }, $items);
    }
}