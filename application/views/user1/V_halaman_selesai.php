<body >
<?php  $this->load->view('umum/user1/V_sidebar_user1'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/user1/V_navbar_user1'); ?>
<?php  $this->load->view('umum/user1/V_data_user1'); ?>
<div class="container-fluid ">
<div class=" mt-2 text-center text-info ">
<h5 align="center"><i class="far fa-3x fa-flag"></i><br>Pekerjaan diselesaikan
</h5>
</div>

    
<div class="row mt-2 ">
    <div class="col">
<table style="width:100%;" id="data_selesai" class="table table-striped "><thead>
<th align="center" aria-controls="datatable-fixed-header"  >No</th>
<th align="center" aria-controls="datatable-fixed-header"  >Nama client</th>
<th align="center" aria-controls="datatable-fixed-header"  >Jenis pekerjaan</th>
<th align="center" aria-controls="datatable-fixed-header"  >pembuat pekerjaan</th>
<th align="center" aria-controls="datatable-fixed-header"  >tanggal selesai</th>
<th align="center" aria-controls="datatable-fixed-header"  >Aksi</th>
</thead>
<tbody align="center">
</table> 
    </div>    
</div>
</div>

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

var t = $("#data_selesai").dataTable({
initComplete: function() {
var api = this.api();
$('#data_selesai')
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

ajax: {"url": "<?php echo base_url('User1/json_data_pekerjaan_selesai') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "id_data_pekerjaan",
"orderable": false
},
{"data": "nama_client"},
{"data": "jenis_perizinan"},
{"data": "pembuat_pekerjaan"},
{"data": "tanggal_selesai"},
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
function lihat_berkas(no_pekerjaan){
window.location.href="<?php echo base_url('User1/berkas_dikerjakan/') ?>"+no_pekerjaan;
}
</script>

</body>
</html>
