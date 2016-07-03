<!DOCTYPE html>
<html lang="<?php echo config('application.language') ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>{{  $config->getOption('title', '') .' - '. config('administrator.title')  }}</title>

	<link href="{{asset('packages/summerblue/administrator/css/app.css')}}" media="all" type="text/css" rel="stylesheet">
	<link href="{{asset('packages/summerblue/administrator/css/main-extended.css')}}" media="all" type="text/css" rel="stylesheet">

	<!--[if lte IE 9]>
		<link href="{{asset('packages/summerblue/administrator/css/browsers/lte-ie9.css')}}" media="all" type="text/css" rel="stylesheet">
	<![endif]-->

</head>
<body>
	<div id="wrapper">
		@include('administrator::partials.header')

		{!! $content !!}

		@include('administrator::partials.footer')
	</div>

	<script src="{{asset('packages/summerblue/administrator/js/base.js')}}"></script>
	@foreach ($myjs as $url)
		<script src="{{$url}}"></script>
	@endforeach
	<script src="{{asset('packages/summerblue/administrator/js/app.js')}}"></script>

	<!-- 生成二维码的 modal，在品牌页面使用到，需要有更好的价值机制。 -->
	<div class="modal fade" id="getQrcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header text-center">
	        <h3>二维码信息</h3>
	      </div>
	      <div class="modal-body">
	        <div id="qrcode-img" class="text-center"></div>
	      </div>
	    </div>
	  </div>
	  </div>
	</div>

</body>
</html>
