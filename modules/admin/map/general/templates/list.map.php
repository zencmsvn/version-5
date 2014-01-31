<?php
ZenView::set_section('Danh sách giao diện');
ZenView::display_breadcrumb();
ZenView::set_block('Danh sách giao diện đã cài đặt');
ZenView::e('<div class="padded">');
ZenView::display_tip('template-number-temp');
ZenView::e('<ul class="thumbnails padded">');
foreach ($templates as $key => $temp):
    ZenView::e('<li class="col-md-3 zen-template-screenshot">
        <a href="' . $temp['url_edit'] . '" class="thumbnail zen-template-thumbnail" title="Chỉnh sửa ' . $temp['name'] . '">
            <img src="' . $temp['screenshot'] . '"/>
            <div class="thumbnail-title">' . $temp['name'] . '</div>
        </a>
        <div class="action">
            <div class="btn-group">
                <a href="' . $temp['url_edit'] . '" class="btn btn-blue"><i class="icon-pencil"></i> Chỉnh sửa</a>
                <button class="btn btn-blue dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#view-info-' . $key . '" data-toggle="modal">Xem thông tin</a></li>
                    <li><a href="#uninstall-template-' . $key . '" data-toggle="modal">Hủy cài đặt</a></li>
                </ul>
            </div>
            <div id="view-info-' . $key . '" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Thông tin giao diện</h4>
                  </div>
                  <div class="modal-body nopadding">
                    <div class="box-content">
                    <table class="table table-normal">
                        <tr><td class="icon"><i class="icon-adjust"></i></td><td>Tên</td><td>' . $temp['name'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-user"></i></td><td>Tác giả</td><td>' . $temp['author'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-umbrella"></i></td><td>Version</td><td>' . $temp['version'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-comment"></i></td><td>Mô tả</td><td>' . $temp['des'] . '</td></tr>
                    </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="uninstall-template-' . $key . '" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hủy cài đặt template</h4>
                  </div>
                  <div class="modal-body nopadding">
                    <div class="box-content">
                    <table class="table table-normal">
                        <tr><td class="icon"><i class="icon-adjust"></i></td><td>Tên</td><td>' . $temp['name'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-user"></i></td><td>Tác giả</td><td>' . $temp['author'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-umbrella"></i></td><td>Version</td><td>' . $temp['version'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-comment"></i></td><td>Mô tả</td><td>' . $temp['des'] . '</td></tr>
                    </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form method="POST" action="' . $temp['url_uninstall'] . '">
                        <input type="submit" name="submit-uninstall" value="Hủy cài đặt" class="btn btn-red"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </li>');
endforeach;
ZenView::e('</ul>');
ZenView::e('</div>');
ZenView::close_block();
ZenView::close_section();