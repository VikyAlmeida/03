<style>
	.card-stadistics{
		background: linear-gradient(180deg, #4688C8, #bcd4eb);
		font-size:20px;
		box-shadow: 10px 5px 5px black;
		box-shadow: 2px 2px 2px 1px #0978e3;
		width: 16.5em;
		border-radius: 5px;
		height: 100px;
		display: flex;
		align-items: center;
	}
	.card-stadistics div{
		margin-top: 13px;
		width:100%;
		text-align: center;
	}
</style>
<?php
	//menu del admin
	if ($_SESSION["user"]["role_id"] == 1):
		include('./views/modules/private/partials/adminMenu.php');
	// menu del owner
	else:
		include('./views/modules/private/partials/ownerMenu.php');
	endif;
?>