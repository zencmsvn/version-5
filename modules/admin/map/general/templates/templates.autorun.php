<?php
$menu = '<div class="btn-group">
  <button type="button" class="btn btn-blue" data-toggle="dropdown">
    <i class="icon-wrench"></i> Quản lí
  </button>
  <button class="btn btn-blue" data-toggle="dropdown"><span class="caret"></span></button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">';
foreach ($page_menu as $m):
    $menu .= '<li>' . $m . '</li>';
endforeach;
$menu .= '</ul></div>';