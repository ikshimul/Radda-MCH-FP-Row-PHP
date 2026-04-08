<?php
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->vaccine_list();
$future_vaccination = $obj_vac->future_vaccination_list_for_scroll();
$check = mysqli_num_rows($future_vaccination);
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'logout') {
        require 'classes/logout.php';
        $obj_logout = new Logout();
        $obj_logout->admin_logout();
    }
}
?>
<style>
    .background{
        background: url('resource/image/rsz_o-vaccinated-facebook.jpg');
        height: 300px;
        background-repeat: repeat;

    }
    .jcarousel-control-prev,
    .jcarousel-control-next {
        top: 2px;
        height: 30px;
        text-align: right;
        text-decoration: none;
        text-shadow: 0 0 1px #000;
        font: 16px/20px Arial, sans-serif;

    }

    .jcarousel-control-prev {
        left: 225px;

    }

    .jcarousel-control-next {
        right: 26px;
    }

    .jcarousel-control-prev:hover span,
    .jcarousel-control-next:hover span {
        display: block;
    }

    .jcarousel-control-prev.inactive,
    .jcarousel-control-next.inactive {
        opacity: .5;
        cursor: default;
    }
    .modalDialog:not(:visited) {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0px;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        opacity: 0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
    #openModal:not(:visited):target {
        animation : hide 1s;pointer-events:none;
    }
    @keyframes show {
        0.05%, 100% {opacity:1;}
    }
    #openModal {
        opacity:0;
        animation : 6000s show ;
    }
    @keyframes hide {
        to {opacity:0;pointer-events:none!important;}
    }
    .modalDialog:not(:visited) {
        opacity:1;
        pointer-events: auto;
    }

    .modalDialog:not(:visited) > div {
        width: 400px;
        position: relative;
        margin: 10% auto;
		border-radius:10px;
        padding: 5px 20px 13px 20px;
        background: #fff;
        background: -moz-linear-gradient(#fff, white);
        background: -webkit-linear-gradient(#fff, white);
        background: -o-linear-gradient(#fff, white);
    }

</style>
<div class="row">
    <div class="col-md-12">
        <div class="scrollwrap" style="padding: 1px 0px 1px 0px;">
            <div class="latest-text">
                <b style="line-height: 32px;font-size: 14px;">Upcoming Vaccination :: </b>
            </div>
            <div class="scrollwrapper">
                <marquee behavior="scroll" direction="left" onMouseOver="this.setAttribute('scrollamount', 0, 0);
                        this.stop();" OnMouseOut="this.setAttribute('scrollamount', 4, 0);
                                this.start();"
                         height="auto" scrollamount="4">
                             <?php
                             if ($check > 0) {
                                 while ($future_v = mysqli_fetch_array($future_vaccination)) {
                                     ?>
                            <div class="newsscroll">
                                <img style="margin-bottom: 3px;" class="latest_img" src="resource/image/rsz_1rsz_vmis.png"/>
                                <a style="<?php
                                $today = date('Y-m-d');
                                if ($future_v['next_date'] == $today) {
                                    echo 'color:#258a41;';
                                } else {
                                    echo 'color:black;';
                                }
                                ?>" class="notice_item_title <?php
                                   $today = date('Y-m-d');
                                   if ($future_v['next_date'] == $today) {
                                       echo 'blink_me';
                                   } else {
                                       echo '';
                                   }
                                   ?>" href="#" title="<?php echo $future_v['name']; ?> next vaccination after <?php
                                   $difference = strtotime($future_v['next_date']) - strtotime($today);
                                   echo floor($difference / 86400);
                                   ?> days">Patient : <strong><?php echo $future_v['name']; ?></strong> &nbsp;Contact :<strong><?php echo $future_v['mother_phone']; ?></strong> &nbsp;Vaccine : <strong><?php echo $future_v['generic_name']; ?></strong> &nbsp; Dose : <strong><?php echo $future_v['dose_name']; ?></strong> &nbsp;Due Date : <strong><?php echo date('d M, Y', strtotime($future_v['next_date'])); ?></strong></a>&nbsp;&nbsp;
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="newsscroll">
                            <img style="margin-bottom: 3px;" class="latest_img" src="resource/image/rsz_1rsz_vmis.png"/>
                            <a style="" class="notice_item_title"  href="#" title="No records found " >No records found</a>&nbsp;&nbsp;
                        </div>
                        <?php
                    }
                    ?>
                </marquee>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div id="sb-slider" class="sb-slider">
             <img src="resource/image/rsz_img_6014.jpg"  class="img-responsive"  alt=""/>
<!--            <img src="resource/image/rsz_radda.png"  class="img-responsive"  alt=""/>-->
            <img src="resource/image/rsz_o-vaccinated-facebook_1.jpg"  class="img-responsive"  alt=""/>
            <img src="resource/image/rsz_img_4010.jpg"  class="img-responsive"  alt=""/></div>
    </div>
    <div class="col-md-4">
        <div class="fproducts">
            <div class="fprodheader">Vaccine List 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="jcarousel-control-prev"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>&nbsp;
                <a href="#" class="jcarousel-control-next"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i></a>
            </div>
            <div class="jcarousel-skin-default">
                <div class="jcarousel" id="jcarousel2">
                    <ul class="jcarousel-skin-tango">
                        <?php while ($vaccine = mysqli_fetch_array($query)) { ?>
                            <li>
                                <div id="fd-products">
                                    <div class="fpthumb"><a href="#"><img src="resource/image/vaccine_img.jpg" width="100" height="67" /></a></div>
                                    <div class="fpdetails">
                                        <div><a class="pname" href="vaccine_details.php?id=<?php echo $vaccine['trade_id']; ?>&&vaccine_name=<?php echo $vaccine['generic_name']; ?>"><?php echo $vaccine['generic_name']; ?></a></div>
                                        <div class="pgen"><?php echo $vaccine['trade_name']; ?></div>
                                        <div class="pdt">Current Stock :  <?php
                                            if ($vaccine['current_stock'] <= 0) {
                                                echo "<span class='blink_me'><strong>" . $vaccine['current_stock'] . '</strong></span>';
                                            } else {
                                                echo '<span style=color:green;><strong>' . $vaccine['current_stock'] . '</strong></span>';
                                            }
                                            ?></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>     
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$today = date('Y-m-d');
if ($org['c_date'] != $today) {
    ?>
    <div id="openModal" class="modalDialog">
        <div style="font-family: initial;">
            <h4 style="font-size:20px; text-align:center; color: #660066"><strong>Check Operational Date</strong></h4>
            <p style="font-size:20px;">Working Date:<strong><?php echo date('l, M d, Y', strtotime($org['c_date'])); ?></strong></p>
            <p style="font-size:20px;">Current Date:<strong><?php echo date('l, M d, Y', strtotime($today)); ?></strong></p>
            <h4 class="modal-title" style="text-align:center;">Are you sure to continue this?</h4>
            <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                <a href="index.php" class="btn btn-info">Agree</a>
                <a href="?status=logout" class="btn btn-danger">Back</a>
            </div>

        </div>
    </div>
<?php } ?>

