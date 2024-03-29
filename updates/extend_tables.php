<?php namespace Webbook\BlogTaxonomy\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ExtendTables extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function($table) {
            $table->engine = 'InnoDB';    
            $table->integer('webbook_blogtaxonomy_series_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('rainlab_blog_posts', function($table) {
            $table->dropColumn('webbook_blogtaxonomy_series_id');           
        });
    }

}
