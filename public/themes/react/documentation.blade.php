@extends('layout.api')

<?

Site::set('html::body', ['id' => 'docs']);
Site::set('html::header', ['class' => 'navbar-inverse normal']); ?>

@section('content')
<div id="toc" class="col-sm-2">
	{{ $toc->getHtmlContent() }}
</div>
<div id="content" class="col-sm-10">
	<div class="page-header">
		<h1>{{ $document->get('title') }} <small>{{ $version }} documentation</small></h1>
	</div>
	{{ $document->getHtmlContent() }}
</div>
</div>

@stop