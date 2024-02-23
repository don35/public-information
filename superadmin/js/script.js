const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("collapsed");
});

function showLoading() {
  // Show the loading indicator
  document.getElementById('loading-indicator').classList.remove('d-none');

  // Delay navigation to allow time for the loading indicator to be displayed
  setTimeout(function() {
      // Proceed with the navigation after a short delay
      // Note: This is just a placeholder, actual navigation should be handled by the browser
  }, 500); // Adjust the delay time as needed
}
