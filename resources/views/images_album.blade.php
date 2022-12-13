@extends('layouts.master')
@section('title')
    Images
@endsection
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
	

        <!-- Add Image In Album -->

        <div class="modal fade" id="modelarchive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة صورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('store_img')}}" method="post" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="modal-body">
							<input type="hidden" name="album_id" value="{{$album->id}}">
                            <p>برجاء ادخال اسم الصورة</p><br>
                            <input class="form-control" name="name" id="name" type="text" required > <br>
							<input class="form-control" name="photo" id="photo" type="file" required  >

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-success">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

		
        <!-- End Add Image in Album -->

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">اسم الالبوم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$album->name}}</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->

				<div class="card-header pb-0">

					<a data-toggle="modal"  data-target="#modelarchive" href="invoices/create" class="modal-effect btn btn-sm btn-primary " style="color:white"><i
							class="fas fa-plus"></i>&nbsp; اضافة صورة للالبوم</a>

				</div>
@endsection

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
				<!-- row -->

				<div class="row row-sm">

					<div class="col-xl-9 col-lg-9 col-md-12">
						<div class="card">
						</div>
						<div class="row row-sm">
						
							@foreach ($images as $image)
								
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												
											</div>
												<img class="w-100" src="{{asset('images'.'/'.$image->path )}}" alt="product-image">
											</a>
										</div>
										<div class="text-center pt-3">

											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">{{$image->name}} <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price"></span></h4>
										</div>
									</div>
								</div>
							</div>

							@endforeach

						</div>
					</div>

					
					
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection