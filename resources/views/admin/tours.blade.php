@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Quản lý <small>Tours</small></h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Danh sách Tours</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                            <table id="datatable-listTours" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tên Tour</th>
                                                        <th>Thời gian</th>
                                                        <th>Khách tối đa</th>
                                                        <th>Giá người lớn</th>
                                                        <th>Giá trẻ em</th>
                                                        <th>Điểm đến</th>
                                                        <th>Trạng thái</th>
                                                        <th>Khởi hành</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody-listTours">
                                                    @include('admin.partials.list-tours')
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-tour-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chỉnh sửa Tour</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="wizard" class="form_wizard wizard_horizontal wizard-edit-tour">
                            <ul class="wizard_steps">
                                <li><a href="#step-1"><span class="step_no">1</span></a></li>
                                <li><a href="#step-2"><span class="step_no">2</span></a></li>
                                <li><a href="#step-3"><span class="step_no">3</span></a></li>
                            </ul>
                            <div id="step-1">
                                <form class="form-info-tour" method="POST" id="form-step1">
                                    @csrf
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Tên Tour <span>*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" name="title" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Điểm đến <span>*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" name="destination" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Số lượng <span>*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="number" name="quantity" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Giá người lớn</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="number" name="priceAdult" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Giá trẻ em</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="number" name="priceChild" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group bad">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Mô tả<span>*</span></label>
                                        <div class="col-md-6 col-sm-6">
                                            <textarea name="description" id="description" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-2">
                                <h2 class="StepTitle">Quản lý Ảnh</h2>
                                <form action="" class="dropzone" id="myDropzone-listTour" enctype="multipart/form-data">@csrf</form>
                            </div>
                            <form action="{{ route('admin.edit-tour') }}" id="timeline-form" method="POST">
                                @csrf
                                <input type="hidden" name="tourId" class="hiddenTourId">
                                <div id="step-3"><h2 class="StepTitle">Nhập lộ trình</h2></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.blocks.footer')
