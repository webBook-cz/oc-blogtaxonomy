<?php namespace WebBook\BlogTaxonomy\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateWebbookBlogtaxonomyRelatedPosts extends Migration
{
    public function up()
    {
        Schema::create('webbook_blogtaxonomy_related_posts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('related_post_id');
            $table->integer('post_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('webbook_blogtaxonomy_related_posts');
    }
}
