<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!---------<link href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>--->
<!-----Berikut ini untuk aplikasi datepicker---->
 <link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/style.css">
<script>
$(function() {
$( "#inputdtpckr1" ).datepicker();
$( "#inputdtpckr2" ).datepicker();
$( "#inputdtpckr3" ).datepicker();
$( "#inputdtpckr4" ).datepicker();
});
</script>


<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<h1>APLIKASI MONITORING PROPOSAL</h1>
<!-- Documentation extras -->
<link href="css/signin.css" rel="stylesheet">
<link href="css/docs.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">    
<link href="css/prettify.css" rel="stylesheet">

</head>

<body>
<div class="bs-docs-example">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Input Data</a></li>
              <li><a href="#profile" data-toggle="tab">Profile</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                  <li><a href="#dropdown2" data-toggle="tab">@m</a>            </li>
                </ul>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="home">
              	<div class="container">
			<form id="form1" class="form-signin" name="form1" method="post" action="">
  <p>

<label>Tanggal Masuk Proposal</label>
<input type="text" class="form-control" placeholder="Tanggal Masuk Proposal" name="tanggalprop" value="<?php Form::date('tanggalprop') ?>" id="inputdtpckr1" required autofocus>


<label>Unit</label>
<input type="text" class="form-control" placeholder="Unit" name="unit" value="<?php echo Form::old('unit','example@gmail.com') ?>" id="input2" required>
<label >Nomor Proposal</label>
<input type="text" class="form-control" placeholder="Nomor Proposal" name="no_prop" value="<?php Form::old('no_prop') ?>" id="input2" required>
<label for="input2">Produk</label>
<input type="text" class="form-control" placeholder="Produk" name="produk" value="<?php Form::old('produk') ?>" id="input2" required>
<label for="input2">Nama Debitur</label>
<input type="text" class="form-control" placeholder="Nama Debitur" name="nama_debitur" value="<?php Form::old('nama_debitur') ?>" id="input2" required>
<label for="input2">Plafond pengajuan</label>
<input type="text" class="form-control" placeholder="Plafond pengajuan" name="plf_pengajuan" value="<?php Form::old('plf_pengajuan') ?>" id="input2" required>
<label for="input2">Jenis Pinjaman</label>
<input type="text" class="form-control" placeholder="Jenis Pinjaman" name="jns_pinj" value="<?php Form::old('jns_pinj') ?>" id="input2" required>
<label for="input2">Tgl kirim unit</label>
<input type="text" class="form-control" placeholder="Tgl kirim unit" name="tgl_krm_unit" value="<?php Form::date('tgl_krm_unit') ?>" id="inputdtpckr2" required>
<label for="input2">Tgl Kirim KP</label>
<input type="text" class="form-control" placeholder="Tgl Kirim KP" name="tgl_krm_kp" value="<?php Form::date('tgl_krm_kp') ?>" id="inputdtpckr3" required>
<label for="input2">BWMP Kacab</label>
<input type="text" class="form-control" placeholder="BWMP Kacab" name="bwmpcab" value="<?php Form::old('bwmpcab') ?>" id="input2" required>
<label for="input2">BWMP KP</label>
<input type="text" class="form-control" placeholder="BWMP KP" name="bwmpkp" value="<?php Form::old('bwmpkp') ?>" id="input2" required>
<label for="input2">Tgl Realisasi</label>
<input type="text" class="form-control" placeholder="Tgl Realisasi" name="tgl_real" value="<?php Form::old('tgl_real') ?>" id="inputdtpckr4" required>
<label for="input2">Plafon Realisasi</label>
<input type="text" class="form-control" placeholder="Plafon Realisasi" name="plf_real" value="<?php Form::old('plf_real') ?>" id="input2" required>
<label for="input3">Keterangan</label>
<textarea class="form-control" name="ket" cols="45" rows="5"  id="input3" placeholder="Keterangan"></textarea>
    <p>
    <p>
    <label> </label>
    <button class="btn btn-large btn-primary" name="simpan" id="simpan" value="Submit" >Simpan</button>
        <button class="btn btn-large btn-primary" name="cancel" id="cancel" value="Submit" >Batal </button>

    </p>
  </p>
</form>
				</div>

              </div>
              <div class="tab-pane fade" id="profile">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
              </div>
              <div class="tab-pane fade" id="dropdown1">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              </div>
              <div class="tab-pane fade" id="dropdown2">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
              </div>
            </div>
          </div>
              <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster --
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/jquery.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-transition.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-alert.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-modal.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-dropdown.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-scrollspy.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tab.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tooltip.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-popover.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-button.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-collapse.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-carousel.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-typeahead.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-affix.js"></script>

    <script src="http://getbootstrap.com/2.3.2/assets/js/holder/holder.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>

    <script src="http://getbootstrap.com/2.3.2/assets/js/application.js"></script>
------------->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/widgets.js"></script>
<script src="js/holder.js"></script>
<script src="js/application.js"></script>

<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>


    <!-- Analytics
    ================================================== -->
    <script>
      var _gauges = _gauges || [];
      (function() {
        var t   = document.createElement('script');
        t.type  = 'text/javascript';
        t.async = true;
        t.id    = 'gauges-tracker';
        t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
        t.src = '//secure.gaug.es/track.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(t, s);
      })();
    </script>
    
    <!--script untuk buat datepicker-->

</body>
</html>