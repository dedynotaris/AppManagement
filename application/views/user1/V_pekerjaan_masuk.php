<body >
<?php  $this->load->view('umum/user1/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/user1/V_navbar_user1'); ?>
<?php  $this->load->view('umum/user1/V_data_user1'); ?>
<div class="container-fluid  ">
<div class=" mt-2 text-center text-info">
<h5 align="center"><i class="far fa-3x fa-share-square"></i><br>Pekerjaan Baru Masuk
</h5>
</div>

<div class="row mt-2">
<div class="col">    
<table class="table table-striped ">
    <tr class="text-info">
<th>Nama Client</th>
<th>Pekerjaan</th>
<th>Tanggal dibuat</th>
<th>Target selesai</th>
</tr>       
<?php foreach ($data_tugas->result_array() as    $data){  ?>
<tr>        
<td><?php echo $data['nama_client'] ?></td>
<td><?php echo $data['pembuat_pekerjaan'] ?></td>   
<td><?php echo $data['tanggal_dibuat'] ?></td>
<td><?php 


if($data['target_kelar'] == date('Y/m/d')){
echo "<b><span class='text-warning'>Hari ini</span><b>";    
}else if($data['target_kelar'] <= date('Y/m/d')){
$startTimeStamp = strtotime(date('Y/m/d'));
$endTimeStamp = strtotime($data['target_kelar']);
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400; 
$numberDays = intval($numberDays);
echo "<b><span class='text-danger'> Terlewat ".$numberDays." Hari </span><b>" ;
}else{
$startTimeStamp = strtotime(date('Y/m/d'));
$endTimeStamp = strtotime($data['target_kelar']);
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400; 
$numberDays = intval($numberDays);
echo "<b><span class='text-success'>".$numberDays." Hari lagi </span><b>" ;
}
?> 
</tr>
<?php } ?>
</table>    
</div>
</div>
</div>
</div>


</body>
<script type="text/javascript">
function aksi_option(no_pekerjaan,id_data_pekerjaan){
var val = $(".data_option"+id_data_pekerjaan+" option:selected").val();
if(val == 1){
alert(1);    
}else if (val == 2){
$('.pekerjaan'+id_data_pekerjaan).removeAttr("disabled");
}
}
function alihkan_tugas(no_pekerjaan,id_data_pekerjaan){
var no_user             = $(".pekerjaan"+id_data_pekerjaan+" option:selected").val();
var pembuat_pekerjaan   = $(".pekerjaan"+id_data_pekerjaan+" option:selected").text();
var token               = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
data:"token="+token+"&no_pekerjaan="+no_pekerjaan+"&no_user="+no_user+"&pembuat_pekerjaan="+pembuat_pekerjaan,
url:"<?php echo base_url('User1/alihkan_pekerjaan') ?>",
success:function(data){
var r = JSON.parse(data);
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: r.status,
title: r.pesan
}).then(function() {
window.location.href = "<?php echo base_url('User1'); ?>";
});
}

});
}



</script>
</html>
