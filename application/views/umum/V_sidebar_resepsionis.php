<div class="d-flex <?php if($this->session->userdata('toggled') == 'Aktif'){ echo "toggled"; } ?>" id="wrapper">
<div class="bg-theme2" id="sidebar-wrapper">
<div class="sidebar-heading text-center">App Management 
    <hr>
<?php if(!file_exists('./uploads/user/'.$this->session->userdata('foto'))){ ?>
<img style="width:100px; height: 100px;" src="<?php echo base_url('uploads/user/no_profile.jpg') ?>" img="" class=" img rounded-circle" ><br>    
<?php }else{ ?>
<?php if($this->session->userdata('foto') != NULL){ ?>
<img style="width:100px; height: 100px;" src="<?php echo base_url('uploads/user/'.$this->session->userdata('foto')) ?>" img="" class="img rounded-circle" ><br>    
<?php }else{ ?>
<img style="width:100px; height: 100px;" src="<?php echo base_url('uploads/user/no_profile.jpg') ?>" img="" class="img rounded-circle" ><br>        
<?php } ?> 

<?php } ?>
<p style="font-size:17px;">Welcome<br>    
    <?php echo $this->session->userdata('nama_lengkap') ?></p>

</div>
<div class="list-group list-group-flush">
      
<ul class="list-unstyled components">
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/buku_tamu'); ?>"><i class="fa fa-address-book"></i> Buku Tamu</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/data_akta'); ?>"><i class="fas fa-book"></i> Input Akta</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/data_kas'); ?>"><i class="fa fa-exchange-alt"></i> Kas</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/notaris_rekanan'); ?>"><i class="fas fa-users"></i> Notaris rekanan</a></li>
<li><a class="list-group-item list-group-item-action " href="<?php echo base_url('Resepsionis/absen'); ?>"><i class="fas  fa-calendar"></i> Absen</a></li>
</ul>
</div>
</div>


<script type="text/javascript">
$(document).ready(function () {
$('#sidebarCollapse').on('click', function () {
$('#sidebar').toggleClass('active');
});
});
</script>
