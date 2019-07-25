<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */

namespace markmoskalenko\mailing\backend\grid;

use Yii;
use yii\bootstrap4\Html;

/**
 * @inheritdoc
 */
class ActionColumn extends \yii\grid\ActionColumn
{

    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'far fa-eye');
        $this->initDefaultButton('update', 'far fa-edit');
        $this->initDefaultButton('delete', 'far fa-trash-alt', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method'  => 'post',
        ]);
    }

    /**
     * Initializes the default button rendering callback for single button.
     * @param string $name              Button name as it's written in template
     * @param string $iconName          The part of Bootstrap glyphicon class that makes it unique
     * @param array  $additionalOptions Array of additional options
     * @since 2.0.11
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions)
            {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title'      => $title,
                    'aria-label' => $title,
                    'data-pjax'  => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => $iconName]);

                return Html::a($icon, $url, $options);
            };
        }
    }
}
