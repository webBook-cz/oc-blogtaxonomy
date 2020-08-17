<?php

namespace WebBook\BlogTaxonomy\Components;

use RainLab\Blog\Models\Post;
use WebBook\BlogTaxonomy\Plugin;
use WebBook\BlogTaxonomy\Models\Series;
use WebBook\BlogTaxonomy\Classes\PostListAbstract;

/**
 * Class SeriesPosts
 *
 * @package WebBook\BlogTaxonomy\Components
 */
class SeriesPosts extends PostListAbstract
{
    const NAME = 'postsInSeries';

    /**
     * @var Series
     */
    public $series;

    /**
     * @return array
     */
    public function componentDetails(): array
    {
        return [
            'name'        => Plugin::LOCALIZATION_KEY . 'components.series_posts.name',
            'description' => Plugin::LOCALIZATION_KEY . 'components.series_posts.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties(): array
    {
        return [
            'series' => [
                'title'       => Plugin::LOCALIZATION_KEY . 'components.series_posts.series_title',
                'description' => Plugin::LOCALIZATION_KEY . 'components.series_posts.series_description',
                'type'        => 'string',
                'default'     => '{{ :series }}',
            ],
        ] + parent::defineProperties();
    }

    /**
     * @inheritDoc
     */
    protected function prepareContextItem()
    {
        // load series
        $this->series = Series::whereTranslatable('slug', $this->property('series'))->first();

        return $this->series;
    }

    /**
     * @return mixed
     */
    protected function getPostsQuery()
    {
        $query = Post::whereHas('series', function ($query) {
            $query->whereTranslatable('slug', $this->series->slug);
        })->isPublished();

        return $query;
    }
}
