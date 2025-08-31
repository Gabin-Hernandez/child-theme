<?php
// Test básico de sintaxis PHP
echo "PHP funciona correctamente<br>";
echo "Hora actual: " . date('Y-m-d H:i:s') . "<br>";
echo "Versión PHP: " . phpversion() . "<br>";

// Test de variables básicas
$test_var = "Variable de prueba";
echo "Variable: " . $test_var . "<br>";

// Test de array
$test_array = array('uno', 'dos', 'tres');
echo "Array: " . implode(', ', $test_array) . "<br>";

echo "Test completado sin errores.";
?>
