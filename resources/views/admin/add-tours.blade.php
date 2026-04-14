@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')
        <div class="right_col" role="main">
            <div class="">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_content add-tours">
                                <div id="wizard" class="form_wizard wizard_horizontal">
                                    <div id="step-1">
                                        <form class="form-info-tour" action="{{ route('admin.add-tours') }}" method="POST" id="form-step1">
                                            @csrf
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Tên <span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" name="title" placeholder="Nhập tên Tour" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Điểm đến <span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" name="destination" placeholder="Điểm đến" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Khu vực<span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <select class="form-control" name="domain" id="domain">
                                                        <option value="">Chọn khu vực</option>
                                                        <option value="b">Miền Bắc</option>
                                                        <option value="t">Miền Trung</option>
                                                        <option value="n">Miền Nam</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Số lượng <span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="number" name="quantity" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Giá người lớn <span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="number" name="priceAdult" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Giá trẻ em <span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" type="number" name="priceChild" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Ngày khởi hành<span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="text" class="form-control datetimepicker" id="start_date" name="startDate" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Ngày kết thúc<span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="text" class="form-control datetimepicker" id="end_date" name="endDate" required>
                                                </div>
                                            </div>
                                            <div class="field item form-group bad">
                                                <label class="col-form-label col-md-3 col-sm-3  label-align">Mô tả<span>*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <textarea name="description" id="description" rows="10" required></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.blocks.footer')
