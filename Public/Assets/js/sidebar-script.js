document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidebar');
  const sidebarCollapse = document.getElementById('sidebarCollapse');
  const sidebarClose = document.getElementById('sidebarClose');
  const overlay = document.createElement('div');
  overlay.className = 'sidebar-overlay';
  document.body.appendChild(overlay);

  // Función para ajustar posición del botón
  function adjustButtonPosition() {
      if (window.innerWidth <= 992 && sidebar.classList.contains('active')) {
          sidebarCollapse.style.left = '270px';
      } else {
          sidebarCollapse.style.left = '20px';
      }
  }

  // Eventos del sidebar
  if (sidebarCollapse) {
      sidebarCollapse.addEventListener('click', function() {
          sidebar.classList.toggle('active');
          adjustButtonPosition();
      });
  }

  if (sidebarClose) {
      sidebarClose.addEventListener('click', function() {
          sidebar.classList.remove('active');
          adjustButtonPosition();
      });
  }

  overlay.addEventListener('click', function() {
      sidebar.classList.remove('active');
      adjustButtonPosition();
  });

  // Ajustes responsivos
  function adjustLayout() {
      if (window.innerWidth > 992) {
          sidebar.classList.remove('active');
      }
      adjustButtonPosition();
  }

  window.addEventListener('resize', adjustLayout);
  adjustLayout();
});