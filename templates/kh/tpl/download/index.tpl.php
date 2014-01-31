<?php load_header() ?>

    <td class="zen_sidebar">
        <?php load_layout('main_menu') ?>
    </td>
    <td class="zen_main">

        <h1 class="title" style="margin-bottom: 5px;"><?php echo $page_title; ?></h1>

        <p>

        <?php if (count($products)): ?>

            <form method="POST">

                <?php foreach ($products as $pro): ?>
                    <div class="download_product">
                        <span class="count_down_btn">+ <?php echo $pro['down'] + 1 ?></span>
                        <input type="submit" name="sub_download[<?php echo $pro['id_encode'] ?>]" class="reg_btn"
                               value="Download <?php echo $pro['name'] ?> (<?php echo get_size($pro['size']) ?>)"/>

                            <div class="product_info">
                                Phát hành: <?php echo get_time($pro['time']) ?><br/>
                                Dung lượng: <?php echo get_size($pro['size']) ?><br/>
                                Số lần download: <?php echo $pro['down'] ?><br/>
                                <?php if (!empty($pro['des'])): ?>
                                    <p><?php echo $pro['des'] ?></p>
                                <?php endif ?>
                            </div>
                    </div>
                <?php endforeach ?>
            </form>

        <?php else: ?>
            <div class="download_product">
                <h3>Không có phiên bản nào</h3>
            </div>
        <?php endif ?>
        </p>
    </td>

<?php load_footer() ?>