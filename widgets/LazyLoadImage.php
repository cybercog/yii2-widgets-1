<?php
/**
 * @link https://github.com/gromver/yii2-widgets#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/gromver/yii2-widgets/blob/master/LICENSE
 * @package yii2-widgets
 * @version 1.0.0
 */

namespace gromver\widgets;


use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Изображение с отложенной загрузкой
 * Class LazyLoadImage
 * @package yii2-widgets
 */
class LazyLoadImage extends Widget {
    public $src;
    public $options = [
        'class' => 'img-responsive'
    ];
    public $spinner = false;

    public function init()
    {
        if (!isset($this->src)) {
            throw new InvalidConfigException(__CLASS__ . '::src must be set.');
        }

        Html::addCssClass($this->options, 'lazy');
        $this->options['data-src'] = $this->src;

        $this->view->registerAssetBundle(LazyLoadAsset::className());
    }

    public function run()
    {
        echo Html::beginTag('img', $this->options);
        $this->options['src'] = ArrayHelper::remove($this->options, 'data-src');
        Html::removeCssClass($this->options, 'lazy');
        echo '<noscript>' . Html::beginTag('img', $this->options) . '</noscript>';
    }
} 