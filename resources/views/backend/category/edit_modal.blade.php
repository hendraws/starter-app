{!! Form::open(['action' => ['CategoryController@update',$category->id],'method'=>'PATCH','class'=>'form-horizontal']) !!}

<div class="modal-header">
    <h4>{{ $title }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
</div>
<div class="modal-body">
	<div class="row">
    <div class="col-md-12 mb-1">
            <div class="form-row">
                {!! Form::label('name', 'Name', ['class'=>'col-form-label col-md-3']) !!}
                <div class="col">
                    {!! Form::text('name', $category->name, ['class'=>'form-control', 'id'=>'name', 'autocomplete'=>'off' ,'placeholder'=>'Name Category', 'required']) !!}
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
	</div>
</div>
<div class="modal-footer text-center">
    <button class="btn btn-square btn-primary btn-sm" type="submit"><i class="icon-cursor"></i> Submit</button>
</div>
{!! Form::close() !!}