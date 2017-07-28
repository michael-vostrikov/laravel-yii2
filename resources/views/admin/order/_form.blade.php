<?php $form = \yii\widgets\ActiveForm::begin() ?>

    {!! $form->field($formModel, 'user_id')->dropDownList(\App\User::pluck('name', 'id'), ['prompt' => '']) !!}

    <button type="submit" class="btn btn-primary">Submit</button>

<?php \yii\widgets\ActiveForm::end() ?>
