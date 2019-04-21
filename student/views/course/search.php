<?php
use common\utilities\HtmlHelper;
use yii\bootstrap4\Html;

?>

<?php /** @var array $models */
foreach ($models as $model): ?>
    <div class="col-md-3 subject-item">
        <div class="card" style="width: 17rem;">
            <img src="<?php HtmlHelper::getUploadsImage($model['image1']); ?>" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><?php echo $model['name'] ?></h5>
                <p class="card-text"><?php echo $model['description'] ?></p>
                <?php if ($model['is_enroll']=='enrolled'): ?>
                    <?= Html::a('Tiếp tục học', ['lession/index', 'course_id' => $model['id']], ['class' => 'btn btn-primary']) ?>
                <?php else: ?>
                    <button class="btn btn-primary register_course" data-id="<?php echo $model['id'] ?>">Ghi danh</button>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
