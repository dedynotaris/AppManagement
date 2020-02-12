<?php 
class DataArsip extends CI_Controller{
public function __construct() {
parent::__construct();
$this->load->helper('download');
$this->load->library('session');
$this->load->model('M_data_arsip');
$this->load->library('Datatables');
$this->load->library('upload');
$this->load->library('form_validation');
$this->load->library('pagination');
if(!$this->session->userdata('username')){
redirect(base_url('Menu'));
}
}

public function index(){
$this->load->view('umum/V_header');
$this->load->view('DataArsip/Search');
}


public function cari_dokumen(){
if($this->input->get()){
$input = $this->input->get();
if(strlen($input['term']) > 0){
$data_dokumen         = $this->M_data_arsip->pencarian_data_dokumen($input['term']);

if($data_dokumen->num_rows() == 0){
$json_data_dokumen[] = array(
"Tidak ditemukan data dokumen"    
);
    
}else{
     
foreach ($data_dokumen->result_array() as $d){
$json_data_dokumen[] = array(    
'value'               =>$input['term'],
'label'               =>$d['value_meta'],
'nama_dokumen'        =>$d['nama_dokumen'],
'nama_meta'           =>str_replace('_', ' ',$d['nama_meta']),
'value_meta'          =>str_replace('_', ' ',$d['value_meta']),
'nama_client'         =>$d['nama_client'],
);  
}
echo json_encode($json_data_dokumen);

}
}
}else{
redirect(404);    
}
}


public function check_akses(){
if($this->input->post()){

$data = $this->db->get_where('sublevel_user',array('no_user'=>$this->session->userdata('no_user'),'sublevel'=>$this->input->post('model')));

if($data->num_rows() == 1){
$status = array(
"status"=>"success",
"pesan"=>"Success Dashboard "
);
$this->session->set_userdata(array('sublevel'=>$this->input->post('model')));
}else if($this->session->userdata('level') == 'Super Admin'){

$status = array(
"status"=>"success",
"pesan"=>"Success Dashboard "
);

}else{
$status = array(
"status"=>"error",
"pesan"=>"Anda tidak memiliki akses kemenu tersebut "
);

}
echo json_encode($status);


}else{
redirect(404);	
}
}

public function Pencarian(){
if($this->input->get('search') && $this->input->get('kategori')){    
    
$this->load->view('umum/V_header');
$this->load->view('DataArsip/HasilPencarian');
}else{
    redirect(base_url());    
    
}    
}

public function keluar(){
$this->session->sess_destroy();
redirect (base_url('Login'));
}

public function ProsesPencarian(){
$input = $this->input->get();
if($input['kategori'] == "dokumen_penunjang"){
$this->HasilPencarianDokumenPenunjang($input);
}else if($input['kategori'] == "dokumen_utama"){
$this->HasilPencarianDokumenUtama($input);    
}else if($input['kategori'] == "data_client"){
$this->HasilPencarianClient($input);        
}else{
$this->HasilPencarianDokumenPenunjang($input);    
}

}


public function HasilPencarianDokumenPenunjang($input){
$total                  = $this->M_data_arsip->pencarian_data_dokumen($input['search'])->num_rows();    
$config['base_url']     = base_url('DataArsip/ProsesPencarian/');
$config['total_rows']   = $total;
$config['per_page']     = 15;
$config['display_pages'] = TRUE;


$from = $this->uri->segment(3);    

// Membuat Style pagination untuk BootStrap v4
$config['first_link']       = 'Awal';
$config['last_link']        = 'Terakhir';
$config['next_link']        = 'Selanjutnya';
$config['prev_link']        = 'Sebelumnya';
$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-left">';
$config['full_tag_close']   = '</ul></nav></div>';
$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
$config['num_tag_close']    = '</span></li>';
$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close']  = '</span>Next</li>';
$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['last_tagl_close']  = '</span></li>';

$this->pagination->initialize($config);   

$data_dokumen_penunjang  = $this->M_data_arsip->HasilPencarianDokumenPenunjang($input,$config['per_page'],$from);
if($data_dokumen_penunjang->num_rows() > 0){
foreach ($data_dokumen_penunjang->result_array() as $penunjang){
$ext = pathinfo($penunjang['nama_berkas'], PATHINFO_EXTENSION);
echo "<div class='row  mt-2 mb-2'>
<div class='col'>
<div class='row'>
<div class='col-md-9'>
Nama Dokumen    : ".$penunjang['nama_dokumen']."<br>
Nama Client     : ".$penunjang['nama_client']."</br>
Hasil Pencarian : ".str_replace('_', ' ',$penunjang['nama_meta'])."  ".str_replace('_', ' ',$penunjang['value_meta'])."</br>
</div>
<div class='col text-center' onclick=LihatFile('dokumen_penunjang','".$penunjang['no_berkas']."');>
";
if($ext =="docx" || $ext =="doc" ){
  echo"<img style='width:80px; height:80px;'  src='".base_url('assets/wordicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
  }else if($ext == "xlx"  || $ext == "xlsx"){
  echo"<img style='width:80px; height:80px;'  src='".base_url('assets/excelicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
  }else if($ext == "PDF"  || $ext == "pdf"){
  echo"<img style='width:80px; height:80px;'  src='".base_url('assets/pdficon.png')."' alt='MS WORD' class='  img-thumbnail'>";
  }else if($ext == "JPG"  || $ext == "jpg" || $ext == "png"  || $ext == "PNG"){
  echo"<img style='width:80px; height:80px;'  src='".base_url('assets/imageicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
  }else{
  echo"<img style='width:80px; height:80px;'  src='".base_url('assets/othericon.png')."' alt='MS WORD' class='  img-thumbnail'>";
  }
echo "
</div>
</div>
</div>
</div>
<hr>";

}
echo " <div id='pagination'>".$this->pagination->create_links()."</div>";
echo "</div>";
}else{
echo "<div class='row  mt-2 mb-2'>
<div class='col mt-5 text-center justify-content-center'>";
echo "<img style='width:auto; height:100px;' src=". base_url('assets/404.png').">";    
echo"</div></div>";

}
}

public function HasilPencarianDokumenUtama($input){
$total = $this->M_data_arsip->pencarian_data_dokumen_utama($input['search'])->num_rows();
    
$config['base_url']     = base_url('DataArsip/ProsesPencarian/');
$config['total_rows']   = $total;
$config['per_page']     = 15;
$config['display_pages'] = TRUE;


$from = $this->uri->segment(3);    

// Membuat Style pagination untuk BootStrap v4
$config['first_link']       = 'Awal';
$config['last_link']        = 'Terakhir';
$config['next_link']        = 'Selanjutnya';
$config['prev_link']        = 'Sebelumnya';
$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-left">';
$config['full_tag_close']   = '</ul></nav></div>';
$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
$config['num_tag_close']    = '</span></li>';
$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close']  = '</span>Next</li>';
$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['last_tagl_close']  = '</span></li>';

$this->pagination->initialize($config);       

$dokumen_utama = $this->M_data_arsip->HasilPencarianDokumenUtama($input,$config['per_page'],$from);
if($dokumen_utama->num_rows() > 0){
foreach ($dokumen_utama->result_array() as $utama){
  echo "<div class='row  mt-2 mb-2'>
  <div class='col'>
  <div class='row'>
  <div class='col-md-9'>
  Jenis Dokumen    : ".$utama['jenis']."<br>
  Nama Client     : ".$utama['nama_client']."</br>
  Hasil Pencarian : ".$utama['nama_berkas']."</br>
  </div>
  <div class='col text-center' onclick=LihatFile('dokumen_utama','".$utama['id_data_dokumen_utama']."') >
  ";

$ext = pathinfo($utama['nama_file'], PATHINFO_EXTENSION);

if($ext =="docx" || $ext =="doc" ){
echo"<img style='width:80px; height:80px;'  src='".base_url('assets/wordicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
}else if($ext == "xlx"  || $ext == "xlsx"){
echo"<img style='width:80px; height:80px;'  src='".base_url('assets/excelicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
}else if($ext == "PDF"  || $ext == "pdf"){
echo"<img style='width:80px; height:80px;'  src='".base_url('assets/pdficon.png')."' alt='MS WORD' class='  img-thumbnail'>";
}else if($ext == "JPG"  || $ext == "jpg" || $ext == "png"  || $ext == "PNG"){
echo"<img style='width:80px; height:80px;'  src='".base_url('assets/imageicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
}else{
echo"<img style='width:80px; height:80px;'  src='".base_url('assets/othericon.png')."' alt='MS WORD' class='  img-thumbnail'>";
}
echo "
</div>
</div><hr>";
}
echo " <div id='pagination'>".$this->pagination->create_links()."</div>";
echo "</div>";    
}else{
echo "<div class='row  mt-2 mb-2'>
<div class='col mt-5 text-center justify-content-center'>";
echo "<img style='width:auto; height:100px;' src=". base_url('assets/404.png').">";    
echo"</div></div>";

}
}

public function HasilPencarianClient($input){
    
$total = $this->M_data_arsip->pencarian_data_client($input['search'])->num_rows();
    
$config['base_url']     = base_url('DataArsip/ProsesPencarian/');
$config['total_rows']   = $total;
$config['per_page']     = 15;
$config['display_pages'] = TRUE;


$from = $this->uri->segment(3);    

// Membuat Style pagination untuk BootStrap v4
$config['first_link']       = 'Awal';
$config['last_link']        = 'Terakhir';
$config['next_link']        = 'Selanjutnya';
$config['prev_link']        = 'Sebelumnya';
$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-left">';
$config['full_tag_close']   = '</ul></nav></div>';
$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
$config['num_tag_close']    = '</span></li>';
$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['prev_tagl_close']  = '</span>Next</li>';
$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
$config['first_tagl_close'] = '</span></li>';
$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
$config['last_tagl_close']  = '</span></li>';

$this->pagination->initialize($config);    
    

$data_client = $this->M_data_arsip->HasilPencarianDataClient($input,$config['per_page'],$from);
 if($data_client->num_rows() > 0){
foreach ($data_client->result_array() as $client){

  echo "<div class='row  mt-2 mb-2'>
  <div class='col'>
  <div class='row'>
  <div class='col-md-9'>
  Nama Client     : ".$client['nama_client']."</br>
  Jenis Client    : ".$client['jenis_client']."<br>
  No identitas    : ".$client['no_identitas']."<br>
  </div>
  <div class='col text-center'>
  ";
  if($client['jenis_client'] =="Badan Hukum" ){
    echo"<img style='width:80px; height:80px;'  src='".base_url('assets/badanhukumicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
  }else if($client['jenis_client'] =="Perorangan"){
      echo"<img style='width:80px; height:80px;'  src='".base_url('assets/peroranganicon.png')."' alt='MS WORD' class='  img-thumbnail'>";
  }
  echo "
</div>
</div><hr>";
  }
  echo " <div id='pagination'>".$this->pagination->create_links()."</div>";
echo "</div>";    
}else{
echo "<div class='row  mt-2 mb-2'>
<div class='col mt-5 text-center justify-content-center'>";
echo "<img style='width:auto; height:100px;' src=". base_url('assets/404.png').">";    
echo"</div></div>";

}

}

public function BukaFile(){
if($this->input->post()){
$input = $this->input->post();
if($input['jenis_dokumen']== "dokumen_penunjang"){
  $this->db->select('data_meta_berkas.nama_meta,'
  . 'data_meta_berkas.value_meta,'
  . 'nama_dokumen.nama_dokumen,'
  . 'data_meta_berkas.no_berkas,'
  . 'data_client.nama_client,'
  . 'data_client.nama_folder,'
  . 'data_berkas.nama_berkas');
$this->db->from('data_meta_berkas');
$this->db->join('data_berkas', 'data_berkas.no_berkas = data_meta_berkas.no_berkas');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta_berkas.no_nama_dokumen');
$this->db->join('data_pekerjaan', 'data_pekerjaan.no_pekerjaan = data_meta_berkas.no_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->group_by('data_meta_berkas.no_berkas');
$this->db->where('data_meta_berkas.no_berkas',$input['no_dokumen']);
$query = $this->db->get()->row_array();

$ext = pathinfo($query['nama_berkas'], PATHINFO_EXTENSION);
if($ext =="docx" || $ext =="doc" || $ext =="pptx" ){
$data[] =array(
'status'   =>'Dokumen Download',
'messages' =>$query['nama_dokumen'].' Dokumen Berhasil di download',
'link'     =>base_url("berkas/".$query['nama_folder']."/".$query['nama_berkas']),
);
}else if($ext == "JPG"  || $ext == "jpg" || $ext == "png"  || $ext == "PNG"){
$data[] = array(
'titel'  =>$query['nama_dokumen']." ".$query['nama_client'],
'link'   =>'<iframe class="embed-responsive-item " src="'.base_url('DataArsip/BukaGambar/dokumen_penunjang/'.$query['no_berkas']).'"></iframe>',
'status' =>'Dokumen Lihat'
);
}else{    
$data[] = array(
'titel'  =>$query['nama_dokumen']." ".$query['nama_client'],
'link'   =>'<iframe class="embed-responsive-item " src="'.base_url("berkas/".$query['nama_folder']."/".$query['nama_berkas']).'" ></iframe>',
'status' =>'Dokumen Lihat'
);
}
}else if($input['jenis_dokumen'] == 'dokumen_utama'){
  $this->db->select('data_dokumen_utama.nama_berkas,'
  . 'data_dokumen_utama.tanggal_akta,'
  . 'data_dokumen_utama.nama_file,'
  . 'data_client.nama_client,'
  . 'data_client.nama_folder,'
  . 'data_dokumen_utama.id_data_dokumen_utama,'
  . 'data_dokumen_utama.jenis');
$this->db->from('data_dokumen_utama');
$this->db->join('data_pekerjaan', 'data_pekerjaan.no_pekerjaan = data_dokumen_utama.no_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->where('data_dokumen_utama.id_data_dokumen_utama',$input['no_dokumen']);
$query = $this->db->get()->row_array();

  $ext = pathinfo($query['nama_file'], PATHINFO_EXTENSION);
  if($ext =="docx" || $ext =="doc" ){
  $data[] =array(
  'status'   =>'Dokumen Download',
  'messages' =>$query['jenis'].' Dokumen Berhasil di download',
  'link'     =>base_url("berkas/".$query['nama_folder']."/".$query['nama_file']),
  );
  }else{
  $data[] = array(
  'titel'  =>$query['jenis']." ".$query['nama_client'],
  'link'   =>base_url("berkas/".$query['nama_folder']."/".$query['nama_file']),
  'status' =>'Dokumen Lihat'
  );
  }
  


}
echo json_encode($data);
}else{
redirect(404);
}
}

public function BukaGambar($jenis_dokumen,$no_berkas){
if($jenis_dokumen == 'dokumen_penunjang'){
$this->db->select('data_meta_berkas.nama_meta,'
  . 'data_meta_berkas.value_meta,'
  . 'nama_dokumen.nama_dokumen,'
  . 'data_meta_berkas.no_berkas,'
  . 'data_client.nama_client,'
  . 'data_client.nama_folder,'
  . 'data_berkas.nama_berkas');
$this->db->from('data_meta_berkas');
$this->db->join('data_berkas', 'data_berkas.no_berkas = data_meta_berkas.no_berkas');
$this->db->join('nama_dokumen', 'nama_dokumen.no_nama_dokumen = data_meta_berkas.no_nama_dokumen');
$this->db->join('data_pekerjaan', 'data_pekerjaan.no_pekerjaan = data_meta_berkas.no_pekerjaan');
$this->db->join('data_client', 'data_client.no_client = data_pekerjaan.no_client');
$this->db->group_by('data_meta_berkas.no_berkas');
$this->db->where('data_meta_berkas.no_berkas',$no_berkas);
$query = $this->db->get()->row_array();    
echo '​<div class="container" >'
. '<div class="row">'
. '<div class="col-md-6">'
. '<img  src="'.base_url("berkas/".$query['nama_folder']."/".$query['nama_berkas']).'">'
. '​</div></div></div>';
}
}

}