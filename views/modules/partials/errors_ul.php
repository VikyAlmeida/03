<ul class="errors">
    <?php
        if ($errors):
            foreach ( $errors as $error ):
                ?>
                <li><?=$error?></li>
                <?php
            endforeach;
        endif;
    ?>
</ul>
<br>