<?php

namespace WebBook\BlogTaxonomy\Classes\MigrationCommand;

/**
 * Class MigrationInterface
 *
 * @package WebBook\BlogTaxonomy\Classes\MigrationCommand
 */
interface MigrationInterface
{
    /**
     * @return void
     */
    public function migrate();
}