
<?php echo $head; ?>
    <div class="centered-row">
        <div class="l-box">
            <h2><?php echo _('Postado no Facebook!') ?></h2>
        </div>
    </div>
    <div class="pure-g centered-row">
        <div class="pure-u-1 pure-u-md-1-2">
            <div class="l-box">
                <p> <?php
                    echo _('Obrigado pelo check-in no Facebook!');
                    echo ' ';
                    echo _('Clique abaixo para começar a navegar.');
                    ?>
                </p>
                <p> <?php
                    $class = '';
                    $url = $loginurl;
                    // If the App is in review mode, then disable the login button. Or there will be an error message //
                    if (FB_REVIEW) {
                        echo '<div class="error-message">';
                        echo _('Nota: Você parece ter saído da nossa rede. Dessa forma não vai conseguir navegar.');
                        echo '</div>';
                        $class = ' pure-button-disabled';
                        $url = '#';
                    }
                    ?>
                </p>
                <p>
                    <a href="<?php echo $url; ?>" class="pure-button pure-button-primary <?php echo $class; ?>">
                    <i class="fa fa-lg fa-wifi"></i>
                    <?php
                    $btntext = _('Navegar!');
                    echo $btntext;
                    ?>
                    </a>
                </p>
            </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-2">
            <div class="l-box">
                <p> <?php
                    echo _('Você também pode acessar seu facebook ou adicionar uma foto.');
                    ?>
                </p>
                <p> <?php
                    sprintf(_('Mas lembre-se de voltar nessa página e clicar no botão <strong>%s</strong>.'), $btntext);;
                    ?>
                </p> 
                <p>
                    <a href="<?php echo $posturl; ?>" target="_blank" class="pure-button button-secondary">
                    <i class="fa fa-lg fa-facebook-official"></i>
                    <?php
                    echo _('Abrir o Facebook em uma nova janela.');
                    ?>
                    </a>
                </p>
        </div>
    </div>

<?php echo $foot; ?>
