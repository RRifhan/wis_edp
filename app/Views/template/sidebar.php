	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("/home"); ?>">
			<div class="sidebar-brand-icon ">
				<i class="fas fa-laptop-house"></i>
			</div>
			<div class="sidebar-brand-text mx-3">REG1 BOGOR</div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">


		<?php
		$db      = \Config\Database::connect();
		$role_id = session()->role_id;
		$menu = $db->query("SELECT tb_menu.*,id_level_user FROM tb_menu
 JOIN tb_menu_role ON tb_menu.id=tb_menu_role.id_menu WHERE  is_main_menu=0 and 
 id_level_user='$role_id' ORDER BY urutan_menu")->getResultArray();

		foreach ($menu as $m) :  ?>

			<?php
			$submenu = $db->query('SELECT tb_menu.*,id_level_user FROM tb_menu
JOIN tb_menu_role ON tb_menu.id=tb_menu_role.id_menu WHERE  is_main_menu=' . $m['id'] . ' and 
id_level_user=' . $role_id . ' ORDER BY urutan_menu')->getResultArray();
			if ($submenu) {
				echo ' <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapse' . $m['id'] . '" aria-expanded="true" aria-controls="collapse' . $m['id'] . '">
            <i class="' . $m['icon'] . '"></i>
            <span>' . $m['nama_menu'] . '</span>
        </a>
        <hr class="sidebar-divider my-0">
        <div id="collapse' . $m['id'] . '" class="collapse" >
            <div class="bg-white py-2 collapse-inner rounded">';
				foreach ($submenu as $sm) {
					if ($title == $sm['nama_menu']) {
						echo '<script>$("#collapse' . $m['id'] . '").addClass("show");</script>';
						echo '<a class="collapse-item active" href="' . base_url($sm['link']) . '"><span class="pr-4 ' . $sm['icon'] . '"></span>' . $sm['nama_menu'] . '</a>';
					} else {
						echo '<a class="collapse-item" href="' . base_url($sm['link']) . '"><span class="pr-4 ' . $sm['icon'] . '"></span>' . $sm['nama_menu'] . '</a>';
					}
				}
				echo  '</div>';
			} else {
			?>
				<!-- Nav Item - Dashboard -->
				<li <?php echo ($title == $m['nama_menu']) ? 'class="nav-item active"' : 'class="nav-item"'; ?>>
					<a class="nav-link" href="<?= base_url($m['link']) ?>">
						<i class="<?= $m['icon'] ?>"></i>
						<span><?= $m['nama_menu'] ?></span></a>
				</li>
				<hr class="sidebar-divider my-0">
		<?php
			}

		endforeach; ?>
		</li>
		<!-- Divider -->
		<hr class="d-none d-md-block">
		<!-- Sidebar Toggler (Sidebar) -->
		<div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>

	</ul>



	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<!-- <div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div> -->


	</ul>
	<!-- End of Sidebar -->