<?php

namespace Webbook\BlogTaxonomy;

use Event;
use Backend;
use Lang;
use System\Classes\PluginBase;
use Backend\Classes\Controller;
use Webbook\BlogTaxonomy\Models\Tag;
use Webbook\BlogTaxonomy\Models\Series;
use Backend\Behaviors\RelationController;
use RainLab\Blog\Models\Post as PostModel;
use Webbook\BlogTaxonomy\Components\TagList;
use Webbook\BlogTaxonomy\Components\TagPosts;
use Webbook\BlogTaxonomy\Components\SeriesList;
use Webbook\BlogTaxonomy\Components\SeriesPosts;
use Webbook\BlogTaxonomy\Components\RelatedPosts;
use Webbook\BlogTaxonomy\Components\RelatedSeries;
use Webbook\BlogTaxonomy\Console\MigrateFromPlugin;
use RainLab\Blog\Controllers\Posts as PostsController;
use Webbook\BlogTaxonomy\Components\SeriesNavigation;
use RainLab\Blog\Controllers\Categories as CategoriesController;

/**
 * Class Plugin
 *
 * @package Webbook\BlogTaxonomy
 */
class Plugin extends PluginBase
{
    const LOCALIZATION_KEY = 'webbook.blogtaxonomy::lang.';

    const DIRECTORY_KEY = 'webbook/blogtaxonomy';

    const REQUIRED_PLUGIN_RAINLAB_BLOG = 'RainLab.Blog';

    /**
     * @var array   Require the RainLab.Blog plugin
     */
    public $require = [
        'RainLab.Blog'
    ];

    /**
     * Returns information about this plugin
     *
     * @return  array
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => self::LOCALIZATION_KEY . 'plugin.name',
            'description' => self::LOCALIZATION_KEY . 'plugin.description',
            'author'      => 'Webbook',
            'icon'        => 'icon-tags',
            'homepage'    => ''
        ];
    }

    /**
     * Register components
     *
     * @return  array
     */
    public function registerComponents(): array
    {
        return [
            TagList::class          => TagList::NAME,
            TagPosts::class         => TagPosts::NAME,
            RelatedPosts::class     => RelatedPosts::NAME,
            SeriesList::class       => SeriesList::NAME,
            SeriesPosts::class      => SeriesPosts::NAME,
            SeriesNavigation::class => SeriesNavigation::NAME,
            RelatedSeries::class    => RelatedSeries::NAME
        ];
    }

    /**
     *
     */
    public function register()
    {
        $this->registerConsoleCommand(MigrateFromPlugin::NAME, MigrateFromPlugin::class);
    }

    /**
     * Boot method, called right before the request route
     */
    public function boot()
    {
        // extend the post model
        $this->extendModel();

        // extend posts functionality
        $this->extendPostsController();

        // extend categories functionality
        $this->extendCategoriesController();

        // Extend all backend list usage
        Event::listen('backend.list.extendColumns', function($widget) {

            // Only for the User controller
            if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\Blog\Models\Post) {
                return;
            }

            // Add an extra series column
            $widget->addColumns([
                'webbook_blogtaxonomy_series_id' => [
                    'label' => 'Obor',
                    'relation' => 'series',
                    'select' => 'title',
                ]
            ]);
        });

        \RainLab\Blog\Controllers\Posts::extendListFilterScopes(function($filter) {
            $filter->addScopes([
                'series' => [
                    'label' => 'Obory',
                    'modelClass' => 'Webbook\BlogTaxonomy\Models\Series',
                    'conditions' => 'id in (select id from rainlab_blog_posts where webbook_blogtaxonomy_series_id in (:filtered))',
                    'nameFrom' => 'title',         
                ]
            ]);
        });

