@extends('layouts.member.app')

@section('title', 'Help')

@section('css')
    {!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection

@section('content')
    <div class="content">
		{{--content header--}}
        <div class="row">
            <div class="col-xs-12 page-head-line">Help</div>
        </div>
		{{--end content header--}}
		{{--main content- list of useful links--}}
        <div class="row">
			<div class="col-xs-12">
				<div class="new-box help">
					<div class="row">
						<div class="col-xs-12 col-md-6 col-lg-4 padding-bottom">
							<div class="row subtitle-shop">Subscriptions</div>
							<div class="row size44">
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet consectetur?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet consectetur adipicus et?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
							</div>
							<div class="row subtitle-shop">Packages</div>
							<div class="row size44">
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-lg-4 padding-bottom">
							<div class="row subtitle-shop">Invoices</div>
							<div class="row size44">
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet consectetur?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
							</div>
							<div class="subtitle-shop">Shop</div>
							<div class="row size44">
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-lg-4 padding-bottom">
							<div class="row subtitle-shop">Shipments</div>
							<div class="row size44">
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet consectetur?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet consectetur adipicus et?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet consectetur?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet consectetur adipicus et?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr adipicus?</a></div>
							</div>
							<div class="row subtitle-shop">My profile</div>
							<div class="row size44">
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
								<div class="col-xs-12"><a href="">Lorem ipsum dolosr sit amet?</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{--end main content--}}
    </div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
