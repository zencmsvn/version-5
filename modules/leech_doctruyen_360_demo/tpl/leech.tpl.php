<?php load_header() ?>

    <h1 class="title">Quản lí</h1>
    <div class="breadcrumb"> <?php echo $display_tree; ?></div>

    <div class="detail_content">
        <h2 class="sub_title border_orange"><?php echo $page_title; ?></h2>
        <?php load_message() ?>
        <form method="POST">

            <div class="item">
                Leech truyện vào mục:<br/>
                <select name="to">
                    <?php foreach ($tree_folder as $id => $name): ?>
                        <option value="<?php echo $id ?>" <?php if (gFormCache('to') == $id) echo 'selected' ?>>
                            <?php echo $name ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="item">
                Nhập url truyện từ <a href="http://doctruyen360.com" target="_blank">Doctruyen360.com</a><br/>
                <input type="text" name="url" value="" placeholder="Nhập url truyện vào đây"/>
                <input type="submit" name="sub" value="Leech" class="button BgGreen"/>

            </div>
        </form>

    </div>
<?php load_footer() ?>