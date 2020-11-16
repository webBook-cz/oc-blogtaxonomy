<?php namespace Webbook\BlogTaxonomy\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ExtendTables2 extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function($table) {
            $table->engine = 'InnoDB';    
            $table->boolean('hide_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('rainlab_blog_posts', function($table) {
            $table->dropColumn('hide_date');           
        });
    }

}