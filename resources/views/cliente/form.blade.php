<div class="box box-info padding-1"> <!-- contendero de estilo box info con un relleno interno de 1 -->
    <div class="box-body"> <!-- contenedor para el cuerpo del formulario dentro del contenedor principal -->
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $cliente->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $cliente->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button> <!-- boton de envio para el formulario -->
    </div>
</div>