import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import Home2 from './pages/Home2'

/**
 * Mount the React app into the WordPress template.
 * The #shadcn-home2-root div is rendered by page-home2.php
 */
const rootElement = document.getElementById('shadcn-home2-root')

if (rootElement) {
  createRoot(rootElement).render(
    <StrictMode>
      <Home2 />
    </StrictMode>
  )
}
