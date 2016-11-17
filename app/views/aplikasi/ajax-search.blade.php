<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form Pencarian Cepat Data Blacklist</title>
<style type="text/css">
.headertable {
	background-color: #09F;
	font-family: "Comic Sans MS", cursive;
}
.headertable1 {
	background-color: #FFF;
}
.judulheader {
	font-family: "Courier New", Courier, monospace;
	background-color: #000;
	color: #FFF;
}
</style>

@section('scripts')
    
   <script src = "assets/js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">  
        var allow = true;  
         function loadData(){  
            if(allow){  
                allow = false;  
                $("#result").html('loading...');  
                $.ajax({  
                    url:'aplikasi/ajax-search.blade.php?q='+escape($("#q").val()),  
                    success: function (data){  
                        $("#result").html(data);  
                        allow = true;  
                    }  
                });  
            }  
        }  
        $(document).ready(function(){  
            $("#q").keypress(function(e){  
                if(e.which == '13'){  
                    e.preventDefault();  
                    loadData();  
                }else if($(this).val().length >= 2){  
                    loadData();  
                }  
            });  
        });  
       
    </script>  
@stop
</head>

<body>
    <!--file ajax-search.php -->  
    
<?php if(!isset($_GET['q'])){?>  
    <!-- form quick search -->   
<table width="1170" border="0">
  <tr>
    <td width="1161"><H2><div align="center" class="judulheader">DAFTAR PROPOSAL</div></H2></td>
  </tr>
</table>
    
<form name="form1" method="get" action="#cari">   
    Search : <input type="text" name="q" id="q"/> <input type="submit" value="CARI"/>   
    </form>   
    <!-- tempat hasil pencarian ditampilkan -->  
    <div id="result"></div>  
    <!-- javascript -->  
    <!-- jquery -->  

<?php }
    else{ ?>
    
    <table width="1170" border="0">
  <tr>
    <td width="1161"><H2><div align="center" class="judulheader">DAFTAR PROPOSAL</div></H2></td>
  </tr>
</table>
    
<form name="form1" method="get" action="#cari">   
    Search : <input type="text" name="q" id="q" /> <input type="submit" value="CARI" />   
    </form>   
    <!-- tempat hasil pencarian ditampilkan -->  
    <div id="result"></div>  
    <?php  } ?>  
    <?php   
    
    if(isset($_GET['q']) && $_GET['q']){   
     $conn = mysql_connect("localhost:3307", "root", "mmsPNMonl1n3");   
     mysql_select_db("database");   
     $q = $_GET['q'];   
     $sql = "select * from proposals where nomor_proposal like '%$q%' or nama_debitur like '%$q%'";   
     $result = mysql_query($sql);   
     if(mysql_num_rows($result) > 0){   
     ?>   
     <table width="976">   
     <tr>   
     <td class="headertable">Nomor Proposal</td>   
     <td class="headertable">Nama Debitur</td>   
     <td class="headertable">Unit</td>   
     <td class="headertable">Tanggal Masuk Proposal</td>   
     <td class="headertable">Produk</td>   
     <td class="headertable">Plafond Pengajuan</td>   
     <td class="headertable">Fasilitas</td>   
     <td class="headertable">Tanggal Kirim Unit</td>   
     <td class="headertable">Tanggal Kirim KP</td>   
     <td class="headertable">BWMP Cab</td>   
     <td class="headertable">BWMP KP</td>   
     <td class="headertable">Tanggal Realisasi</td>   
     <td class="headertable">Plafond Realisasi</td>   
     </tr>   
     <?php   
     while($hasil = mysql_fetch_array($result)){?>   
     <tr>   
     <td class="headertable1"><?php echo $hasil['nomor_proposal'];?></td>   
     <td class="headertable1"><?php echo $hasil['nama_debitur'];?></td>   
     <td class="headertable1"><?php echo $hasil['unit'];?></td>   
     <td class="headertable1"><?php echo $hasil['tgl_masuk_proposal'];?></td>   
     <td class="headertable1"><?php echo $hasil['produk'];?></td>   
     <td class="headertable1"><?php echo $hasil['plafond_pengajuan'];?></td>   
     <td class="headertable1"><?php echo $hasil['fasilitas'];?></td>   
     <td class="headertable1"><?php echo $hasil['tgl_kirim_unit'];?></td>   
     <td class="headertable1"><?php echo $hasil['tgl_kirim_kp'];?></td>   
     <td class="headertable1"><?php echo $hasil['bwmpkacab'];?></td>   
     <td class="headertable1"><?php echo $hasil['bwmpkp'];?></td>   
     <td class="headertable1"><?php echo $hasil['tgl_realisasi'];?></td>   
     <td class="headertable1"><?php echo $hasil['plafond_real'];?></td>   
     <td class="headertable1"><a href=<?php echo "aplikasi/".$hasil['nomor_proposal_lain']; ?> >Edit</a></td> 

     </tr>   
     <?php }?>   
     </table>   
     <?php   
     }else{   
     echo 'Data not found!';   
     }   
    }   
    ?>  
</body>
</html>