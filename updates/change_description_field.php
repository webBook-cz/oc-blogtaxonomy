<?php

namespace Webbook\BlogTaxonomy\Updates;

use Schema;
use Webbook\BlogTaxonomy\Models\Series;
use October\Rain\Database\Updates\Migration;

/**
 * Class ChangeDescriptionField
 *
 * @package Webbook\BlogTaxonomy\Updates
 */
class ChangeDescriptionField extends Migration
{
    /**
     * Execute migrations
     */
    public function up()
    {
        if (Schema::hasTable(Series::TABLE_NAME)) {
            Schema::table(Series::TABLE_NAME, static function ($table) {
                $table->text('description')->nullable()->change();
            });
        }
    }

    /**
     * Rollback migrations
     */
    public function down()
    {
        if (Schema::hasTable(Series::TABLE_NAME)) {
            Schema::table(Series::TABLE_NAME, static function ($table) {
                $table->string('description')->nullable()->change();
            });
        }
    }
}
