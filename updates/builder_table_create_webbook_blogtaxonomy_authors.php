<?php namespace WebBook\Authors\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateWebbookBlogTaxonomyAuthors extends Migration
{
    public function up()
    {
        Schema::create('webbook_blogtaxonomy_authors', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('name');
            $table->text('surname');
            $table->text('mail')->nullable();
            $table->text('function')->nullable();
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->text('facebook')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('webbook_blogtaxonomy_authors');
    }
}
