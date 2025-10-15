/**
 * Live Search Functionality for ITOOLS Child Theme
 */

document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("live-search-input");
  const searchResults = document.getElementById("live-search-results");
  const SHOP_URL = "/tienda/";

  if (!searchInput || !searchResults) {
    return;
  }

  let searchTimeout;
  let currentRequest;

  // Debounce function para evitar demasiadas peticiones
  function debounce(func, wait) {
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(searchTimeout);
        func(...args);
      };
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(later, wait);
    };
  }

  // Función para realizar la búsqueda AJAX
  function performLiveSearch(searchTerm) {
    // Cancelar petición anterior si existe
    if (currentRequest) {
      currentRequest.abort();
    }

    // Si el término es muy corto, ocultar resultados
    if (searchTerm.length < 2) {
      hideSearchResults();
      return;
    }

    // Mostrar indicador de carga
    showLoadingState();

    // Crear FormData para la petición AJAX
    const formData = new FormData();
    formData.append("action", "itools_live_search");
    formData.append("search_term", searchTerm);
    formData.append("nonce", itoolsAjax.nonce);

    // Realizar petición AJAX
    currentRequest = fetch(itoolsAjax.ajaxurl, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        currentRequest = null;

        if (data.success && data.data.length > 0) {
          displaySearchResults(data.data);
        } else {
          showNoResults(searchTerm);
        }
      })
      .catch((error) => {
        currentRequest = null;
        if (error.name !== "AbortError") {
          console.error("Error en búsqueda:", error);
          hideSearchResults();
        }
      });
  }

  // Función para mostrar los resultados
  function displaySearchResults(results) {
    let html = "";
    const searchValue = searchInput.value.trim();
    const searchParam = encodeURIComponent(searchValue);
    const shopUrlWithQuery = searchValue
      ? `/?s=${searchParam}&post_type=product`
      : `/?post_type=product`;

    results.forEach((product) => {
      const categories =
        product.categories.length > 0 ? product.categories.join(", ") : "";

      html += `
                <div class="search-result-item" style="
                    display: flex;
                    align-items: center;
                    padding: 12px 16px;
                    border-bottom: 1px solid #f3f4f6;
                    cursor: pointer;
                    transition: background-color 0.2s;
                " onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'" onclick="window.location.href='${
                  product.url
                }'">
                    <img src="${product.image}" alt="${product.title}" style="
                        width: 50px;
                        height: 50px;
                        object-fit: cover;
                        border-radius: 4px;
                        margin-right: 12px;
                        flex-shrink: 0;
                    ">
                    <div style="flex: 1; min-width: 0;">
                        <h4 style="
                            font-size: 14px;
                            font-weight: 600;
                            color: #374151;
                            margin: 0 0 4px 0;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        ">${product.title}</h4>
                        <div style="
                            font-size: 12px;
                            color: #6b7280;
                            margin-bottom: 2px;
                        ">${categories}</div>
                        <div style="
                            font-size: 14px;
                            font-weight: 600;
                            color: #059669;
                        ">${product.price}</div>
                    </div>
                    <div style="
                        padding: 4px 8px;
                        background: ${
                          product.stock_status === "instock"
                            ? "#dcfce7"
                            : "#fef2f2"
                        };
                        color: ${
                          product.stock_status === "instock"
                            ? "#166534"
                            : "#dc2626"
                        };
                        border-radius: 4px;
                        font-size: 11px;
                        font-weight: 500;
                        flex-shrink: 0;
                    ">
                        ${
                          product.stock_status === "instock"
                            ? "En Stock"
                            : "Agotado"
                        }
                    </div>
                </div>
            `;
    });

    // Agregar botón "Ver todos los resultados"
    html += `
            <div style="
                padding: 12px 16px;
                text-align: center;
                border-top: 1px solid #e5e7eb;
                background: #f9fafb;
            ">
                <button onclick="window.location.href='${shopUrlWithQuery}'" style="
                    background: #2563eb;
                    color: white;
                    border: none;
                    padding: 8px 16px;
                    border-radius: 6px;
                    font-size: 13px;
                    font-weight: 500;
                    cursor: pointer;
                    transition: background-color 0.2s;
                " onmouseover="this.style.backgroundColor='#1d4ed8'" onmouseout="this.style.backgroundColor='#2563eb'">
                    Ver todos los resultados
                </button>
            </div>
        `;

    searchResults.innerHTML = html;
    showSearchResults();
  }

  // Función para mostrar estado de carga
  function showLoadingState() {
    searchResults.innerHTML = `
            <div style="
                padding: 20px;
                text-align: center;
                color: #6b7280;
            ">
                <div style="
                    display: inline-block;
                    width: 20px;
                    height: 20px;
                    border: 2px solid #e5e7eb;
                    border-top: 2px solid #2563eb;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                "></div>
                <div style="margin-top: 8px; font-size: 14px;">Buscando...</div>
            </div>
        `;
    showSearchResults();
  }

  // Función para mostrar "sin resultados"
  function showNoResults(searchTerm) {
    const searchValue = searchTerm.trim();
    const searchParam = encodeURIComponent(searchValue);
    const shopUrlWithQuery = searchValue
      ? `${SHOP_URL}?s=${searchParam}`
      : SHOP_URL;

    searchResults.innerHTML = `
            <div style="
                padding: 20px;
                text-align: center;
                color: #6b7280;
            ">
                <svg style="
                    width: 48px;
                    height: 48px;
                    margin: 0 auto 12px;
                    color: #d1d5db;
                " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <div style="font-size: 14px; margin-bottom: 8px;">
                    No se encontraron productos para "${searchTerm}"
                </div>
                <button onclick="window.location.href='${shopUrlWithQuery}'" style="
                    background: #6b7280;
                    color: white;
                    border: none;
                    padding: 6px 12px;
                    border-radius: 4px;
                    font-size: 12px;
                    cursor: pointer;
                ">
                    Buscar en toda la tienda
                </button>
            </div>
        `;
    showSearchResults();
  }

  // Funciones para mostrar/ocultar resultados
  function showSearchResults() {
    searchResults.style.display = "block";
  }

  function hideSearchResults() {
    searchResults.style.display = "none";
  }

  // Event listeners
  const debouncedSearch = debounce(performLiveSearch, 300);

  searchInput.addEventListener("input", function (e) {
    const searchTerm = e.target.value.trim();
    debouncedSearch(searchTerm);
  });

  searchInput.addEventListener("focus", function () {
    const searchTerm = this.value.trim();
    if (searchTerm.length >= 2) {
      showSearchResults();
    }
  });

  // Ocultar resultados al hacer clic fuera
  document.addEventListener("click", function (e) {
    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
      hideSearchResults();
    }
  });

  // Manejar teclas de navegación
  searchInput.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      hideSearchResults();
      this.blur();
    }
  });
});

// Agregar estilos CSS para la animación de carga
const style = document.createElement("style");
style.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);
