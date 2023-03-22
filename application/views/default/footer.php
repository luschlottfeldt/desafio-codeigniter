<footer class="footer">

</footer>
</div>
<!-- CoreUI and necessary plugins-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/') ?>js/mask.js"></script>
<script src="<?= base_url('assets/') ?>js/validate.js"></script>
<script src="<?= base_url('assets/') ?>js/main.js"></script>
<script src="<?= base_url() ?>vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<script src="<?= base_url() ?>vendors/simplebar/js/simplebar.min.js"></script>
<?php
if (isset($scripts)) {
  if (is_array($scripts)) {
    foreach ($scripts as $js) {
      $filename = base_url('assets') . "/js/$js.js";
      echo file_exists("assets/js/$js.js") ? "<script src='$filename'></script>" : '';
    }
  } else {
    echo file_exists("assets/js/$scripts.js") ? "<script src=" . base_url('assets') . "/js/$scripts.js></script>" : '';
  }
}
?>

</body>

</html>