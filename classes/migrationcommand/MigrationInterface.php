<?php

namespace Webbook\BlogTaxonomy\Classes\MigrationCommand;

/**
 * Class MigrationInterface
 *
 * @package Webbook\BlogTaxonomy\Classes\MigrationCommand
 */
interface MigrationInterface
{
    /**
     * @return void
     */
    public function migrate();
}