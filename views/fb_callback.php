
<?php echo $head; ?>
    <div class="centered-row">
        <div class="l-box">
            <h2><?php echo _('Logado com Facebook!') ?></h2>
        </div>
    </div>
    <div class="pure-g centered-row">
        <div class="pure-u-1 pure-u-md-1-2">
            <div class="l-box">
                <p> <?php
                    echo _('Um �ltimo passo.');
                    echo ' ';
                    echo _('Voc� pode adicionar uma mensagem ao seu check-in.');
                    echo ' ';
                    ?>
                </p>
            </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-2">
            <div class="l-box">
                <p>
                    <form class="pure-form pure-form-stacked" method="post" action="<?php echo $post_action; ?>">
                        <fieldset>
                            <legend><?php echo _('Check In'); ?></legend>
                            <label for="text_fb_message"><?php echo _('Mensagem'); ?></label>
                            <textarea rows="2" name="message" id="text_fb_message" placeholder="<?php echo _('Opcional');?>"></textarea>
                            <input type="hidden" name="nonce" id="fb_message_nonce" value="<?php echo $nonce; ?>"/>
                            <button type="submit" class="pure-button pure-button-primary">
                                <i class="fa fa-facebook-official fa-lg"></i>
                                <?php echo _('Check-in no') . ' ' .$place_name; ?>
                            </button>
                        </fieldset>
                    </form>
                </p>
            </div>
        </div>
    </div>
    <?php #echo $back_to_code_widget ?>

<?php echo $foot; ?>
