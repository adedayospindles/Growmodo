document.addEventListener("DOMContentLoaded", function () {
	const banner = document.getElementById("top-banner");
	const closeBtn = document.getElementById("close-banner");

	if (!banner) return;

	// Check session storage
	if (sessionStorage.getItem("bannerClosed") === "true") {
		banner.style.display = "none";
	}

	if (closeBtn) {
		closeBtn.addEventListener("click", function () {
			banner.style.display = "none";
			sessionStorage.setItem("bannerClosed", "true");
		});
	}
});
