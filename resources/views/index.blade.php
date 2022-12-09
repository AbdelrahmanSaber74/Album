@extends('layouts.master')
@section('title')
    Albums
@endsection
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@section('page-header')


        <!-- Start Add Album -->

        <div class="modal fade" id="modelarchive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة البوم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('album_store')}}" method="post">
                        @method('GET')
                        @csrf
                        <div class="modal-body">
                            <p>برجاء ادخال اسم الالبوم</p><br>
                            <input class="form-control" name="name" id="name" type="text" required > <br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-success">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- End Add Album -->


		{{-- Start Model Edit --}}

        <div class="modal fade" id="modeledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل الاسم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action='{{route('album_update')}}' method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">اسم الالبوم :</label>
                                <input type="hidden" class="form-control" name="pro_id" id="pro_id" value="">
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

{{-- End Model Edit --}}

{{-- Start Model Delete --}}
        <div class="modal fade" id="modeldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف الالبوم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('album_destory')}}" method="post">
                        @method('POST')
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="pro_id" id="pro_id" value="">
                            <input class="form-control" name="name" id="name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

{{-- End Model Delete --}}



{{-- Start Model Other --}}
        <div class="modal fade" id="modelother" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">نقل الالبوم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('transfer')}}" method="post">
                        @method('POST')
                        @csrf
                        <div class="modal-body">
                            <p>قم باختار الالبوم</p><br>
                            <input type="hidden" name="pro_id" id="pro_id" value="">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الالبوم</label>
                                        <select name="album_transfer_id" id="album_transfer_id" class="form-control" required>
                                            <option value="" selected disabled> -- حدد الالبوم --</option>
                                            @foreach ($albums as $album)
                                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                                            @endforeach
                                        </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


{{-- End Model Other --}}


<!-- End Modal effects-->


				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الالبومات</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('Error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
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

@if (session()->has('transfer'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('transfer') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
				<!-- row opened -->
				<div class="row row-sm">


					<!--div-->
					<div class="col-xl-12">

						<div class="card">
							<div class="card-header pb-0">

								<a   data-toggle="modal"  data-target="#modelarchive" href="invoices/create" class="modal-effect btn btn-sm btn-primary " style="color:white"><i
										class="fas fa-plus"></i>&nbsp; اضافة البوم</a>


										</div>

							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Number of Photo</th>
												<th>Processes</th>
											</tr>
										</thead>
										<tbody>

                                            <?php $count = 1 ?>
											@foreach ($albums as $album)
												
											<tr>
												<th scope="row"><?php  echo $count++ ?></th>
												<td>
													<a href="{{route('images_album'  , $album->id) }}">{{$album->name}}</a>
													 </td>
												<td>{{$album->image->count()}}</td>



												<td>

													<button class="btn btn-outline-success btn-sm"
													data-name="{{ $album->name }}" data-pro_id="{{ $album->id }}"
													 data-toggle="modal"
													data-target="#modeledit">تعديل</button>

													<button class="btn btn-outline-danger btn-sm"
													data-name="{{ $album->name }}" data-pro_id="{{ $album->id }}"
													 data-toggle="modal"
													data-target="#modeldelete">حذف</button>


                                                    @if ($album->image->count() != 0)
                                                    <button class="btn btn-outline-danger btn-sm"
													data-name="{{ $album->name }}" data-pro_id="{{ $album->id }}"
													 data-toggle="modal"
													data-target="#modelother">نقل</button>
                                                    @endif


												</td>
											</tr>
											@endforeach

										</tbody>
									</table>
                                    
								</div><!-- bd -->
                                            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-md-12 col-lg-12 col-xl-7">
                    <div class="card">
                        <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-0">نسبة احصائية الالبومات</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
        
                        </div>
    
                        <div style="width:75%;">
                            {!! $chartjs->render() !!}
                        </div> 
                    
        
                </div>
            </div>
            <!-- row closed -->
							</div><!-- bd -->
						</div><!-- bd -->
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

@endsection
@section('js')

<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	



<script>

    $('#modeledit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var name = button.data('name')
        var pro_id = button.data('pro_id')
        var modal = $(this)
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #pro_id').val(pro_id);
    })

	$('#modeldelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #name').val(name);
        })

        $('#modelother').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #name').val(name);
        })
</script>

@endsection