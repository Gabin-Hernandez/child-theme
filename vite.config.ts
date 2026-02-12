import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import tailwindcss from '@tailwindcss/vite'
import path from 'path'

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    react(),
    tailwindcss(),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
    },
  },
  build: {
    // Output to dist/ inside the theme
    outDir: 'dist',
    // Generate manifest for WordPress asset enqueuing (without dot prefix for FTP compatibility)
    manifest: 'manifest.json',
    rollupOptions: {
      input: {
        home2: path.resolve(__dirname, 'src/main.tsx'),
      },
      output: {
        // Predictable filenames for WordPress enqueue
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'css/[name][extname]'
          }
          return 'assets/[name]-[hash][extname]'
        },
      },
    },
    // Don't empty outDir to preserve other assets
    emptyOutDir: true,
  },
  // Dev server config for HMR during development
  server: {
    port: 5173,
    strictPort: true,
    cors: true,
    origin: 'http://localhost:5173',
  },
})
