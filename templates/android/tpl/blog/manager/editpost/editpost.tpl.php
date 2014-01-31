<?php load_header() ?>
    <div class="breadcrumb"><?php echo $display_tree ?></div>
<?php load_message() ?>

    <div data-role="collapsible" data-theme="a" data-content-theme="c" data-collapsed-icon="edit" data-collapsed="false" data-expanded-icon="edit">
        <h2><a href="<?php echo $blog['full_url'] ?>" target="_blank"><?php echo $blog['name'] ?></a></h2>
        <p class="ui-body-d">
            Bạn đang viết bài trong chế độ <b style="color:red"><?php echo $blog['type_data'] ?></b> -
            <u>
                <a href="<?php echo _HOME; ?>/blog/manager/editpost/<?php echo $blog['id'] ?>/step2/unset">
                    Thay đổi kiểu dữ liệu
                </a>
            </u>
        </p>

        <form method="POST">
            <div data-role="fieldcontain">
                <label for="to">Di chuyển:</label>
                <select name="to" id="to" data-mini="true">
                    <?php foreach ($tree_folder as $id => $name): ?>
                        <option value="<?php echo $id ?>" <?php if ($blog['parent'] == $id) echo 'selected' ?>>
                            <?php echo $name ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <input type="submit" name="sub_move" value="Di chuyển" class="button BgBlue"/>
        </form>

        <form method="POST" enctype="multipart/form-data">

            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" value="<?php echo $blog['name']; ?>" placeholder="Nhập tên bài viết"/>


            <fieldset data-role="controlgroup" data-mini="true">
                <legend>Tiêu đề:</legend>
                <label for="type_title_custom">
                    <input type="radio" name="type_title" value="custom" id="type_title_custom" <?php echo $blog['check_title_custom']; ?> /> Tùy chỉnh<br/>
                </label>
                <label for="type_title_only_me">
                    <input type="radio" name="type_title" value="only_me" id="type_title_only_me" <?php echo $blog['check_title_only_me']; ?> /> Chỉ tính title bài này<br/>
                </label>
                <label for="type_title_with_parent">
                    <input type="radio" name="type_title" value="with_parent" id="type_title_with_parent" <?php echo $blog['check_title_with_parent']; ?> /> Bao gồm cả title thư mục trước<br/>
                </label>
                <label for="type_title_with_full_parent">
                    <input type="radio" name="type_title" value="with_full_parent" id="type_title_with_full_parent" <?php echo $blog['check_title_with_full_parent']; ?> /> Bao gồm tất cả title thư mục trước
                </label>
            </fieldset>
            Tiêu đề cũ: <b><?php echo $blog['title'] ?></b>
            <label for="type_title_custom">
                <input type="text" name="custom_title" value="<?php echo $blog['custom_title'] ?>" placeholder="Tùy chỉnh tiêu đề"/><br/>
            </label>

            <fieldset data-role="controlgroup" data-mini="true">
                <legend>Url:</legend>
                <label for="type_url_only_me">
                    <input type="radio" name="type_url" value="only_me" id="type_url_only_me" <?php echo $blog['check_url_only_me']; ?> /> Chỉ tính url bài này<br/>
                </label>
                <label for="type_url_with_parent">
                    <input type="radio" name="type_url" value="with_parent" id="type_url_with_parent" <?php echo $blog['check_url_with_parent']; ?> /> Bao gồm cả url 1
                    thư mục trước<br/>
                </label>
                <label for="type_url_with_full_parent">
                    <input type="radio" name="type_url" value="with_full_parent" id="type_url_with_full_parent" <?php echo $blog['check_url_with_full_parent']; ?> /> Bao gồm
                    tất cả url thư mục trước
                </label>
            </fieldset>

            <label for="auto_get_img">Tự động lấy ảnh:</label>
            <select name="auto_get_img" id="auto_get_img" data-role="slider" data-mini="true">
                <option value="" <?php if (!gFormCache('auto_get_img')) echo 'selected' ?>>Không</option>
                <option value="1" <?php if (gFormCache('auto_get_img')) echo 'selected' ?>>Có</option>
            </select><br/>

            <label for="content">Nội dung:</label>
            <textarea name="content" style="width:100%;" rows="15" id="content"><?php echo $blog['content'] ?></textarea>


            <label for="keyword">Keyword:</label>
            <textarea name="keyword" id="keyword" style="width:100%;" rows="5" placeholder="Phần keyword nằm trong thẻ meta keyword"><?php echo $blog['keyword']; ?></textarea>

            <label for="des">Mô tả:</label>
            <textarea name="des" id="des" style="width:100%;" rows="5" placeholder="Phần mô tả nằm trong thẻ meta description"><?php echo $blog['des']; ?></textarea>

            <label for="tags">Tags:</label>
            <textarea name="tags" id="tags" style="width:100%;" rows="3" placeholder="Mỗi tag cách nhau bằng dấu ,"><?php echo $blog['tags'] ?></textarea>

            <label for="tags">Icon:</label>
            <div style="text-align: center;"><img src="<?php echo $blog['full_icon'] ?>"></div>
            <p>
                <input type="file" name="file_icon" size="15"/>
                <input type="text" name="file_icon" size="30" placeholder="Hoặc nhập vào url hình ảnh"/><br/>

                <label for="auto_get_img">Resize icon về 80x80px:</label>
                <select name="auto_resize" id="auto_resize" data-role="slider" data-mini="true">
                    <option value="" <?php if (!gFormCache('auto_resize')) echo 'selected' ?>>Không</option>
                    <option value="1" <?php if (gFormCache('auto_resize')) echo 'selected' ?>>Có</option>
                </select>
            </p>

            <input type="submit" data-theme="b" id="sub_editpost" name="sub_editpost" value="Lưu thay đổi" class="button BgRed"/>
        </form>

    </div>

<?php load_footer() ?>