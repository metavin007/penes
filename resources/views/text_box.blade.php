@extends('layouts.app_layout')

@section('css_bottom')

@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-lg-3 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/textbox') }}">กล่องเปล่าๆ</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">กล่องเปล่าๆ</h4>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-address">
                                <label>ข้อความ</label>
                                <textarea class="form-control" rows="20"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('js_bottom')
<script>


</script>
@endsection