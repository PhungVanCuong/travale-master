@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Quản lý Liên hệ</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Hỗ trợ và chăm sóc khách hàng</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-3 mail_list_column">
                                        <label class="badge bg-green" style="width: 100%;line-height: 2;font-size: 16px;">Yêu cầu mới</label>
                                        @foreach ($contacts as $contact)
                                            <a href="javascript:void(0)" class="contact-item"
                                                data-name="{{ $contact->name }}" data-email="{{ $contact->email }}"
                                                data-message="{{ $contact->message }}" data-contactid="{{ $contact->contactId }}">
                                                <div class="mail_list">
                                                    <div class="left">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <div class="right">
                                                        <h3>{{ $contact->name }} <small>{{ $contact->email }}</small></h3>
                                                        <p class="text-contact-truncate">{{ $contact->message }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>

                                    <div class="col-sm-9 mail_view">
                                        <div class="inbox-body">
                                            <div class="sender-info" style="border-bottom: 1px solid #ddd">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <strong>Chọn một liên hệ</strong> để xem chi tiết...
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="view-mail"><p></p></div>
                                            <div class="btn-group">
                                                <button id="compose" class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Trả lời</button>
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
    </div>

    <div class="compose col-md-6">
        <div class="compose-header">
            Phản hồi liên hệ
            <button type="button" class="close compose-close"><span>×</span></button>
        </div>
        <div class="compose-body">
            <div id="editor-contact" class="editor-wrapper"></div>
        </div>
        <div class="compose-footer">
            <button id="" class="send-reply-contact btn btn-sm btn-success" type="button" data-url="{{ route('admin.reply-contact') }}">Gửi Email</button>
        </div>
    </div>
</div>
@include('admin.blocks.footer')
