<?php
/**
 * Vite Integration Helper for WordPress
 *
 * Detects if Vite dev server is running and loads HMR assets,
 * otherwise loads the production build from dist/.
 *
 * Usage in functions.php:
 *   require_once get_stylesheet_directory() . '/includes/vite-helper.php';
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if the Vite dev server is running.
 */
function itools_vite_is_dev() {
    // Only check in local/dev environments
    if ( defined( 'WP_ENV' ) && WP_ENV === 'production' ) {
        return false;
    }

    // Check for a constant to force dev mode
    if ( defined( 'VITE_DEV_MODE' ) && VITE_DEV_MODE ) {
        return true;
    }

    // Try to detect the dev server
    $dev_server_url = 'http://localhost:5173';

    // Use a transient to avoid hitting the server on every page load
    $is_dev = get_transient( 'itools_vite_dev_active' );
    if ( $is_dev !== false ) {
        return $is_dev === 'yes';
    }

    $response = @file_get_contents( $dev_server_url . '/@vite/client', false, stream_context_create([
        'http' => [ 'timeout' => 0.5 ]
    ]));

    $active = $response !== false;
    set_transient( 'itools_vite_dev_active', $active ? 'yes' : 'no', 10 );

    return $active;
}

/**
 * Enqueue Vite assets for the Home 2 shadcn page.
 */
function itools_enqueue_vite_home2() {
    // Only load on the Home 2 template page
    if ( ! is_page_template( 'page-home2.php' ) ) {
        return;
    }

    $theme_uri = get_stylesheet_directory_uri();
    $theme_dir = get_stylesheet_directory();

    if ( itools_vite_is_dev() ) {
        // === DEVELOPMENT MODE: Load from Vite dev server ===
        $dev_server = 'http://localhost:5173';

        // Vite client for HMR
        wp_enqueue_script(
            'vite-client',
            $dev_server . '/@vite/client',
            [],
            null,
            false
        );
        // Mark as module
        add_filter( 'script_loader_tag', function( $tag, $handle ) {
            if ( $handle === 'vite-client' || $handle === 'itools-home2-react' ) {
                return str_replace( '<script ', '<script type="module" ', $tag );
            }
            return $tag;
        }, 10, 2 );

        // Main React entry
        wp_enqueue_script(
            'itools-home2-react',
            $dev_server . '/src/main.tsx',
            [],
            null,
            true
        );
    } else {
        // === PRODUCTION MODE: Load built assets from dist/ ===
        $manifest_path = $theme_dir . '/dist/manifest.json';

        if ( ! file_exists( $manifest_path ) ) {
            // No build found — show admin notice
            if ( current_user_can( 'manage_options' ) ) {
                add_action( 'wp_footer', function() {
                    echo '<div style="position:fixed;bottom:20px;right:20px;background:#f44336;color:white;padding:15px 20px;border-radius:8px;z-index:9999;font-size:14px;">
                        <strong>shadcn Build Missing!</strong><br>
                        Run <code>npm run build</code> in the child theme directory.
                    </div>';
                });
            }
            return;
        }

        $manifest = json_decode( file_get_contents( $manifest_path ), true );
        $entry = $manifest['src/main.tsx'] ?? null;

        if ( ! $entry ) {
            return;
        }

        // Enqueue the CSS
        if ( ! empty( $entry['css'] ) ) {
            foreach ( $entry['css'] as $index => $css_file ) {
                wp_enqueue_style(
                    'itools-home2-css-' . $index,
                    $theme_uri . '/dist/' . $css_file,
                    [],
                    filemtime( $theme_dir . '/dist/' . $css_file )
                );
            }
        }

        // Enqueue the JS
        wp_enqueue_script(
            'itools-home2-react',
            $theme_uri . '/dist/' . $entry['file'],
            [],
            filemtime( $theme_dir . '/dist/' . $entry['file'] ),
            true
        );

        // Add type="module" to the script tag
        add_filter( 'script_loader_tag', function( $tag, $handle ) {
            if ( $handle === 'itools-home2-react' ) {
                return str_replace( '<script ', '<script type="module" ', $tag );
            }
            return $tag;
        }, 10, 2 );
    }
}
add_action( 'wp_enqueue_scripts', 'itools_enqueue_vite_home2' );
