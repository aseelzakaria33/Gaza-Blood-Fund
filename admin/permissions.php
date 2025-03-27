<?php
/**
 * Sistema de permisos para el panel de administración
 * Este archivo contiene funciones para verificar los permisos de los usuarios
 */

// Definir constantes para los diferentes tipos de permisos
define('PERM_ADMIN', 'admin');           // Permiso de administrador (acceso total)
define('PERM_MANAGE_DONORS', 'donors');  // Permiso para gestionar donantes
define('PERM_MANAGE_BLOOD', 'blood');    // Permiso para gestionar inventario de sangre
define('PERM_VIEW_REPORTS', 'reports');  // Permiso para ver reportes

/**
 * Verifica si el usuario tiene el permiso requerido
 * 
 * @param string $permission El permiso requerido
 * @param bool $redirect Si es true, redirige a la página de acceso denegado si no tiene permiso
 * @return bool True si tiene permiso, False si no
 */
function requirePermission($permission, $redirect = true) {
    // Verificar que la sesión esté iniciada
    if (!isset($_SESSION['un'])) {
        if ($redirect) {
            header("location: login.php");
            exit();
        }
        return false;
    }
    
    // En este ejemplo simple, asumimos que todos los usuarios logueados tienen todos los permisos
    // En un sistema real, deberías verificar los permisos específicos del usuario en la base de datos
    
    // Para implementar un sistema de permisos más complejo, podrías hacer algo como:
    // $query = "SELECT permissions FROM admin_users WHERE username = ?";
    // $stmt = mysqli_prepare($db, $query);
    // mysqli_stmt_bind_param($stmt, "s", $_SESSION['un']);
    // mysqli_stmt_execute($stmt);
    // $result = mysqli_stmt_get_result($stmt);
    // $user = mysqli_fetch_assoc($result);
    // $userPermissions = explode(',', $user['permissions']);
    // return in_array($permission, $userPermissions);
    
    return true; // Por ahora, siempre devuelve true
}

/**
 * Verifica si el usuario es administrador
 * 
 * @return bool True si es administrador, False si no
 */
function isAdmin() {
    return requirePermission(PERM_ADMIN, false);
}

/**
 * Redirige al usuario a la página de acceso denegado
 */
function accessDenied() {
    header("location: access_denied.php");
    exit();
}
?>

