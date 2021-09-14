<script type="text/javascript" src="<?= ROOT ?>js/library/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?= ROOT ?>js/library/popper.min.js"></script>
<script type="text/javascript" src="<?= ROOT ?>js/library/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= ROOT ?>js/library/sweetalert.js"></script>

<script type="text/javascript" src="<?= GESTIONE ?>js/library/datatables.min.js"></script>
<script type="text/javascript" src="<?= GESTIONE ?>js/library/fnSortNeutral.js"></script>
<script type="text/javascript" src="<?= GESTIONE ?>js/library/jquery.serialize-object.min.js"></script>

<script type="text/javascript" src="<?= GESTIONE ?>js/library/sb-admin.js"></script>
<script type="text/javascript" src="<?= GESTIONE ?>js/ricerca.js"></script>
<script type="text/javascript" src="<?= GESTIONE ?>js/script.js"></script>

<?php
if (isset($_SESSION['notifica'])) {
?>
<script type="text/javascript">
	var type = '<?= $_SESSION['notifica']['type'] ?>';
	var title = '<?= $_SESSION['notifica']['title'] ?>';
	var text = '<?= $_SESSION['notifica']['text'] ?>';
</script>
<script type="text/javascript" src="<?= ROOT ?>js/notifiche.js"></script>
<?php
    unset($_SESSION['notifica']);
}
?>