<body>
<div class="wrapper">
<?php  $this->load->view('umum/V_sidebar'); ?>
<div id="content">
<?php  $this->load->view('umum/V_navbar'); ?>

<div class="data_content card p-2 m-3 ">
   
    
<!-- Nav tabs -->
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#jenis">Pengaturan Jenis Dokumen <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#dokumen">Pengaturan Data Dokumen <i class="fas fa-cogs"></i></a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#aplikasi">Pengaturan Aplikasi <i class="fas fa-cogs"></i></a>
</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<!----------------------------Jenis Dokumen------------------------------>
<div class="tab-pane container active" id="jenis">
<div class="row p-2">
<div class="col">

<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah_jenis_dokumen">Tambahkan Jenis Dokumen <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Data persyaratan jenis dokumen</h5>
<table id="data_jenis_dokumen" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no nama dokumen</th>
<th  align="center" aria-controls="datatable-fixed-header"  >pekerjaan</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama jenis</th>
<th style="width: 25%;" align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>

</div>
</div>



</div>
<!----------------------------Dokumen------------------------------>
<div class="tab-pane container fade" id="dokumen">
<div class="row p-2">
<div class="col">
<button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah_data_dokumen">Tambahkan Data Dokumen <i class="fa fa-plus"></i></button>
<h5 align="center">&nbsp;</h5>
<hr>
<h5 align="center">Data Nama Dokumen</h5>
<table style="width:100%;" id="data_nama_dokumen" class="table table-striped table-condensed  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >no nama dokumen</th>
<th  align="center" aria-controls="datatable-fixed-header"  >nama dokumen</th>
<th style="width: 25%;" align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table>


</div>
</div>

</div>
<!----------------------------Aplikasi------------------------------>
<div class="tab-pane container fade" id="aplikasi">

<div class="row p-2 ">
<div class="col-md-12 text-center">Pengaturan User <br> <i class="fa fa-3x fa-users"></i> <hr></div>

<div class="col-md-4">
<label>Username</label>
<input type="text" class="form-control" id="username" placeholder="Username . . .">
<label>Nama Lengkap</label>
<input type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap . . .">
<label>Level</label>
<select class="form-control" id="level">
<option value="Admin">Admin</option>
<option Value="Super Admin">Super Admin</option>
</select>

<label>Status</label>
<select class="form-control" id="status">
<option value="Admin">Aktif</option>
<option Value="Super Admin">Tidak Aktif</option>
</select>

<hr>
<label>Password</label>
<input type="password" id="password" class="form-control" placeholder="Username . . .">
<label>Ulangi Password</label>
<input type="password" id="ulangi_password" class="form-control" placeholder="Username . . .">
<hr>
<button class="btn btn-block btn-success" id="simpan_user">Simpan</button> 
</div>
<div class="col card p-2">
<?php foreach($user->result_array() as $data_user){ ?>
<div class="row"> 
<div class="col-md-3">
<?php 
if($data_user['foto'] ==NULL){
echo "<img class='card p-1' style='width:90%; height:auto;' src=".base_url('uploads/user/user.png').">";

}else{

}
?>

</div>


<div class="col">
No User        : <?php echo $data_user['no_user']; ?><br>
Nama Lengkap   : <?php echo $data_user['nama_lengkap']; ?><br>
Username       : <?php echo $data_user['username']; ?><br>
Tanggal Daftar : <?php echo $data_user['tanggal_daftar']; ?><br>
Level          : <?php echo $data_user['level']; ?><br>
Status         : <?php echo $data_user['status']; ?><br>
</div>
<div class="col-md-2">
<button class="btn btn-warning mx-auto" onclick="getUser('<?php echo base64_encode($data_user['id_user']) ?>')"   data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-user-edit"></i> Edit</button>
</div>
</div><hr>

<?php } ?>

</div>
</div>
</div>



