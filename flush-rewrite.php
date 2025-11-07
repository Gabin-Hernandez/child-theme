<?php
/**
 * Script temporal para hacer flush de rewrite rules
 * Ejecutar una vez y luego eliminar
 */

// Cargar WordPress
require_once('../../../wp-load.php');

// Flush rewrite rules
flush_rewrite_rules();

echo "✅ Rewrite rules actualizadas correctamente!\n";
echo "Ahora puedes eliminar este archivo flush-rewrite.php\n";
