<?php
namespace backend\components\grid;

use Yii;
use yii\helpers\Html;
class ActionColumn extends \yii\grid\ActionColumn
{
    public $header = '操作';
    public $template = '{view} {update} {delete}';
    
    public function init()
    {
        parent::init();
    
        
    }
    
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content !== null)
        {
            return call_user_func($this->content, $model, $key, $index, $this);
        }
        
        return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) use($model, $key, $index)
        {
            $name = $matches[1];
            if (isset($this->buttons[$name]))
            {
                $url = $this->createUrl($name, $model, $key, $index);
                
                return call_user_func($this->buttons[$name], $url, $model, $key, $index, $this);
            }
            else
            {
                return '';
            }
        }, $this->template);
    }
    
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                $options = array_merge([
                        'title' => Yii::t('yii', '查看'),
                        'style' => 'margin:0 5px',
                        'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
            };
        }
        
        if (! isset($this->buttons['update']))
        {
            $this->buttons['update'] = function ($url, $model, $key, $index, $gridView)
            {
                return Html::a(' ', $url, [
                        'title' => Yii::t('yii', '编辑'),
                        'style' => 'margin:0 5px',
                        'class' => 'glyphicon glyphicon-edit',
                        'data-pjax' => '0'
                ]);
            };
            
            if (! isset($this->buttons['delete']))
            {
                $this->buttons['delete'] = function ($url, $model, $key, $index, $gridView)
                {
                    return Html::a(' ', $url, [
                            'title' => Yii::t('yii', '删除'),
                            'style' => 'margin:0 5px',
                            'data-confirm' => Yii::t('yii', '确定要删除?'),
                            'data-method' => 'post',
                            'class' => 'glyphicon glyphicon-trash',
                            'data-pjax' => '0'
                    ]);
                };
            }
        }
    }
    
}