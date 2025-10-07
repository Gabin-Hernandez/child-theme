/**
 * Filtros de Tabla - ITOOLS MX
 * Sistema simplificado y dedicado para filtros de vista de tabla
 */

(function ($) {
  "use strict";

  // Inicializar cuando el documento esté listo
  $(document).ready(function () {
    console.log("🎯 Inicializando filtros de tabla...");

    // Event listeners para filtros de tabla
    $("#table-search").on("input", function () {
      console.log("🔍 Búsqueda:", $(this).val());
      filterTable();
    });

    $("#stock-filter").on("change", function () {
      console.log("📦 Stock:", $(this).val());
      filterTable();
    });

    $("#apply-filters-btn").on("click", function (e) {
      e.preventDefault();
      console.log("🎯 Aplicar filtros");
      filterTable();
    });

    $("#clear-table-filters").on("click", function (e) {
      e.preventDefault();
      console.log("🧹 Limpiar filtros");
      clearTableFilters();
    });

    console.log("✅ Filtros de tabla inicializados");
  });

  // Función principal de filtrado
  function filterTable() {
    console.log("📊 Filtrando tabla...");

    // Obtener valores de filtros
    const searchTerm = $("#table-search").val().toLowerCase().trim();
    const stockFilter = $("#stock-filter").val();

    console.log("Término de búsqueda:", searchTerm);
    console.log("Filtro de stock:", stockFilter);

    // Detectar si hay filtros activos
    const hasActiveFilters = searchTerm.length > 0 || stockFilter !== "";

    // Obtener todas las filas de productos
    const rows = $("#table-body tr.product-row");
    let visibleCount = 0;
    const totalCount = rows.length;

    console.log("Total de filas:", totalCount);

    // Filtrar cada fila
    rows.each(function () {
      const row = $(this);
      let showRow = true;

      // Obtener datos de la fila
      const productName = (row.attr("data-name") || "").toLowerCase();
      const productStock = (row.attr("data-stock") || "").toLowerCase();

      console.log("Revisando producto:", productName, "| Stock:", productStock);

      // Aplicar filtro de búsqueda
      if (searchTerm && searchTerm.length > 0) {
        if (!productName.includes(searchTerm)) {
          showRow = false;
          console.log("  ❌ No coincide búsqueda");
        } else {
          console.log("  ✅ Coincide búsqueda");
        }
      }

      // Aplicar filtro de stock
      if (stockFilter && stockFilter !== "") {
        if (stockFilter === "in-stock" && productStock !== "in-stock") {
          showRow = false;
          console.log("  ❌ No está en stock");
        } else if (
          stockFilter === "out-of-stock" &&
          productStock !== "out-of-stock"
        ) {
          showRow = false;
          console.log("  ❌ Sí está en stock");
        }
      }

      // Mostrar u ocultar fila
      if (showRow) {
        row.show();
        visibleCount++;
      } else {
        row.hide();
      }
    });

    console.log("✅ Productos visibles:", visibleCount, "de", totalCount);

    // Mostrar mensaje si no hay resultados
    updateEmptyState(visibleCount);
    
    // Actualizar contador de resultados
    updateResultsCounter(visibleCount, totalCount, hasActiveFilters);
    
    // Ocultar/mostrar paginación según filtros activos
    togglePagination(hasActiveFilters);
  }

  // Limpiar filtros
  function clearTableFilters() {
    $("#table-search").val("");
    $("#stock-filter").val("");
    filterTable();
  }

  // Actualizar mensaje de tabla vacía
  function updateEmptyState(visibleCount) {
    let emptyRow = $("#table-body .no-results-row");

    if (visibleCount === 0) {
      if (emptyRow.length === 0) {
        const colSpan = $("#table-body tr.product-row:first td").length || 4;
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
        $("#table-body").append(emptyRow);
      }
      emptyRow.show();
    } else {
      emptyRow.hide();
    }
  }
  
  // Actualizar contador de resultados
  function updateResultsCounter(visibleCount, totalCount, hasActiveFilters) {
    // Crear o actualizar el contador si no existe
    let counter = $("#table-results-counter");
    
    if (counter.length === 0) {
      // Crear el contador después de los filtros de tabla
      counter = $(`
        <div id="table-results-counter" class="mb-4 px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700 font-medium"></div>
      `);
      $("#table-filters").after(counter);
    }
    
    // Actualizar texto del contador
    if (hasActiveFilters) {
      if (visibleCount === totalCount) {
        counter.html(`
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Mostrando todos los <strong>${totalCount}</strong> productos
          </span>
        `);
      } else {
        counter.html(`
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
            </svg>
            Mostrando <strong>${visibleCount}</strong> de <strong>${totalCount}</strong> productos
          </span>
        `);
      }
      counter.show();
    } else {
      counter.hide();
    }
  }
  
  // Ocultar/mostrar paginación
  function togglePagination(hasActiveFilters) {
    // Buscar el contenedor de paginación
    const pagination = $(".woocommerce-pagination, nav.woocommerce-pagination, .pagination");
    
    if (hasActiveFilters) {
      // Ocultar paginación cuando hay filtros activos
      pagination.hide();
      console.log("🚫 Paginación oculta (filtros activos)");
    } else {
      // Mostrar paginación cuando no hay filtros
      pagination.show();
      console.log("✅ Paginación visible (sin filtros)");
    }
  }
})(jQuery);
