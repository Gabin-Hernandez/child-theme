<?php
/**
 * Template Name: Home 2 - shadcn
 * Description: Nueva página de inicio construida con shadcn/ui + React + Tailwind v4
 *
 * To use this template:
 * 1. Create a page in WordPress called "Home 2" (or any name)
 * 2. In the Page Attributes, select "Home 2 - shadcn" as the template
 * 3. Set that page as the static front page in Settings > Reading (optional)
 *
 * Development:
 *   npm run dev    → Starts Vite dev server with HMR
 *   npm run build  → Builds for production
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    /**
     * Root element where the React/shadcn app mounts.
     * Do NOT remove this div — src/main.tsx targets this ID.
     */
    ?>
    <div id="shadcn-home2-root"></div>
</main>

<?php get_footer(); ?>
