
<?php


?>

<style>

.box-file {
    position: relative;
    background-color: #fff;
    margin-top: 40px;
    padding: 20px;
    box-shadow: 0px 5px 10px rgb(150 150 150 / 10%);
    border-radius: 8px;
    float: left;
    margin-right: 10px;
    height: 200px;
    width: 180px;
    color: #333;
    font-size: 12px;
    font-weight: 600;
    line-height: 15px;
    text-align: center;
    padding-top: 110px;
    border: 2px solid #fff;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    transition: all 0.1s linear;
    cursor: pointer;
}


.box-file i, .box-file ion-icon {
    position: absolute;
    display: block;
    font-size: 52px;
    font-weight: 500;
    color: #a5a5a5;
    left: 66px;
    top: 32px;
}

</style>

<!-- Menu Page -->
<div class="menu-page">
  <span class="title-page">Suporte</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <?php 

                $dir    = '../webroot/support';
                $files = scandir($dir);

                $files_total = count($files);

                for ($i=2; $i < $files_total; $i++) { 
                    
                    echo '<a href="/webroot/support/'.$files[$i].'" target="_blank" class="box-file client"><i class="material-icons-outlined">folder</i> '.$files[$i].'</a>';

                }

            ?>

        </div>
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>
