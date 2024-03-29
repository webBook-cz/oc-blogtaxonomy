<?php

namespace WebBook\BlogTaxonomy\Updates;

use Schema;
use WebBook\BlogTaxonomy\Models\Series;
use October\Rain\Database\Updates\Migration;

/**
 * Class AddStatusColumn
 *
 * @package WebBook\BlogTaxonomy\Updates
 */
class AddSeriesStatusColumn extends Migration
{
    /**
     * Execute migrations
     */
    public function up()
    {
        if (Schema::hasTable(Series::TABLE_NAME)) {
            Schema::table(Series::TABLE_NAME, static function ($table) {
                $table->string('status')->default(Series::STATUS_ACTIVE);
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
                $table->dropColumn('status');
            });
        }
    }
}
