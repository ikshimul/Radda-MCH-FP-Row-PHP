<?php
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->vaccine_stock_list();
$future_vaccination = $obj_vac->future_vaccination_list_for_scroll();
$check = mysqli_num_rows($future_vaccination);
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'alert') {
        
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
                                   ?>" href="#" title="<?php echo $future_v['name']; ?> next vaccination after <?php $difference = strtotime($future_v['next_date']) - strtotime($today);
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
            <img src="resource/image/rsz_img_4010.jpg"  class="img-responsive"  alt=""/>
		</div>
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
										        $total_rec=$vaccine['total_receive'];
												$total_issue=$vaccine['total_issue'];
												$total_used=$vaccine['total_used'];
												$current_stock=$total_rec-$total_issue-$total_used;
                                            if ($current_stock <= 0) {
												
                                                echo "<span class='blink_me'><strong>" . $current_stock . '</strong></span>';
                                            } else {
                                                echo '<span style=color:green;><strong>' . $current_stock . '</strong></span>';
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
