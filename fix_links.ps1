# Script para reemplazar todos los enlaces problemáticos
$content = Get-Content "front-page.php" -Raw

# Reemplazos para baterías
$content = $content -replace '\?\<\?php echo function_exists\(''wc_get_page_permalink''\) \? esc_url\( wc_get_page_permalink\( ''shop'' \) \) \. ''\?product_cat=baterias'' : ''/categoria/baterias/''; \?\>', '/categoria/baterias/'

# Reemplazos para herramientas
$content = $content -replace '\?\<\?php echo function_exists\(''wc_get_page_permalink''\) \? esc_url\( wc_get_page_permalink\( ''shop'' \) \) \. ''\?product_cat=herramientas'' : ''/categoria/herramientas/''; \?\>', '/categoria/herramientas/'

# Reemplazos para pantallas
$content = $content -replace '\?\<\?php echo function_exists\(''wc_get_page_permalink''\) \? esc_url\( wc_get_page_permalink\( ''shop'' \) \) \. ''\?product_cat=pantallas'' : ''/categoria/lcd-y-touch/''; \?\>', '/categoria/lcd-y-touch/'

# Reemplazos para accesorios
$content = $content -replace '\?\<\?php echo function_exists\(''wc_get_page_permalink''\) \? esc_url\( wc_get_page_permalink\( ''shop'' \) \) \. ''\?product_cat=accesorios'' : ''/categoria/accesorios/''; \?\>', '/categoria/accesorios/'

# Guardar el archivo
Set-Content "front-page.php" $content

Write-Host "Enlaces corregidos exitosamente"
