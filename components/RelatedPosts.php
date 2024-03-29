<?php

namespace WebBook\BlogTaxonomy\Components;

use DB;
use Cms\Classes\Page;
use RainLab\Blog\Models\Post;
use WebBook\BlogTaxonomy\Plugin;
use WebBook\BlogTaxonomy\Models\Tag;
use October\Rain\Database\Collection;
use WebBook\BlogTaxonomy\Models\ModelAbstract;
use WebBook\BlogTaxonomy\Classes\PostListAbstract;
use WebBook\BlogTaxonomy\Classes\ComponentAbstract;
use WebBook\BlogTaxonomy\Classes\TranslateArrayTrait;

/**
 * Class RelatedPosts
 *
 * @package WebBook\BlogTaxonomy\Components
 */
class RelatedPosts extends ComponentAbstract
{
    const NAME = 'relatedPosts';

    use TranslateArrayTrait;

    /**
     * @var Collection | array
     */
    public $posts = [];

    /**
     * Reference to the page name for linking to posts
     *
     * @var string
     */
    public $postPage;

    /**
     * If the post list should be ordered by another attribute
     *
     * @var string
     */
    public $orderBy;

    /**
     * Limits the number of records to display
     *
     * @var int
     */
    public $limit;

    /**
     * Component Registration
     *
     * @return  array
     */
    public function componentDetails()
    {
        return [
            'name'        => Plugin::LOCALIZATION_KEY . 'components.related_posts.name',
            'description' => Plugin::LOCALIZATION_KEY . 'components.related_posts.description'
        ];
    }

    /**
     * Component Properties
     *
     * @return  array
     */
    public function defineProperties()
    {
        return [
            'slug' => [
                'title'             => Plugin::LOCALIZATION_KEY . 'components.related_posts.post_slug_title',
                'description'       => Plugin::LOCALIZATION_KEY . 'components.related_posts.post_slug_description',
                'default'           => '{{ :slug }}',
                'type'              => 'string'
            ],

            'limit' => [
                'title'             => Plugin::LOCALIZATION_KEY . 'components.related_posts.limit_title',
                'description'       => Plugin::LOCALIZATION_KEY . 'components.related_posts.limit_description',
                'type'              => 'string',
                'default'           => '0',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => Plugin::LOCALIZATION_KEY . 'components.related_posts.limit_validation_message',
                'showExternalParam' => false
            ],

            'orderBy' => [
                'title'       => 'rainlab.blog::lang.settings.posts_order',
                'description' => 'rainlab.blog::lang.settings.posts_order_description',
                'type'        => 'dropdown',
                'default'     => 'published_at asc',
                'showExternalParam' => false
            ],

            'postPage' => [
                'group'       => Plugin::LOCALIZATION_KEY . 'components.related_posts.links_group',
                'title'       => 'rainlab.blog::lang.settings.posts_post',
                'description' => 'rainlab.blog::lang.settings.posts_description',
                'type'        => 'dropdown',
                'default'     => 'blog/post',
            ],
        ];
    }

    /**
     * @see PostListAbstract::$postAllowedSortingOptions
     *
     * @return mixed
     */
    public function getOrderByOptions()
    {
        $order = $this->translate(
            array_merge(
                [
                    'relevance asc' => Plugin::LOCALIZATION_KEY . 'order_options.relevance_asc',
                    'relevance desc' => Plugin::LOCALIZATION_KEY . 'order_options.relevance_desc'
                ],
                PostListAbstract::$postAllowedSortingOptions
            )
        );

        asort($order);

        return $order;
    }

    private function prepareVars()
    {
        $this->orderBy = $this->page['orderBy'] = $this->property('orderBy');

        // Page links
        $this->postPage = $this->page['postPage' ] = $this->property('postPage');
    }

    public function getPostPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Load post and start building query for related posts
     */
    public function onRun()
    {
        //Prepare vars
        $this->prepareVars();

        $this->posts = $this->loadRelatedPosts();
    }

    /**
     * Load related posts by common tags
     *
     * @return mixed
     */
    private function loadRelatedPosts()
    {
        $post = Post::with('tags');

        ModelAbstract::whereTranslatableProperty($post, 'slug', $this->property('slug'));

        $post = $post->first();

        if (!$post) {
            return null;
        }

        if ($post->relatedPosts->lists('id')) {
            $query = Post::isPublished()
                ->whereIn('id', $post->relatedPosts->lists('id'));
    
            if ($take = (int)$this->property('limit')) {
                $query->take($take);
            }
    
            $posts = $query->get();
    
            $this->setPostUrls($posts);
    
            return $posts;
        }

        if (!$post->tags->lists('id')) {
            $categoryds = $post->categories->lists('id');

            $query = Post::isPublished()
                ->whereHas('categories', function ($tag) use ($categoryds) {
                    $tag->whereIn('id', $categoryds);
                })->inRandomOrder();
    
            if ($take = (int)$this->property('limit')) {
                $query->take($take);
            }
    
            $posts = $query->get();
    
            $this->setPostUrls($posts);
    
            return $posts;
        }

        $tagIds = $post->tags->lists('id');

        $query = Post::isPublished()
            ->where('id', '<>', $post->id)
            ->whereHas('tags', function ($tag) use ($tagIds) {
                $tag->whereIn('id', $tagIds);
            })
            ->with('tags');

        $this->queryOrderBy($query, $tagIds);

        if ($take = (int)$this->property('limit')) {
            $query->take($take);
        }

        $posts = $query->get();

        $this->setPostUrls($posts);

        if (count($posts) == 0) {
            $categoryds = $post->categories->lists('id');

            $query = Post::isPublished()
                ->whereHas('categories', function ($tag) use ($categoryds) {
                    $tag->whereIn('id', $categoryds);
                })->inRandomOrder();
    
            if ($take = (int)$this->property('limit')) {
                $query->take($take);
            }
    
            $posts = $query->get();
    
            $this->setPostUrls($posts);
    
            return $posts;
        }

        return $posts;
    }

    /**
     * @param $query
     * @param $tagIds
     */
    private function queryOrderBy($query, $tagIds)
    {
        if (array_key_exists($this->orderBy, $this->getOrderByOptions())) {
            if ($this->orderBy === 'random') {
                $query->inRandomOrder();
            } else {
                list($sortField, $sortDirection) = explode(' ', $this->orderBy);

                if ($sortField === 'relevance') {
                    $sortField = DB::raw(
                        sprintf(
                            '(
                                select count(*)
                                from `%1$s`
                                where `%1$s`.`post_id` = `rainlab_blog_posts`.`id`
                                and `%1$s`.`tag_id` in (%2$s)
                            )',
                            Tag::CROSS_REFERENCE_TABLE_NAME,
                            DB::getPdo()->quote(implode(', ', $tagIds))
                        )
                    );
                }

                $query->orderBy($sortField, $sortDirection);
            }
        }
    }
}
