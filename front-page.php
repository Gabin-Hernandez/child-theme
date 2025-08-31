<?php
// Página de inicio básica y segura
get_header();
?>

<main style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <section style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 3rem; margin-bottom: 20px; color: #333;">Bienvenido a ITOOLS</h1>
        <p style="font-size: 1.2rem; color: #666; margin-bottom: 30px;">Las mejores herramientas para profesionales</p>
        <a href="<?php echo home_url('/tienda'); ?>" style="background: #007cba; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-size: 1.1rem;">Ver Productos</a>
    </section>

    <section style="margin-bottom: 60px;">
        <h2 style="text-align: center; margin-bottom: 40px; color: #333;">Nuestros Productos</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <div style="background: #f9f9f9; padding: 30px; text-align: center; border-radius: 8px;">
                <h3 style="color: #333; margin-bottom: 15px;">Herramientas Manuales</h3>
                <p style="color: #666;">Herramientas de calidad para todo tipo de trabajos</p>
            </div>
            <div style="background: #f9f9f9; padding: 30px; text-align: center; border-radius: 8px;">
                <h3 style="color: #333; margin-bottom: 15px;">Maquinaria</h3>
                <p style="color: #666;">Equipos industriales de última tecnología</p>
            </div>
            <div style="background: #f9f9f9; padding: 30px; text-align: center; border-radius: 8px;">
                <h3 style="color: #333; margin-bottom: 15px;">Accesorios</h3>
                <p style="color: #666;">Complementos y repuestos para tus herramientas</p>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