</div>
</div>
</div>
<!------------- Modal Edit---------------->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update User </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<input type="hidden" value="" class="form-control" id="id_edit" placeholder="Username . . .">
<label>Username</label>
<input type="text" class="form-control" id="username_edit" placeholder="Username . . .">
<label>Nama Lengkap</label>
<input type="text" class="form-control" id="nama_lengkap_edit" placeholder="Nama Lengkap . . .">
<label>Level</label>
<select class="form-control" id="level_edit">
<option value="Admin">Admin</option>
<option Value="Super Admin">Super Admin</option>
</select>

<label>Status</label>
<select class="form-control" id="status_edit">
<option value="Admin">Aktif</option>
<option Value="Super Admin">Tidak Aktif</option>
</select>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success" id="update_user">Update User</button>
</div>
</div>
</div>
</div>
<!------------- Modal Edit---------------->

<!------------- Modal Tambah Syarat---------------->
<div class="modal fade bd-example-modal-lg" id="tambah_syarat" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="tambah_syarat1">Tambahkan Syarat <span id="title"> </span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12 mx-auto text-center">
<input type="text" class="form-control" id="cari_nama_dokumen" placeholder="cari nama dokumen">
</div>
</div>
    
<hr>

<form id="tambahkan_data" action="<?php echo base_url('Dashboard/simpan_syarat') ?>" method="post">
<input type="hidden" name="token" id="id_jenis" value="">    
    
</form>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success"  id="simpan_syarat">Simpan Syarat</button>
</div>
</div>
</div>
</div>
<!------------- Modal Tambah Syarat---------------->
<!------------- Modal Tambah jenis dokumen---------------->
<div class="modal fade bd-example-modal-lg" id="tambah_jenis_dokumen" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="tambah_syarat1">Tambahkan Syarat <span id="title"> </span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <label>Tambahkan Jenis Dokumen</label> 
<input type="text" id="jenis_dokumen" class="form-control" name="jenis Dokumen" placeholder="Jenis Dokumen">
<label>Pekerjaan</label>
<select name="pekerjaan" id="pekerjaan" class="form-control">
    <option>NOTARIS</option>   
    <option>PPAT</option>   
</select>
<hr>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success"  id="simpan_jenis">Simpan Jenis Dokumen</button>
</div>
</div>
</div>
</div>
<!------------- Modal Tambah jenis dokumen---------------->

<!------------- Modal Tambah jenis dokumen---------------->
<div class="modal fade bd-example-modal-lg" id="tambah_data_dokumen" tabindex="-1" role="dialog" aria-labelledby="tambah_syarat1" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<div class="modal-header">
<h6 class="modal-title" id="tambah_syarat1">Tambahkan Syarat <span id="title"> </span> </h6>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<label>Tambahkan Nama Dokumen</label> 
<input type="text"  class="form-control" id="nama_dokumen" name="Nama Dokumen" placeholder="Nama Dokumen">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success"  id="simpan_dokumen">Simpan Nama Dokumen</button>
</div>
</div>
</div>
</div>
<!------------- Modal Tambah jenis dokumen---------------->


<script type="text/javascript">
 
 
function buat_syarat(id_jenis){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"POST",
url:"<?php echo base_url('Dashboard/getJenis') ?>",
data:"token="+token+"&id_jenis_dokumen="+id_jenis,
success:function(data){
var r = JSON.parse(data);
$("#title").html(r.nama_jenis);
$("#id_jenis").val(r.no_jenis_dokumen);
$(".data_syarat").remove();

}
    
});

}

function getUser(id_user){
var token    = "<?php echo $this->security->get_csrf_hash() ?>";
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/getUser') ?>",
data:"token="+token+"&id_user="+id_user,
success:function(data){
var r = JSON.parse(data);
$("#id_edit").val(r.id_user);
$("#username_edit").val(r.username);
$("#nama_lengkap_edit").val(r.nama_lengkap);

}

});

}