        // Extend all backend form usage
        Event::listen('backend.form.extendFields', function($widget) {

            // Only for the User controller
            if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\Blog\Models\Post) {
                return;
            }
        });

        // Extend all backend form usage
        Event::listen('backend.form.extendFields', function($widget) {

            // Only for the User controller
            if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Categories) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\Blog\Models\Category) {
                return;
            }

            // Add an extra posts field
            $widget->addFields([
                'posts' => [
                    'label'   => Lang::get('webbook.blogtaxonomy::lang.form.fields.posts'),
                    'path' => '~/plugins/webbook/blogtaxonomy/controllers/category/_field_posts.htm',
                    'type'    => 'partial'
                ]
            ]);
        });
    }

    /**
     * Register plugin navigation
     */
    public function registerNavigation()
    {
        // Extend the navigation
        Event::listen('backend.menu.extendItems', function ($manager) {
            $manager->addSideMenuItems(self::REQUIRED_PLUGIN_RAINLAB_BLOG, 'blog', [
                'series' => [
                    'label' => self::LOCALIZATION_KEY . 'navigation.series',
                    'icon' => 'icon-list-alt',
                    'code' => 'series',
                    'owner' => self::REQUIRED_PLUGIN_RAINLAB_BLOG,
                    'url' => Backend::url(self::DIRECTORY_KEY . '/series')
                ],

                'tags' => [
                    'label' => self::LOCALIZATION_KEY . 'navigation.tags',
                    'icon'  => 'icon-tags',
                    'code'  => 'tags',
                    'owner' => self::REQUIRED_PLUGIN_RAINLAB_BLOG,
                    'url'   => Backend::url(self::DIRECTORY_KEY . '/tags')
                ]
            ]);
        });
    }

    /**
     * Extend RainLab Post model
     */
    private function extendModel()
    {
        PostModel::extend(function ($model) {
            $model->morphToMany = [
                'tags' => [Tag::class, 'name' => Tag::PIVOT_COLUMN]
            ];

            $model->belongsTo['series'] = [
                Series::class,
                'key' => Series::TABLE_NAME . "_id"
            ];
        });
    }

    /**
     * Extends post controller functionality
     */
    private function extendPostsController()
    {
        PostsController::extendFormFields(function ($form, $model) {
            if (!$model instanceof PostModel) {
                return;
            }

            /*
             * When extending the form, you should check to see if $formWidget->isNested === false
             * as the Repeater FormWidget includes nested Form widgets which can cause your changes
             * to be made in unexpected places.
             *
             * @link https://octobercms.com/docs/plugin/extending#extending-backend-form
             */
            if (!empty($form->isNested)) {
                return;
            }
            
            $tab = self::LOCALIZATION_KEY . 'navigation.taxonomy';

            $categoriesConfig = $form->getField('categories')->config;
            $categoriesConfig['tab'] = $tab;
            $categoriesConfig['mode'] = 'relation';
            $categoriesConfig['type'] = 'taglist';
            $categoriesConfig['label'] = 'rainlab.blog::lang.post.tab_categories';
            $categoriesConfig['comment'] = "rainlab.blog::lang.post.categories_comment";
            $categoriesConfig['placeholder'] = self::LOCALIZATION_KEY . 'placeholders.categories';
            unset($categoriesConfig['commentAbove']);

            $form->removeField('categories');

            $form->addSecondaryTabFields([
                'categories' => $categoriesConfig,
                'tags' => [
                    'label' => self::LOCALIZATION_KEY . 'form.tags.label',
                    'comment' => self::LOCALIZATION_KEY . 'form.tags.comment_post',
                    'mode' => 'relation',
                    'tab' => $tab,
                    'type' => 'taglist',
                    'placeholder' => self::LOCALIZATION_KEY . 'placeholders.tags',
                ],
                'series' => [
                    'label' => self::LOCALIZATION_KEY . 'form.series.label',
                    'tab' => $tab,
                    'type' => 'relation',
                    'nameFrom' => 'title',
                    'comment' => self::LOCALIZATION_KEY . 'form.series.comment',
                    // October CMS has a bug with displaying of placeholders without an explicit empty option
                    // https://github.com/octobercms/october/pull/4060
                    'placeholder' => self::LOCALIZATION_KEY . 'placeholders.series',
                    'emptyOption' => self::LOCALIZATION_KEY . 'placeholders.series'
                ],
            ]);
        });
    }

    /**
     * Extends categories controller functionality
     */
    private function extendCategoriesController()
    {
        CategoriesController::extend(function (Controller $controller) {
            $controller->implement[] = RelationController::class;
            $relationConfig = '$/' . self::DIRECTORY_KEY . '/controllers/category/config_relation.yaml';

            if (property_exists($controller, 'relationConfig')) {
                $controller->relationConfig = $controller->mergeConfig(
                    $controller->relationConfig,
                    $relationConfig
                );
            } else {
                $controller->addDynamicProperty('relationConfig', $relationConfig);
            }

            $formConfig = '$/' . self::DIRECTORY_KEY . '/controllers/category/config_form.yaml';

            if (property_exists($controller, 'formConfig')) {
                $controller->formConfig = $controller->mergeConfig(
                    $controller->formConfig,
                    $formConfig
                );
            } else {
                $controller->addDynamicProperty('formConfig', $formConfig);
            }
        });
    }
}
