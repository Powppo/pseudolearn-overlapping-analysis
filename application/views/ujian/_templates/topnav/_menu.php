<!-- <nav class="navbar navbar-static-top" style="background-color: #75241d">
	<div class="container" style="background-color:#75241d">
		<div class="navbar-header"> 
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				<i class="fa fa-bars"></i>
			</button>
		</div> 
		<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="#"><?=$mhs->nama?></a></li>
			</ul>
		</div>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav"> 
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
						<?=$user->username?> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?=base_url('logout')?>">Logout</a></li>
					</ul>
				</li>
			</ul>
        </div> 
	</div> 
</nav> -->

<style>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 10px 20px;
}

.navbar-brand {
    color: white;
    font-size: 24px;
    text-transform: uppercase;
}

.navbar-menu {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.navbar-menu li {
    margin-left: 20px;
    position: relative;
}

.navbar-avatar {
    cursor: pointer;
}

.avatar-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-bottom: 5px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    top: 60px; /* Adjust based on the height of avatar and icon */
    right: 0;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.navbar-avatar:hover .dropdown-content {
    display: block;
}
</style>

<nav class="navbar">
        <div class="navbar-brand"><?=$mhs->nama?></div>
        <ul class="navbar-menu">
            <li class="navbar-avatar">
				<div class="avatar-wrapper">
					<img src="<?=base_url()?>assets/dist/img/cat.png" alt="Avatar" class="avatar">
					<i style="color: white; font-size:8px;" class="fa fa-caret-down"></i>
				</div>
                <div class="dropdown-content">
                    <a href="<?= base_url('ujian/list_level') ?>"><i class="fa fa-power-off" style="color: red;"></i> Hentikan Ujian</a> 
                </div>
            </li>
        </ul>
</nav>

<script>
	document.addEventListener("DOMContentLoaded", function() {
    const avatar = document.querySelector(".navbar-avatar");
    avatar.addEventListener("click", function() {
        const dropdown = this.querySelector(".dropdown-content");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.avatar')) {
            const dropdowns = document.querySelectorAll(".dropdown-content");
            dropdowns.forEach(function(dropdown) {
                if (dropdown.style.display === "block") {
                    dropdown.style.display = "none";
                }
            });
        }
    }
});

</script>