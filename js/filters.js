/**
 * Filtros Universales de Productos - ITOOLS MX
 * Maneja la funcionalidad de filtros en todas las páginas de productos
 */

(function ($) {
  "use strict";

  // Variables globales
  let isFiltering = false;
  let filterTimeout = null;

  // Configuración
  const config = {
    debounceDelay: 500,
    fadeSpeed: 300,
    animationDuration: 400,
  };

  // Elementos del DOM
  const elements = {
    // Filtros principales
    searchInput: $('#table-search, .product-search-input, [name="s"]'),
    minPriceSelect: $("#price-filter, .price-range-min"),
    maxPriceSelect: $(".price-range-max"),
    minPriceInput: $("#min-price-slider, .min-price-input"),
    maxPriceInput: $("#max-price-slider, .max-price-input"),
    stockFilter: $("#stock-filter, .availability-filter"),
    categoryFilter: $(".category-filter"),

    // Botones de acción
    applyBtn: $("#apply-filters-btn, .apply-filters"),
    clearBtn: $("#clear-filters-btn, .clear-filters"),
    clearTableBtn: $("#clear-table-filters"),

    // Contenedores de resultados
    productsGrid: $("#products-grid, .products-grid"),
    productsTable: $("#products-table, .products-table"),
    tableBody: $("#table-body, .products-table tbody"),

    // Estados
    loadingOverlay: $(".filters-loading"),
    noResults: $(".no-results-message"),
    resultsCounter: $(".results-counter, .woocommerce-result-count"),
  };

  // Inicializar filtros
  function initFilters() {
    console.log("🎯 Inicializando filtros universales...");

    // Event listeners específicos para filtros de tabla
    $("#table-search").on(
      "input",
      debounce(function () {
        console.log("🔍 Búsqueda en tabla:", $(this).val());
        performFilter();
      }, config.debounceDelay)
    );

    $("#stock-filter").on("change", function () {
      console.log("📦 Filtro de stock en tabla:", $(this).val());
      performFilter();
    });

    $("#apply-filters-btn").on("click", function (e) {
      e.preventDefault();
      console.log("🎯 Aplicar filtros de tabla");
      performFilter();
    });

    // Event listeners para búsqueda en tiempo real (otros inputs)
    if (elements.searchInput.length) {
      elements.searchInput.on(
        "input",
        debounce(handleSearch, config.debounceDelay)
      );
      console.log("✅ Búsqueda en tiempo real activada");
    }

    // Event listeners para filtros de precio
    if (elements.minPriceSelect.length) {
      elements.minPriceSelect.on("change", handlePriceFilter);
      console.log("✅ Filtro de precio mínimo activado");
    }

    if (elements.stockFilter.length) {
      elements.stockFilter.on("change", handleStockFilter);
      console.log("✅ Filtro de disponibilidad activado");
    }

    // Botones de acción
    if (elements.applyBtn.length) {
      elements.applyBtn.on("click", handleApplyFilters);
    }

    if (elements.clearBtn.length || elements.clearTableBtn.length) {
      elements.clearBtn
        .add(elements.clearTableBtn)
        .add($(".clear-filters"))
        .on("click", handleClearFilters);
    }

    // Detectar formato de vista activa
    detectViewFormat();

    console.log("🚀 Filtros universales inicializados correctamente");
  }

  // Función debounce para optimizar rendimiento
  function debounce(func, wait) {
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(filterTimeout);
        func(...args);
      };
      clearTimeout(filterTimeout);
      filterTimeout = setTimeout(later, wait);
    };
  }

  // Manejar búsqueda en tiempo real
  function handleSearch() {
    const searchTerm = elements.searchInput.val();
    console.log("🔍 Búsqueda:", searchTerm);

    if (searchTerm.length >= 2 || searchTerm.length === 0) {
      performFilter();
    }
  }

  // Manejar filtro de precio
  function handlePriceFilter() {
    console.log("💰 Filtro de precio cambiado");
    performFilter();
  }

  // Manejar filtro de disponibilidad
  function handleStockFilter() {
    console.log("📦 Filtro de stock cambiado");
    performFilter();
  }

  // Aplicar todos los filtros
  function handleApplyFilters(e) {
    e.preventDefault();
    console.log("🎯 Aplicando filtros...");
    performFilter();
  }

  // Limpiar todos los filtros
  function handleClearFilters(e) {
    e.preventDefault();
    console.log("🧹 Limpiando filtros...");

    // Limpiar campos de tabla
    $("#table-search").val("");
    $("#stock-filter").val("");

    // Limpiar campos de vista lista con animación
    elements.searchInput.val("").addClass("clearing");
    elements.minPriceSelect.val("");
    elements.stockFilter.val("");

    // Limpiar campos del sidebar también
    $("#sidebar-search").val("");
    $("#sidebar-min-price").val("");
    $("#sidebar-max-price").val("");
    $("#sidebar-stock").val("");

    // Resetear sliders de precio
    const minSlider = $("#min-price-slider");
    const maxSlider = $("#max-price-slider");
    if (minSlider.length && maxSlider.length) {
      const minRange = minSlider.attr("min");
      const maxRange = maxSlider.attr("max");

      minSlider.val(minRange);
      maxSlider.val(maxRange);
      $("#min-price-display").text(new Intl.NumberFormat().format(minRange));
      $("#max-price-display").text(new Intl.NumberFormat().format(maxRange));
      updateSliderRange();
    }

    // Limpiar botones de rango predefinido
    $(".price-preset")
      .removeClass("bg-green-100 text-green-700")
      .addClass("bg-gray-100");

    // Desactivar filtros rápidos
    $(".quick-filter")
      .removeClass("bg-white border-yellow-300 text-yellow-700")
      .addClass("bg-white/60 border-transparent text-gray-700");

    // Animación de limpieza
    setTimeout(() => {
      elements.searchInput.removeClass("clearing");
      performFilter();

      // Si hay filtros del sidebar activos, también aplicar
      if (
        $(
          "#sidebar-search, #sidebar-min-price, #sidebar-max-price, #sidebar-stock"
        ).length
      ) {
        applySidebarFiltersAjax();
      }
    }, 200);
  }

  // Detectar si estamos en vista de tabla o grid
  function detectViewFormat() {
    const isTableView =
      elements.productsTable.is(":visible") &&
      !elements.productsTable.hasClass("hidden");
    const isGridView =
      elements.productsGrid.is(":visible") &&
      !elements.productsGrid.hasClass("hidden");

    console.log("📱 Vista detectada:", isTableView ? "Tabla" : "Grid");
    return isTableView ? "table" : "grid";
  }

  // Función principal para realizar filtrado
  function performFilter() {
    if (isFiltering) {
      console.log("⏳ Ya hay un filtro en progreso...");
      return;
    }

    isFiltering = true;
    showLoadingState();

    // Detectar si estamos en vista de tabla
    const isTableView = detectViewFormat() === "table";

    // Recopilar valores de filtros - usar inputs específicos según la vista
    const filters = {
      search_term: isTableView
        ? $("#table-search").val() || ""
        : elements.searchInput.val() || "",
      min_price: getMinPrice(),
      max_price: getMaxPrice(),
      availability: isTableView
        ? $("#stock-filter").val() || ""
        : elements.stockFilter.val() || "",
      category: getCurrentCategory(),
      nonce: itoolsFilters.nonce,
    };

    console.log("📋 Filtros a aplicar:", filters);
    console.log("📊 Vista actual:", isTableView ? "Tabla" : "Grid");

    // Si estamos en vista de tabla, usar filtro local
    if (isTableView) {
      filterTableLocally(filters);
      return;
    }

    // Para vista de grid, usar AJAX
    $.ajax({
      url: itoolsFilters.ajaxurl,
      type: "POST",
      data: {
        action: "itools_filter_products",
        ...filters,
      },
      success: function (response) {
        console.log("✅ Filtros aplicados:", response);

        if (response.success) {
          updateProductsGrid(response.data.products);
          updateResultsCounter(response.data.total_found);
        } else {
          showError(response.data || "Error desconocido");
        }
      },
      error: function (xhr, status, error) {
        console.error("❌ Error en filtros AJAX:", error);
        showError("Error de conexión: " + error);
      },
      complete: function () {
        isFiltering = false;
        hideLoadingState();
      },
    });
  }

  // Obtener precio mínimo de diferentes tipos de input
  function getMinPrice() {
    if (elements.minPriceInput.length) {
      return parseFloat(elements.minPriceInput.val()) || 0;
    }

    if (elements.minPriceSelect.length) {
      const value = elements.minPriceSelect.val();
      if (value && value.includes("-")) {
        return parseFloat(value.split("-")[0]) || 0;
      }
    }

    return 0;
  }

  // Obtener precio máximo de diferentes tipos de input
  function getMaxPrice() {
    if (elements.maxPriceInput.length) {
      return parseFloat(elements.maxPriceInput.val()) || 999999;
    }

    if (elements.minPriceSelect.length) {
      const value = elements.minPriceSelect.val();
      if (value) {
        if (value.includes("-")) {
          return parseFloat(value.split("-")[1]) || 999999;
        } else if (value.includes("+")) {
          return 999999;
        }
      }
    }

    return 999999;
  }

  // Obtener categoría actual de la URL o filtros
  function getCurrentCategory() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get("product_cat") || "";
  }

  // Filtrar tabla localmente (para vista de tabla)
  function filterTableLocally(filters) {
    console.log("📊 Filtrando tabla localmente...");
    console.log("📋 Filtros recibidos:", filters);

    const rows = elements.tableBody.find("tr.product-row");
    let visibleCount = 0;

    rows.each(function () {
      const row = $(this);

      // Obtener datos de los atributos data-* del row usando .attr() para evitar cache
      const productData = {
        name: (row.attr("data-name") || "").toLowerCase(),
        price: parseFloat(row.attr("data-price")) || 0,
        stock: (row.attr("data-stock") || "").toLowerCase(),
      };

      console.log("🔍 Producto:", productData);

      let showRow = true;

      // Filtro de búsqueda
      if (filters.search_term && filters.search_term.trim() !== "") {
        const searchTermLower = filters.search_term.toLowerCase().trim();
        const nameMatch = productData.name.includes(searchTermLower);

        if (!nameMatch) {
          showRow = false;
          console.log(
            "❌ No coincide búsqueda:",
            "'" + productData.name + "'",
            "no contiene",
            "'" + searchTermLower + "'"
          );
        } else {
          console.log(
            "✅ Coincide búsqueda:",
            "'" + productData.name + "'",
            "contiene",
            "'" + searchTermLower + "'"
          );
        }
      }

      // Filtro de precio
      if (filters.min_price && productData.price < filters.min_price) {
        showRow = false;
        console.log(
          "❌ Precio muy bajo:",
          productData.price,
          "<",
          filters.min_price
        );
      }
      if (
        filters.max_price &&
        filters.max_price < 999999 &&
        productData.price > filters.max_price
      ) {
        showRow = false;
        console.log(
          "❌ Precio muy alto:",
          productData.price,
          ">",
          filters.max_price
        );
      }

      // Filtro de disponibilidad
      if (filters.availability) {
        if (
          filters.availability === "in-stock" &&
          productData.stock !== "in-stock"
        ) {
          showRow = false;
          console.log("❌ No está en stock:", productData.stock);
        } else if (
          filters.availability === "out-of-stock" &&
          productData.stock !== "out-of-stock"
        ) {
          showRow = false;
          console.log("❌ Está en stock:", productData.stock);
        }
      }

      // Aplicar visibilidad con animación
      if (showRow) {
        row.fadeIn(config.fadeSpeed);
        visibleCount++;
      } else {
        row.fadeOut(config.fadeSpeed);
      }
    });

    // Mostrar/ocultar mensaje de no resultados
    updateTableEmptyState(visibleCount);
    updateResultsCounter(visibleCount);

    isFiltering = false;
    hideLoadingState();

    console.log(
      `📊 Tabla filtrada: ${visibleCount} productos visibles de ${rows.length} totales`
    );
  }

  // Actualizar grid de productos con resultados AJAX
  function updateProductsGrid(products) {
    console.log("🔄 Actualizando grid de productos...");

    const container = elements.productsGrid;

    if (!products || products.length === 0) {
      showNoResults();
      return;
    }

    // Fade out actual
    container.fadeOut(config.fadeSpeed, function () {
      // Limpiar contenido actual
      container.empty();

      // Agregar productos
      products.forEach((product) => {
        const productHtml = generateProductCard(product);
        container.append(productHtml);
      });

      // Fade in nuevo contenido
      container.fadeIn(config.fadeSpeed);

      // Reinicializar eventos de productos
      initProductEvents();
    });

    hideNoResults();
  }

  // Generar HTML para tarjeta de producto
  function generateProductCard(product) {
    const stockClass = product.in_stock ? "in-stock" : "out-of-stock";
    const stockText = product.in_stock ? "En stock" : "Agotado";
    const rating = generateStars(product.rating);

    return `
            <div class="product-card group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                <div class="relative overflow-hidden bg-gray-50 aspect-square">
                    <a href="${product.url}">
                        <img src="${product.image}" alt="${
      product.title
    }" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </a>
                    ${
                      !product.in_stock
                        ? '<div class="absolute inset-0 bg-gray-900/50 flex items-center justify-center"><span class="bg-red-500 text-white px-3 py-1 rounded-md text-sm font-bold">Agotado</span></div>'
                        : ""
                    }
                </div>
                <div class="p-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2">
                        <a href="${product.url}" class="hover:text-blue-600">${
      product.title
    }</a>
                    </h3>
                    ${rating}
                    <div class="text-lg font-bold text-gray-900 mb-4">${
                      product.price
                    }</div>
                    ${
                      product.in_stock
                        ? `<button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg text-sm font-medium transition-colors duration-200 ajax-add-to-cart" data-product-id="${product.id}">Agregar al carrito</button>`
                        : `<button class="w-full bg-gray-300 text-gray-600 py-2.5 px-4 rounded-lg text-sm font-medium cursor-not-allowed" disabled>No disponible</button>`
                    }
                </div>
            </div>
        `;
  }

  // Generar estrellas de rating
  function generateStars(rating) {
    if (!rating || rating == 0)
      return '<div class="mb-3 text-xs text-gray-400">Sin reseñas</div>';

    let stars = '<div class="flex items-center gap-1 mb-3">';
    for (let i = 1; i <= 5; i++) {
      stars += `<svg class="w-3 h-3 ${
        i <= rating ? "text-yellow-400" : "text-gray-300"
      }" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>`;
    }
    stars += `<span class="text-xs text-gray-500 ml-1">(${rating})</span></div>`;
    return stars;
  }

  // Reinicializar eventos de productos después de actualizar
  function initProductEvents() {
    // Agregar al carrito AJAX
    $(".ajax-add-to-cart")
      .off("click")
      .on("click", function (e) {
        e.preventDefault();
        const productId = $(this).data("product-id");
        addToCartAjax(productId, $(this));
      });
  }

  // Función simple para agregar al carrito via AJAX
  function addToCartAjax(productId, button) {
    const originalText = button.text();
    button.text("Agregando...").prop("disabled", true);

    $.ajax({
      url: itoolsFilters.ajaxurl,
      type: "POST",
      data: {
        action: "itools_add_to_cart",
        product_id: productId,
        quantity: 1,
        nonce: itoolsFilters.nonce,
      },
      success: function (response) {
        if (response.success) {
          button.text("¡Agregado!");
          showNotification("Producto agregado al carrito", "success");

          // Disparar evento para actualizar contador
          $(document.body).trigger("added_to_cart", [response.data]);
        } else {
          button.text(originalText);
          showNotification("Error al agregar producto", "error");
        }
      },
      error: function () {
        button.text(originalText);
        showNotification("Error de conexión", "error");
      },
      complete: function () {
        setTimeout(() => {
          button.text(originalText).prop("disabled", false);
        }, 2000);
      },
    });
  }

  // Actualizar mensaje de estado vacío en tabla
  function updateTableEmptyState(visibleCount) {
    let emptyRow = elements.tableBody.find(".no-results-row");

    if (visibleCount === 0) {
      if (emptyRow.length === 0) {
        // Contar columnas de la primera fila de producto
        const firstRow = elements.tableBody.find("tr.product-row:first");
        const colSpan = firstRow.find("td").length || 4;
        emptyRow = $(`
                    <tr class="no-results-row">
                        <td colspan="${colSpan}" class="text-center py-8 text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <p class="text-lg font-medium mb-2">No se encontraron productos</p>
                                <p class="text-sm">Intenta ajustar los filtros de búsqueda</p>
                            </div>
                        </td>
                    </tr>
                `);
        elements.tableBody.append(emptyRow);
      }
      emptyRow.show();
    } else if (emptyRow.length) {
      emptyRow.hide();
    }
  }

  // Actualizar contador de resultados
  function updateResultsCounter(count) {
    if (elements.resultsCounter.length) {
      if (count > 0) {
        elements.resultsCounter.text(`Mostrando ${count} productos`).show();
      } else {
        elements.resultsCounter.hide();
      }
    }
  }

  // Estados de carga y error
  function showLoadingState() {
    elements.applyBtn.prop("disabled", true).text(itoolsFilters.loading_text);
    if (elements.loadingOverlay.length) {
      elements.loadingOverlay.fadeIn(config.fadeSpeed);
    }
  }

  function hideLoadingState() {
    elements.applyBtn.prop("disabled", false).text("Aplicar Filtros");
    if (elements.loadingOverlay.length) {
      elements.loadingOverlay.fadeOut(config.fadeSpeed);
    }
  }

  function showNoResults() {
    if (elements.noResults.length) {
      elements.noResults.fadeIn(config.fadeSpeed);
    } else {
      // Crear mensaje dinámicamente
      const message = $(`
                <div class="no-results-message text-center py-12">
                    <div class="text-gray-500 mb-4">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No se encontraron productos</h3>
                    <p class="text-gray-600">Intenta ajustar los filtros de búsqueda</p>
                </div>
            `);
      elements.productsGrid.after(message);
      elements.noResults = $(".no-results-message");
    }
  }

  function hideNoResults() {
    if (elements.noResults.length) {
      elements.noResults.fadeOut(config.fadeSpeed);
    }
  }

  function showError(message) {
    console.error("❌ Error:", message);
    showNotification(itoolsFilters.error_text, "error");
  }

  // Sistema de notificaciones
  function showNotification(message, type = "info") {
    const notification = $(`
            <div class="filter-notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg text-white max-w-sm transform translate-x-full transition-transform duration-300 ${
              type === "success"
                ? "bg-green-500"
                : type === "error"
                ? "bg-red-500"
                : "bg-blue-500"
            }">
                <div class="flex items-center">
                    <span class="mr-2">
                        ${
                          type === "success"
                            ? "✅"
                            : type === "error"
                            ? "❌"
                            : "ℹ️"
                        }
                    </span>
                    <span>${message}</span>
                </div>
            </div>
        `);

    $("body").append(notification);

    // Mostrar
    setTimeout(() => {
      notification.removeClass("translate-x-full");
    }, 100);

    // Ocultar después de 3 segundos
    setTimeout(() => {
      notification.addClass("translate-x-full");
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  }

  // Función para manejar filtros del sidebar (vista grid)
  function bindSidebarFilterEvents() {
    // Botón aplicar filtros del sidebar
    $(document).on("click", "#apply-sidebar-filters", function (e) {
      e.preventDefault();

      // Si tenemos tanto vista tabla como grid, usar AJAX
      if (elements.productsGrid.length || elements.tableView.length) {
        applySidebarFiltersAjax();
      }
    });

    // Eventos en tiempo real para sidebar
    $(document).on(
      "input change",
      "#sidebar-search, #sidebar-min-price, #sidebar-max-price, #sidebar-stock",
      function () {
        if (config.realTimeFiltering) {
          applySidebarFiltersAjax();
        }
      }
    );

    // Filtros rápidos
    $(document).on("click", ".quick-filter", function (e) {
      e.preventDefault();

      const filterType = $(this).data("filter");
      const button = $(this);

      // Remover estado activo de otros botones
      $(".quick-filter")
        .removeClass("bg-white border-yellow-300 text-yellow-700")
        .addClass("bg-white/60 border-transparent text-gray-700");

      // Activar botón actual
      button
        .removeClass("bg-white/60 border-transparent text-gray-700")
        .addClass("bg-white border-yellow-300 text-yellow-700");

      // Aplicar filtro rápido
      applyQuickFilter(filterType, button);
    });

    // Sincronizar sliders con inputs manuales
    $(document).on("input", "#min-price-slider", function () {
      const value = $(this).val();
      $("#sidebar-min-price").val(value);
      $("#min-price-display").text(new Intl.NumberFormat().format(value));
      updateSliderRange();

      if (config.realTimeFiltering) {
        applySidebarFiltersAjax();
      }
    });

    $(document).on("input", "#max-price-slider", function () {
      const value = $(this).val();
      $("#sidebar-max-price").val(value);
      $("#max-price-display").text(new Intl.NumberFormat().format(value));
      updateSliderRange();

      if (config.realTimeFiltering) {
        applySidebarFiltersAjax();
      }
    });

    // Sincronizar inputs manuales con sliders
    $(document).on("input change", "#sidebar-min-price", function () {
      const value = $(this).val();
      const maxRange = $("#min-price-slider").attr("max");
      const validValue = Math.min(Math.max(value || 0, 0), maxRange);

      $("#min-price-slider").val(validValue);
      $("#min-price-display").text(new Intl.NumberFormat().format(validValue));
      updateSliderRange();
    });

    $(document).on("input change", "#sidebar-max-price", function () {
      const value = $(this).val();
      const maxRange = $("#max-price-slider").attr("max");
      const validValue = value
        ? Math.min(Math.max(value, 0), maxRange)
        : maxRange;

      $("#max-price-slider").val(validValue);
      $("#max-price-display").text(new Intl.NumberFormat().format(validValue));
      updateSliderRange();
    });

    // Botones de rangos predefinidos
    $(document).on("click", ".price-preset", function (e) {
      e.preventDefault();
      const minPrice = $(this).data("min");
      const maxPrice = $(this).data("max");
      const maxRange = $("#max-price-slider").attr("max");

      // Actualizar inputs
      $("#sidebar-min-price").val(minPrice);
      $("#sidebar-max-price").val(maxPrice || "");

      // Actualizar sliders
      $("#min-price-slider").val(minPrice);
      $("#max-price-slider").val(maxPrice || maxRange);

      // Actualizar displays
      $("#min-price-display").text(new Intl.NumberFormat().format(minPrice));
      $("#max-price-display").text(
        new Intl.NumberFormat().format(maxPrice || maxRange)
      );

      // Actualizar visual del slider
      updateSliderRange();

      // Aplicar filtro si está en tiempo real
      if (config.realTimeFiltering) {
        applySidebarFiltersAjax();
      }

      // Resaltar botón seleccionado
      $(".price-preset")
        .removeClass("bg-green-100 text-green-700")
        .addClass("bg-gray-100");
      $(this)
        .removeClass("bg-gray-100")
        .addClass("bg-green-100 text-green-700");
    });
  }

  // Actualizar el rango visual del slider
  function updateSliderRange() {
    const minSlider = $("#min-price-slider");
    const maxSlider = $("#max-price-slider");
    const rangeBar = $("#price-slider-range");

    if (minSlider.length && maxSlider.length && rangeBar.length) {
      const min = parseInt(minSlider.attr("min"));
      const max = parseInt(minSlider.attr("max"));
      const minVal = parseInt(minSlider.val());
      const maxVal = parseInt(maxSlider.val());

      const minPercent = ((minVal - min) / (max - min)) * 100;
      const maxPercent = ((maxVal - min) / (max - min)) * 100;

      rangeBar.css({
        left: minPercent + "%",
        width: maxPercent - minPercent + "%",
      });
    }
  }

  // Aplicar filtros del sidebar via AJAX
  function applySidebarFiltersAjax() {
    const searchTerm = $("#sidebar-search").val() || "";
    const minPrice = parseFloat($("#sidebar-min-price").val()) || "";
    const maxPrice = parseFloat($("#sidebar-max-price").val()) || "";
    const stockFilter = $("#sidebar-stock").val() || "";

    // Mostrar estado de carga
    $(".filters-loading").removeClass("hidden").show();
    $("#apply-sidebar-filters")
      .prop("disabled", true)
      .find("svg")
      .addClass("animate-spin");

    $.ajax({
      url: itoolsFilters.ajaxurl,
      type: "POST",
      data: {
        action: "itools_ajax_filter_products",
        search: searchTerm,
        min_price: minPrice,
        max_price: maxPrice,
        stock_status: stockFilter,
        nonce: itoolsFilters.nonce,
      },
      success: function (response) {
        if (response.success) {
          // Actualizar grid de productos
          if (elements.productsGrid.length) {
            elements.productsGrid.html(response.data.html);
            rebindCartEvents();
          }

          // Mostrar contador
          showNotification(
            `Se encontraron ${response.data.found_products} productos`,
            "success"
          );
        } else {
          showError(response.data || "Error al aplicar filtros");
        }
      },
      error: function () {
        showError("Error de conexión al aplicar filtros");
      },
      complete: function () {
        // Ocultar estado de carga
        $(".filters-loading").hide();
        $("#apply-sidebar-filters")
          .prop("disabled", false)
          .find("svg")
          .removeClass("animate-spin");
      },
    });
  }

  // Aplicar filtro rápido
  function applyQuickFilter(filterType, button) {
    const originalContent = button.html();

    // Mostrar estado de carga en el botón
    button.html(`
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg">
                <svg class="animate-spin w-4 h-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
            <span>Cargando...</span>
        `);

    $.ajax({
      url: itoolsFilters.ajaxurl,
      type: "POST",
      data: {
        action: "itools_quick_filter",
        filter_type: filterType,
        paged: 1,
        nonce: itoolsFilters.nonce,
      },
      success: function (response) {
        if (response.success) {
          // Actualizar grid de productos
          if (elements.productsGrid.length) {
            elements.productsGrid.html(response.data.html);
            rebindCartEvents();
          }

          // Mostrar notificación
          const filterNames = {
            "best-sellers": "Más Vendidos",
            "top-rated": "Mejor Valorados",
            "on-sale": "Ofertas",
            newest: "Nuevos",
          };

          showNotification(
            `Filtro "${filterNames[filterType]}" aplicado: ${response.data.found_products} productos encontrados`,
            "success"
          );

          // Limpiar otros filtros del sidebar
          clearSidebarFilters();
        } else {
          showError(response.data || "Error al aplicar filtro");
        }
      },
      error: function () {
        showError("Error de conexión al aplicar filtro rápido");
      },
      complete: function () {
        // Restaurar contenido original del botón
        button.html(originalContent);
      },
    });
  }

  // Limpiar filtros del sidebar sin aplicar
  function clearSidebarFilters() {
    $("#sidebar-search").val("");
    $("#sidebar-min-price").val("");
    $("#sidebar-max-price").val("");
    $("#sidebar-stock").val("");

    // Resetear sliders
    const minSlider = $("#min-price-slider");
    const maxSlider = $("#max-price-slider");
    if (minSlider.length && maxSlider.length) {
      const minRange = minSlider.attr("min");
      const maxRange = maxSlider.attr("max");

      minSlider.val(minRange);
      maxSlider.val(maxRange);
      $("#min-price-display").text(new Intl.NumberFormat().format(minRange));
      $("#max-price-display").text(new Intl.NumberFormat().format(maxRange));
      updateSliderRange();
    }

    $(".price-preset")
      .removeClass("bg-green-100 text-green-700")
      .addClass("bg-gray-100");
  }

  // Inicializar sliders de precio
  function initializePriceSliders() {
    // Inicializar el rango visual del slider
    setTimeout(() => {
      updateSliderRange();
    }, 100);
  }

  // Inicializar cuando el DOM esté listo
  $(document).ready(function () {
    // Solo inicializar si estamos en páginas de productos
    if (
      $("body").hasClass("woocommerce-page") ||
      $("body").hasClass("post-type-archive-product") ||
      $(".woocommerce").length > 0
    ) {
      initFilters();
      bindSidebarFilterEvents();
      initializePriceSliders();
    }
  });
})(jQuery);
