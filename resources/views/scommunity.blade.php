@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header flx">
                    <div class="input-group mb-3">
                        <input type="text" id="list" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                        </div>
                    </div>
                    {{ csrf_field() }}  
                </div>
                <div class="card-header flx">
                <a href="#" class="btn btn-info" role="button">Skip</a>
                <a href="/" class="btn btn-info" role="button">next</a>
                </div>
                <div class="card-body">
                   <div id="allList"  class="d-flex flex-wrap">
                        @foreach ($listdata as $row)
                        <div class="card m-2" style="width: 9.4rem;">
                            <img class="card-img-top" src="https://dummyimage.com/200x100/000/fff" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $row->name }}</h5>
                                @if (in_array($row->id, $community))
                                    <div class="btn btn-primary Man-intra-de">Cancel<input type="hidden" value="{{  $row->id }}"></div>
                                @else
                                    <div class="btn btn-primary Man-intra">Select<input type="hidden" value="{{  $row->id }}"></div>
                                @endif
                            </div>
                        </div>
                        @endforeach                            
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $('#list').keyup(function(){
        var value = $(this).val();
        if(value != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{ route('interest.fetch') }}",
                method : "POST",
                data : {query: query, _token: _token},
                success: function(data){
                    $('#allList').fadeIn();
                    $('#allList').html(data);
                }
            })
        }else{
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{ route('group.all') }}",
                method : "POST",
                data : { _token: _token},
                success: function(data){
                    $('#allList').fadeIn();
                    $('#allList').html(data);
                }
            })
        }
    });

    $("body").delegate(".Man-intra","click", function(){
        var obj = $(this);
        var value = obj.children("input[type~=hidden]").val();
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url : "{{ route('group.add') }}",
            method : "POST",
            data : {value : value,  _token: _token},
            success: function(data){
                obj.replaceWith('<div class="btn btn-primary Man-intra-de">Cancel<input type="hidden" value="'+data+'"></div>');
            }
        });
    });

    $("body").delegate(".Man-intra-de","click", function(){
        var obj = $(this);
        var value = obj.children("input[type~=hidden]").val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : "{{ route('group.remove') }}",
            method : "POST",
            data : {value : value,  _token: _token},
            success: function(data){
                obj.replaceWith('<div class="btn btn-primary Man-intra">Select<input type="hidden" value="'+data+'"></div>');
            }
        });
        
    });
});
</script>
@endsection