@extends('layouts.admin.app')

@section('title', 'Pages')

@section('css')
        <!-- iCheck for checkboxes and radio inputs -->
{!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection


@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-user"></i> {{ isset($page) ? 'Edit' : 'Add' }} Content
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/pages') }}"><i class="fa fa-files-o"></i> Content</a></li>
        <li class="active"><i
                    class="fa {{ isset($page) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($user) ? 'Edit' : 'Add' }}
            Content
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Content Details Form</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['url' =>  isset($page) ? 'admin/pages/'.$page->id  :  'admin/pages', 'method' => isset($page) ? 'put' : 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            {!! Form::hidden('page_id', isset($page) ? $page->id: null) !!}
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('title', 'Title *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                            {!! Form::text('title', old('title', isset($page) ? $page->title : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Title']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('slug', 'Slug *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                            {!! Form::text('slug', old('slug', isset($page) ? $page->getOriginal('slug') : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Slug']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('meta_keywords', 'Meta Keywords', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('meta_keywords', old('meta_keywords', isset($page) ? $page->meta_keywords : null), ['class' => 'form-control', 'rows'=> 3]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('meta_desc', 'Meta Description', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('meta_desc', old('meta_desc', isset($page) ? $page->meta_desc : null), ['class' => 'form-control', 'rows'=> 3]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Content', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('content', old('content', isset($page) ? $page->content : null), ['class' => 'form-control', 'id'=> 'editor']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('icon', 'Icon', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                            {!! Form::text('icon', old('icon', isset($page) ? $page->icon : null), ['class' => 'form-control', 'placeholder'=>'Icon']) !!}
                        </div>
                        <p class="text-muted">font awesome icon eg: fa fa-automobile</p>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('published', 'Published', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-sm-10">
                        <label class="check">{!! Form::checkbox('published', 1, isset($page) ? ($page->published == 'published' ? true: false): false, ['class'=>'minimal']) !!}
                            Published</label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('blog_post', 'Blog Post', ['class' => 'control-label col-md-2 ']) !!}
                    <div class="col-sm-10">
                        <label class="check">{!! Form::checkbox('blog_post', 1, isset($page) ? ($page->blog_post == 'Blog Post' ? true: false): false, ['class'=>'minimal']) !!}
                            Blog Post</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        {!! Form::submit( (isset($page) ? 'Update': 'Add') . ' Content', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div><!-- .col-md-12 -->
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection


@section('js')
        <!-- iCheck 1.0.1 -->
{!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

{!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

{!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

{!! Html::script('assets/plugins/ckeditor/ckeditor.js') !!}

<script type="text/javascript">
    $(document).ready(function () {
        $('input[type="checkbox"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue'
        });

        CKEDITOR.replace('editor');

        // Validation Engine init
        var prefix = 's2id_';

        $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
    });
</script>
@endsection
