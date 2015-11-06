<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
?>
-use yii\helpers\Html
-use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>
-$view->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>
-$view->params['breadcrumbs'][] = $view->title
.<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index
  h1<?= " !=" ?>Html::encode($view->title)
<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $view->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

  p
    <?= "!=" ?>Html::a(<?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success'])

<?php if ($generator->indexWidgetType === 'grid'): ?>

  -
    $columns = [
<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "    '" . $name . "',\n";
        } else {
            echo "    //'" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "    '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "    //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
    ]
  <?= "!=" ?>GridView::widget(['dataProvider' => $dataProvider, <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel, 'columns' => [" : "'columns' => ["; ?> ['class' => 'yii\grid\SerialColumn'], $columns, ['class' => 'yii\grid\ActionColumn'],],])

<?php else: ?>
  <?= "!=" ?>ListView::widget(['dataProvider' => $dataProvider,'itemOptions' => ['class' => 'item'],'itemView' => function ($model, $key, $index, $widget) {return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>])},])
<?php endif; ?>
