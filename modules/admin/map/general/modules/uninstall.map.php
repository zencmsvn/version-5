<?php
ZenView::set_section('Uninstall module');
ZenView::display_breadcrumb();
ZenView::set_block('Uninstall');
ZenView::e('<div class="padded">');
ZenView::e('<form method="POST">');
ZenView::display_tip('module-uninstall');
ZenView::e('<div class="form-group">
<input type="submit" name="submit-uninstall" value="Gỡ bỏ" class="btn btn-red"/>
<input type="submit" name="submit-cancel" value="Hủy" class="btn btn-default"/>
</div>');
ZenView::e('</form>');
ZenView::e('</div>');
ZenView::close_block();
ZenView::close_section();
