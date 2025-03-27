<?php
/**
 * @var number[] $columns
 * @var array[] $rows
 * @var $sperator string| null
 */
?>
<?php foreach ($rows as $labels): ?>
    <div class="row">
        <?php foreach ($labels as $column => $label): ?>
            <div class="col-md-<?=$columns[$column]?> col-xs-12">
                <?=$label?>
            </div>
        <?php endforeach; ?>
    </div>
    <?=!is_null($sperator) ? $sperator : ""; ?>
<?php endforeach; ?>
