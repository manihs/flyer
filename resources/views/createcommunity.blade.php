@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create community</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ Form::open(['action' => 'CommunityController@create','files' => true]) }}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            {{ Form::file('img', $attributes = ['class'=>'custom-file-input','id'=>'inputGroupFile01','aria-describedby'=>'inputGroupFileAddon01']) }}
                            {{ Form::label('custom-file-label', 'chose img', ['class' => 'custom-file-label']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputText">name of community</label>
                        {{ Form::text('name', 'community name',['id'=>'exampleInputText','class'=>'form-control'])}}
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            {{ Form::label('inputGroupSelect01', 'Category', ['class' => 'input-group-text']) }}
                        </div>
                        {{ Form::select('category', [1 => 'sport', 2 => 'singing', 3 => 'Dancing'],'sport' ,['class'=>'custom-select main','id'=>'inputGroupSelect01']) }}
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            {{ Form::label('inputGroupSelect01', 'Sub category', ['class' => 'input-group-text submainc']) }}
                        </div>
                        {{ Form::select('scategory', [],'sport' ,['class'=>'custom-select','id'=>'inputGroupSelect01']) }}
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            {{ Form::label('inputGroupSelect01', 'Space', ['class' => 'input-group-text']) }}
                        </div>
                        {{ Form::select('space', [1 => 'public', 2 => 'private'],'sport' ,['class'=>'custom-select','id'=>'inputGroupSelect01']) }}
                    </div>
                    {{ Form::submit('Post',['class'=>'btn btn-success']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $('body').delegate('.main', 'change', function() {
        var value = this.value;
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : "{{ route('community.listsubcategory') }}",
            method : "POST",
            data : {value : value,  _token: _token},
            success: function(data){
                var obj = jQuery.parseJSON(data);
                var lastdata = ""
                lastdata += '<div class="input-group mb-3">'
                lastdata += '<div class="input-group-prepend">'
                lastdata += '<label class="input-group-text submainc" for="inputGroupSelect01">Sub category</label>'
                lastdata += '</div>'
                lastdata += '<select name="scategory" class="custom-select" id="inputGroupSelect01">'
                    for(var i in obj){
                        lastdata += '<option value="'+obj[i]+'">'+i+'</option>'
                    }
                    lastdata += '</select>'
                    lastdata += '</div>'
                    lastdata += '';
                $('.submainc').parent().parent().replaceWith(lastdata);               
            }
        });
        // $('.submainc').parent().parent().replaceWith(`
        //  @for ($i = 0; $i <= 10; $i++) 
        // {{ Form::submit("Post",["class"=>"btn btn-success"]) }}
        //  @endfor         
        // `);
    });
});
</script>
@endsection