$(document).ready(function(){
$("#simpan_jenis").on("click",function(){
var token         = "<?php echo $this->security->get_csrf_hash() ?>";
var jenis_dokumen = $("#jenis_dokumen").val();
var pekerjaan    = $("#pekerjaan option:selected").text();

if(jenis_dokumen !=''){
$.ajax({
type:"POST",
url:"<?php echo base_url('Dashboard/simpan_jenis_dokumen') ?>",
data:"token="+token+"&jenis_dokumen="+jenis_dokumen+"&pekerjaan="+pekerjaan,
success:function(data){
var r = JSON.parse(data);
if(r.status =="Berhasil"){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'success',
title: 'Jenis Dokumen Berhasil Ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}

}   

});

}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Masukan Jenis dokumen.'
})

}

});


$("#simpan_user").click(function(){
var username        = $("#username").val();
var nama_lengkap    = $("#nama_lengkap").val();
var level           = $( "#level option:selected" ).text();
var status          = $( "#status option:selected" ).text();
var password        = $("#password").val();
var ulangi_password = $("#ulangi_password").val();
var token    = "<?php echo $this->security->get_csrf_hash() ?>";

if(password != '' && status !='' && ulangi_password !='' && level !='' && nama_lengkap !='' && username !='' ){
if(password != ulangi_password){
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Password yang anda masukan tidaklah sesuai.'
})
}else{
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_user')?>",
data:"token="+token+"&username="+username+"&password="+password+"&level="+level+"&nama_lengkap="+nama_lengkap+"&status="+status,
success:function(data){
var r = JSON.parse(data);
if(r.status =="Berhasil"){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'success',
title: 'User Berhasil ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}

}

});

}
}else{

const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Data yang dimasukan belum lengkap.'
})
}
});

$("#update_user").click(function(){
var username        = $("#username_edit").val();
var nama_lengkap    = $("#nama_lengkap_edit").val();
var level           = $("#level_edit option:selected" ).text();
var status          = $("#status_edit option:selected" ).text();
var id_user         = $("#id_edit").val();
var token           = "<?php echo $this->security->get_csrf_hash() ?>";

$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/update_user') ?>",
data:"token="+token+"&id_user="+id_user+"&username="+username+"&nama_lengkap="+nama_lengkap+"&level="+level+"&status="+status,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Berhasil"){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'success',
title: 'User Berhasil diperbaharui.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}
}

});
});

$("#simpan_dokumen").click(function(){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var nama_dokumen    = $("#nama_dokumen").val();

if(nama_dokumen != ''){
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_nama_dokumen') ?>",
data:"token="+token+"&nama_dokumen="+nama_dokumen,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Berhasil"){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'success',
title: 'Dokumen Berhasil Ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}

}    

});


}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Nama Dokumen Belum di isikan.'
})   
}

});


$("#simpan_syarat").click(function(){
var jumlah_syarat         = $('.data_syarat').length+1;


if ($('.data_syarat').length > 0 ){
    
var no_jenis_dokumen      = $('#id_jenis').val();

for(i=1; i<jumlah_syarat; i++){
var token           = "<?php echo $this->security->get_csrf_hash() ?>";
var no_nama_dokumen = $("#no_nama_dokumen"+i).val();
var nama_syarat     = $("#nama_syarat"+i).val();
var status_syarat   = $("input[name=status_syarat"+i+"]:checked").val();
$.ajax({
type:"post",
url:"<?php echo base_url('Dashboard/simpan_syarat') ?>",
data:"token="+token+"&no_jenis_dokumen="+no_jenis_dokumen+"&no_nama_dokumen="+no_nama_dokumen+"&nama_syarat="+nama_syarat+"&status_syarat="+status_syarat,
success:function(data){

var r = JSON.parse(data);
if(r.status =="Berhasil"){
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated zoomInDown'
});

Toast.fire({
type: 'success',
title: 'Syarat Berhasil Ditambahkan.'
}).then(function() {
window.location.href = "<?php echo base_url('Dashboard/setting'); ?>";
})
}else{
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'error',
title: 'Kesalahan.'
})
}
}
});

}

}else{
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Cari Nama dokumen terlebih dahulu.'
})

}

});

});

