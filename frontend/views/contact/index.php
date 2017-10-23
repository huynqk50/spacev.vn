<?php
use frontend\models\SiteParam;
?>
<div class="clr contact">
    <section>
        <h2 class="title">Liên hệ</h2>
        <div class="content">
            <div class="item-view aspect-ratio _7x2 sm16x9">
                <div class="img-wrap">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0772558793014!2d105.78376741455122!3d21.029594585997838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4c42e97c19%3A0x13c51ff8474e710e!2sIntracom+Building!5e0!3m2!1svi!2s!4v1477020015106" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="clr">
                <article class="left">
                    <h2 class="sub-title"><?= Yii::$app->name ?></h2>
                    <?php
                    foreach (SiteParam::findAllByNames([SiteParam::PARAM_ADDRESS]) as $item) {
                    ?>
                        <p><i class="icon place-icon"></i>&nbsp;<?= $item->value ?></p>
                    <?php
                    }
                    foreach (SiteParam::findAllByNames([SiteParam::PARAM_PHONE_NUMBER]) as $item) {
                    ?>
                        <p><a href="tel:<?= $item->value ?>" title="Hotline"><i class="icon hotline-icon"></i>&nbsp;<?= $item->value ?></a></p>
                    <?php
                    }
                    ?>
                    <p><a><i class="icon web-icon"></i>&nbsp;<?= Yii::$app->request->hostInfo ?></a></p>
                    <?php
                    foreach (SiteParam::findAllByNames([SiteParam::PARAM_EMAIL]) as $item) {
                    ?>
                        <p><a href="mailto:<?= $item->value ?>" title="mail"><i class="icon envelope-icon"></i>&nbsp;<?= $item->value ?></a></p>
                    <?php
                    }
                    foreach (SiteParam::findAllByNames([SiteParam::PARAM_EMAIL]) as $item) {
                    ?>
                        <p><a href="mailto:<?= $item->value ?>" title="mail"><i class="icon envelope-icon"></i>&nbsp;<?= $item->value ?></a></p>
                    <?php
                    }
                    foreach (SiteParam::findAllByNames([SiteParam::PARAM_SKYPE]) as $item) {
                    ?>
                        <p><a href="skype:<?= $item->value ?>?chat" title="skype"><i class="icon skype-icon"></i>&nbsp;<?= $item->value ?></a></p>
                    <?php
                    }
                    foreach (SiteParam::findAllByNames([SiteParam::PARAM_FACEBOOK]) as $item) {
                    ?>
                        <p><a href="<?= $item->value ?>" title="facebook" target="_blank"><i class="icon fb-msg-icon"></i>&nbsp;<?= $item->value ?></a></p>
                    <?php
                    }
                    ?>

                </article>
                <form class="primary right">
                    <h2 class="sub-title">Liên hệ với chúng tôi</h2>
                    <div class="form-group required">
                        <input type="text" value="">
                        <label>Họ tên</label>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group required">
                        <input type="text" value="">
                        <label>Email</label>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" value="">
                        <label>Số điện thoại</label>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group required">
                        <textarea value="" rows="4"></textarea>
                        <label>Nội dung</label>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit">Gửi đi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>