<?php

use frontend\models\SiteParam;
use yii\helpers\Url;
use frontend\models\ProductCategory;
use frontend\models\Info;

?>
<footer class="container">
    <div class="wrap clr">
        <div class="ft-row">
            <?php
            if (!$this->context->sm_scr) {
                ?>
                <div class="ft-col sm-hidden">
                    <div class="img-wrap">
                        <i class="icon logo-icon"></i>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="ft-col">
                <div><strong><span class="mono-space">&copy;</span> Báo điện tử Thể thao Việt Nam - số 5 Trịnh Hoài Đức - Hà Nội</strong></div>
                <div><span class="mono-space">&nbsp;</span> Điện thoại: (04)38453256, Fax: (04)38230029</div>
                <div><span class="mono-space">&nbsp;</span> Hotline: 0913 088847</div>
                <div><span class="mono-space">&nbsp;</span> Email: toasoan@thethaohangngay.com.vn</div>
            </div>
            <div class="ft-col">
                <div><strong>Bộ Văn hóa Thể thao và Du lịch - Tổng cục Thể dục Thể thao</strong></div>
                <div>Số giấy phép: 359/GP-BTTTT, cấp ngày 04/09/2013</div>
                <div>Phó TBT phụ trách: Lê Thanh Tùng</div>
            </div>
        </div>
    </div>
</footer>
