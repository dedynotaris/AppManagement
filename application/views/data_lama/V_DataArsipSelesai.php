<body>
<?php $this->load->view('umum/data_lama/V_sidebar_data_lama'); ?>
<div id="page-content-wrapper">
<?php  $this->load->view('umum/data_lama/V_navbar_data_lama'); ?>
<?php  $this->load->view('umum/data_lama/V_data_data_lama'); ?>
<div class="container-fluid ">
<div class="mt-2  text-center  ">
<h5 align="center " class="text-theme1"><span class="fa-2x fas fa-box "></span><br>Arsip Selesai</h5>
</div>

<div class="row">
<div class="col mt-2">
<table style="width:100%;" id="DataArsipSelesai" class="table mt- table-striped table-condensed table-sm table-bordered  table-hover table-sm"><thead>
<tr role="row">
<th  align="center" aria-controls="datatable-fixed-header"  >No</th>
<th  align="center" aria-controls="datatable-fixed-header"  >No Pekerjaaan</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Nama Client</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Asisten</th>
<th  align="center" aria-controls="datatable-fixed-header"  >Jenis Pekerjaan</th>
</thead>
<tbody align="center">
</table> 

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

var t = $("#DataArsipSelesai").dataTable({
initComplete: function() {
var api = this.api();
$('#DataArsipSelesai')
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
ajax: {"url": "<?php echo base_url('Data_lama/JsonDataPekerjaanArsipSelesai') ?> ", 
"type": "POST",
data: function ( d ) {
d.token = '<?php echo $this->security->get_csrf_hash(); ?>';
}
},
columns: [
{
"data": "no_pekerjaan",
"orderable": false
},
{"data": "no_pekerjaan"},
{"data": "nama_client"},
{"data": "nama_lengkap"},
{"data": "nama_jenis"}


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
function download(id_data_berkas){
window.location.href="<?php echo base_url('Dashboard/download_berkas/') ?>"+id_data_berkas
}


</script>



</body>
