<?php
ZenView::set_section('Quản lí module', array('after' => '<div class="btn-group">
  <button type="button" class="btn btn-blue" data-toggle="dropdown">
    Quản lí <span class="caret"></span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu"><li><a href="http://localhost/admin/general/templates/import">Tải lên giao diện</a></li><li><a href="http://localhost/admin/general/templates/list">Danh sách giao diện</a></li></ul></div>'));
ZenView::display_breadcrumb();
ZenView::display_message('module');
ZenView::set_block('Module chạy nền');
ZenView::e('<table class="table table-normal">');
ZenView::e('<thead>
      <tr>
        <td style="width: 40px"></td>
        <td>Tên</td>
        <td>URL</td>
        <td>Phiên bản</td>
        <td>Tác giả</td>
        <td>Mô tả</td>
      </tr>
      </thead>');
foreach ($modules[BACKGROUND] as $name => $mod):
    ZenView::e('<tr>
    <td>
        <div class="btn-group">
            <button class="btn btn-xs btn-' . ((in_array($name, $module_actived[BACKGROUND]))?'green':'default') . ' dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i></button>
            <ul class="dropdown-menu">
              <li>' . (($mod['activated']) ? '<a href="' . $mod['url_deactivate'] . '">Hủy kích hoạt</a>' : '<a href="' . $mod['url_activate'] . '">Kích hoạt</a>') . '</li>
              <li><a href="' . $mod['url_update'] . '">Cập nhật</a></li>
              <li class="divider"></li>
              <li><a href="#module-uninstall-' . $mod['url'] . '" data-toggle="modal">Gỡ bỏ</a></li>
            </ul>
          </div>
          <div id="module-uninstall-' . $mod['url'] . '" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Uninstall module</h4>
                  </div>
                  <div class="modal-body nopadding">
                    <div class="box-content">
                    <table class="table table-normal">
                        <tr><td class="icon"><i class="icon-adjust"></i></td><td>Tên</td><td>' . $mod['name'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-user"></i></td><td>Tác giả</td><td>' . $mod['author'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-umbrella"></i></td><td>Version</td><td>' . $mod['version'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-comment"></i></td><td>Mô tả</td><td>' . $mod['des'] . '</td></tr>
                    </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form action="' . $mod['url_uninstall'] . '" method="POST">
                        <input type="submit" name="submit-uninstall" name="submit-uninstall" value="Gỡ bỏ" class="btn btn-red"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
    </td>
    <td>' . $mod['name'] . '</td>
    <td>' . $mod['url'] . '</td>
    <td>' . $mod['version'] . '</td>
    <td>' . $mod['author'] . '</td>
    <td>' . $mod['des'] . '</td>
    </tr>');
endforeach;
ZenView::e('</table>');
ZenView::close_block();

ZenView::set_block('Module ứng dụng');
ZenView::e('<table class="table table-normal">');
ZenView::e('<thead>
      <tr>
        <td style="width: 40px"></td>
        <td>Tên</td>
        <td>URL</td>
        <td>Phiên bản</td>
        <td>Tác giả</td>
        <td>Mô tả</td>
      </tr>
      </thead>');
foreach ($modules[APP] as $name => $mod):
    ZenView::e('<tr>
    <td>
        <div class="btn-group">
            <button class="btn btn-xs btn-' . ((in_array($name, $module_actived[APP]))?'green':'default') . ' dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i></button>
            <ul class="dropdown-menu">
              <li>' . (($mod['activated']) ? '<a href="' . $mod['url_deactivate'] . '">Hủy kích hoạt</a>' : '<a href="' . $mod['url_activate'] . '">Kích hoạt</a>') . '</li>
              <li><a href="' . $mod['url_update'] . '">Cập nhật</a></li>
              <li class="divider"></li>
              <li><a href="#module-uninstall-' . $mod['url'] . '" data-toggle="modal">Gỡ bỏ</a></li>
            </ul>
        </div>
        <div id="module-uninstall-' . $mod['url'] . '" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Uninstall module</h4>
                  </div>
                  <div class="modal-body nopadding">
                    <div class="box-content">
                    <table class="table table-normal">
                        <tr><td class="icon"><i class="icon-adjust"></i></td><td>Tên</td><td>' . $mod['name'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-user"></i></td><td>Tác giả</td><td>' . $mod['author'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-umbrella"></i></td><td>Version</td><td>' . $mod['version'] . '</td></tr>
                        <tr><td class="icon"><i class="icon-comment"></i></td><td>Mô tả</td><td>' . $mod['des'] . '</td></tr>
                    </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form action="' . $mod['url_uninstall'] . '" method="POST">
                        <input type="submit" name="submit-uninstall" name="submit-uninstall" value="Gỡ bỏ" class="btn btn-red"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </td>
    <td>' . $mod['name'] . '</td>
    <td>' . $mod['url'] . '</td>
    <td>' . $mod['version'] . '</td>
    <td>' . $mod['author'] . '</td>
    <td>' . $mod['des'] . '</td>
    </tr>');
endforeach;
ZenView::e('</table>');
ZenView::close_block();

ZenView::close_section();