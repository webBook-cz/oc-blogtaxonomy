<?php namespace WebBook\BlogTaxonomy\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ExtendTables extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function($table) {
            $table->engine = 'InnoDB';    
            $table->integer('author_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('rainlab_blog_posts', function($table) {
            $table->dropColumn('author_id');           
        });
    }

}
