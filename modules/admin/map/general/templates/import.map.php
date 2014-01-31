<?php
ZenView::set_section('Tải lên giao diện');
ZenView::display_breadcrumb();
ZenView::set_block('Chọn vài tải lên giao diện');
ZenView::e('<div class="padded">');
ZenView::display_tip('template-accept-format');
ZenView::display_message('template-upload-info');
ZenView::e('<form role="form" class="form-horizontal fill-up validatable" method="POST" enctype="multipart/form-data">');
ZenView::e('<div class="form-group">
<label for="Mobile" class="col-lg-2 control-label">Chọn tệp tin</label>
<div class="col-lg-9">
<input type="file" name="template" accept=""/>
</div>
</div>');
ZenView::e('<div class="form-group"><div class="col-lg-9 col-lg-offset-2">
  <button type="submit" name="submit-upload" class="btn btn-primary">Tải lên</button>
</div></div>');
ZenView::e('</form>');
ZenView::e('</div>');
ZenView::close_block();
ZenView::close_section();