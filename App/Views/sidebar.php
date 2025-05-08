<?php
/**
 * Sidebar para Quintas del Portal 2
 * Incluye estructura HTML, estilos y scripts
 */
?>
<nav id="sidebar" class="sidebar">
    <div class="sidebar-header text-center py-4">
        <h3 class="mb-0">Quintas del Portal 2</h3>
        <button id="sidebarClose" class="btn btn-sm btn-outline-light d-lg-none">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="sidebar-menu px-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="./" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                    <i class="fas fa-home me-2"></i> Inicio
                </a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#quintasSubmenu">
                    <i class="fas fa-tree me-2"></i> Apartamentos
                </a>
                <div class="collapse" id="quintasSubmenu">
                    <ul class="nav flex-column ps-4">
                        <li class="nav-item">
                            <a href="./apartamentos" class="nav-link text-white">Ver los apartamentos</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<link rel="stylesheet" href="/Public/Assets/css/sidebar-styles.css">
<script src="/Public/Assets/js/sidebar-script.js"></script>