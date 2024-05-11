<?php
	include"inc/config.php"; 
	include"layout/header.php";	
?>
<div class="col-md-9">
	<div class="row">
		<?php
			$q = mysqli_query($db,"SELECT * FROM info_pembayaran LIMIT 1") or die (mysqli_error($db));
			$data = mysqli_fetch_object($q);
		?>
		<div class="info-pembayaran">
			<h3>Informasi Pembayaran</h3>
			<hr>
			<div class="info-content">
				<?php echo $data->info; ?>
			</div>
		</div>
	</div>
</div>
<?php
	include "layout/footer.php";
?>