$(function () {
var <?php echo $this->security->get_csrf_token_name();?>  = "<?php echo $this->security->get_csrf_hash(); ?>"       
$("#cari_nama_dokumen").autocomplete({
minLength:0,
delay:0,
source:'<?php echo site_url('Dashboard/cari_nama_dokumen') ?>',
select:function(event, ui){
if ($(".syarat_dokumen"+ui.item.id_nama_dokumen).length) {
const Toast = Swal.mixin({
toast: true,
position: 'center',
showConfirmButton: false,
timer: 3000,
animation: false,
customClass: 'animated tada'
});

Toast.fire({
type: 'warning',
title: 'Nama Dokumen sudah ditambahkan.'
})
}else{
var jumlah_syarat = $('.data_syarat').length+1;
    
$("#cari_nama_dokumen").val("");
$('#tambahkan_data').append("<div class='row data_syarat syarat_dokumen"+ui.item.id_nama_dokumen+"'>\n\
\n\<input type='hidden' id='no_nama_dokumen"+jumlah_syarat+"' name='no_nama_dokumen"+jumlah_syarat+"' readonly class='form-control-plaintext' id='nama_dokumen"+ui.item.no_nama_dokumen+"' value='"+ui.item.no_nama_dokumen+"'>\n\
<div class='col'><input type='text' id='nama_syarat"+jumlah_syarat+"' name='syarat"+jumlah_syarat+"' readonly class='form-control-plaintext' id='nama_dokumen"+ui.item.id_nama_dokumen+"' value='"+ui.item.nama_dokumen+"'></div>\n\
<div class='col-md-3'><input name='status_syarat"+jumlah_syarat+"' value='wajib' id='status_syarat"+jumlah_syarat+"'  type='checkbox'> Wajib</div>\n\
</div>");

}

}
}
);
});

</script>

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_nama_dokumen").dataTable({
initComplete: function() {
var api = this.api();
$('#data_nama_dokumen')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('Dashboard/json_data_nama_dokumen') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_nama_dokumen",
"orderable": false
},
{"data": "no_nama_dokumen"},
{"data": "nama_dokumen"},
{"data": "view"}


],
order: [[0, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});
</script> 

<script type="text/javascript">
$(document).ready(function() {
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
return {
"iStart": oSettings._iDisplayStart,
"iEnd": oSettings.fnDisplayEnd(),
"iLength": oSettings._iDisplayLength,
"iTotal": oSettings.fnRecordsTotal(),
"iFilteredTotal": oSettings.fnRecordsDisplay(),
"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
};
};

var t = $("#data_jenis_dokumen").dataTable({
initComplete: function() {
var api = this.api();
$('#data_jenis_dokumen')
.off('.DT')
.on('keyup.DT', function(e) {
if (e.keyCode == 13) {
api.search(this.value).draw();
}
});
},
oLanguage: {
sProcessing: "loading..."
},
processing: true,
serverSide: true,
ajax: {"url": "<?php echo base_url('Dashboard/json_data_jenis_dokumen') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_jenis_dokumen",
"orderable": false
},
{"data": "no_jenis_dokumen"},
{"data": "pekerjaan"},
{"data": "nama_jenis"},
{"data": "view"}


],
order: [[0, 'desc']],
rowCallback: function(row, data, iDisplayIndex) {
var info = this.fnPagingInfo();
var page = info.iPage;
var length = info.iLength;
var index = page * length + (iDisplayIndex + 1);
$('td:eq(0)', row).html(index);
}
});
});
</script> 


</body>

