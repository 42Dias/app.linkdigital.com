
<!-- Sidebar -->
<div class="scroll-active" style="display: block; position: fixed; right: 0px; top: 0px; background-color: #f9f9f9; padding: 25px; padding-top: 100px; padding-right: 30px; width: 300px; height: 100%;">

    <div class="btn-add-comment" data-toggle="modal" data-target="#addActivity">
        <i class="material-icons-outlined">chat</i>
    </div>

    <span style="display: block; font-size: 14px; color: #666; font-weight: 500; margin-top: 8px; margin-bottom: 30px;">
        Histórico de atividades
    </span>

    <?php $x=0; foreach ($all_activities as $activity) { $x++; ?>

        <?php 
            if($infos_user_activity[$activity->id]["permission"] == '1'){ $color_user = "#34a6ef"; }
            if($infos_user_activity[$activity->id]["permission"] == '2'){ $color_user = "#ff3576"; }
            if($infos_user_activity[$activity->id]["permission"] !== '1' && $infos_user_activity[$activity->id]["permission"] !== '2' ){ $color_user = "#a31ae2"; }
        ?>

        <div class="box-activity client">
            <div class="arrow-top"></div>

            <!-- <i class="material-icons-outlined">folder</i> -->


            <span class="date"><?php echo '<strong style="color: '.$color_user.';">'.$infos_user_activity[$activity->id]["name"].'</strong> - '.date_format($activity->created, 'd/m/Y'); ?></span>
            <span class="title"><?= strval($activity->title); ?></span>
        </div>

    <?php } ?>

    <?php if($x == 0){ ?>

        <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
            <i class="material-icons-outlined icon-empty">all_inclusive</i>
            <span class="title" style="font-size: 12px;">O cliente não possui nenhuma atividade.</span>
        </div>

    <?php } ?>

    <div class="clear"></div>

</div>
