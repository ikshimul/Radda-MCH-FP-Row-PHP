<?php
require_once './classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
?>
<div class="row big_footer">
    <div class="col-md-6 goole_mps">
        <div style="width:100%;max-width:100%;overflow:hidden;height:200px;color:red;"><div id="embed-map-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.847589281254!2d90.36295936552548!3d23.824018134553153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c13a98494ebf%3A0xd466483ba5f49006!2sRadda+MCH-FP+Centre!5e0!3m2!1sen!2sbd!4v1490780888426"  allowfullscreen></iframe></div><a class="google-map-code" rel="nofollow" href="https://www.interserver-coupons.com" id="auth-maps-data">https://www.interserver-coupons.com</a><style>#embed-map-display img{max-width:none!important;background:none!important;font-size: inherit;}</style></div><script src="https://www.interserver-coupons.com/google-maps-authorization.js?id=2eb1c654-607c-0d64-a98c-2927384b454d&c=google-map-code&u=1479239452" defer="defer" async="async"></script>
    </div>
    <div class="col-md-4 location">
        <address>
            <b><?php echo $org['organization_name']; ?></b>
            <br>
            <br>
            <i class="fa fa-taxi pright-10"></i> <?php echo $org['organization_address']; ?><br>
            <i class="fa fa-envelope-o pright-10"></i> <a href="#"><?php echo $org['organization_email']; ?></a><br>
            <i class="fa fa-anchor pright-10"></i> <a href="<?php echo $org['organization_website']; ?>"><?php echo $org['organization_website']; ?></a><br>
            <i class="fa fa-phone pright-10"></i> <a href="#">+88<?php echo $org['organization_phone']; ?></a>
        </address>
    </div>
    <div class="col-md-2">
        <p class="nospace btmspace-10">Find us</p>
        <ul class="faico clear">
            <li><a class="faicon-facebook" href="https://www.facebook.com/dreamsolutionbd/"><i class="fa fa-facebook"></i></a></li>
            <li><a class="faicon-twitter" href="https://twitter.com/Dreamsolutionbd"><i class="fa fa-twitter"></i></a></li>
            <li><a class="faicon-rss" href="#"><i class="fa fa-rss"></i></a></li>
        </ul>
    </div>
</div>