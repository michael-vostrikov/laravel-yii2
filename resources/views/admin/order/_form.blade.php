{!! $form->open() !!}

    {!! $form->field('user_id')->dropDownList(\App\User::pluck('name', 'id'), ['prompt' => '']) !!}

    {!! $form->submitButton('Submit'); !!}

{!! $form->close() !!}
