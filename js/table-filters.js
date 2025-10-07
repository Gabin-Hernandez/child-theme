/**
 * Filtros de Tabla - ITOOLS MX
 * Sistema simplificado y dedicado para filtros de vista de tabla
 */

(function ($) {
  "use strict";

  // Variables para paginación
  let currentPage = 1;
  let itemsPerPage = 12;
  let filteredRows = [];

    // Inicializar cuando el documento esté listo
    $(document).ready(function () {
        console.log("🎯 Inicializando filtros de tabla...");

        // Event listeners para filtros de tabla
        $("#table-search").on("input", function () {
            console.log("🔍 Búsqueda:", $(this).val());
            currentPage = 1; // Reset a primera página
            filterTable();
        });

        $("#stock-filter").on("change", function () {
            console.log("📦 Stock:", $(this).val());
            currentPage = 1; // Reset a primera página
            filterTable();
        });

        $("#apply-filters-btn").on("click", function (e) {
            e.preventDefault();
            console.log("🎯 Aplicar filtros");
            currentPage = 1; // Reset a primera página
            filterTable();
        });

        $("#clear-table-filters").on("click", function (e) {
            e.preventDefault();
            console.log("🧹 Limpiar filtros");
            clearTableFilters();
        });

        // Observar cambios de vista para manejar paginación
        observeViewChanges();
        
        // Manejar paginación inicial
        managePaginationVisibility();

        console.log("✅ Filtros de tabla inicializados");
    });  // Observar cambios de vista (grid/table)
  function observeViewChanges() {
    // Usar MutationObserver para detectar cuando cambia la vista
    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.attributeName === "class") {
          managePaginationVisibility();
        }
      });
    });

    // Observar cambios en products-table
    const tableElement = document.getElementById("products-table");
    if (tableElement) {
      observer.observe(tableElement, {
        attributes: true,
        attributeFilter: ["class"],
      });
    }
  }

  // Función principal de filtrado
  function filterTable() {
    console.log("📊 Filtrando tabla...");

    // Obtener valores de filtros
    const searchTerm = $("#table-search").val().toLowerCase().trim();
    const stockFilter = $("#stock-filter").val();

    console.log("Término de búsqueda:", searchTerm);
    console.log("Filtro de stock:", stockFilter);

    // Obtener todas las filas de productos
    const rows = $("#table-body tr.product-row");
    filteredRows = []; // Reset filtered rows

    console.log("Total de filas:", rows.length);

    // Filtrar cada fila
    rows.each(function () {
      const row = $(this);
      let showRow = true;

      // Obtener datos de la fila
      const productName = (row.attr("data-name") || "").toLowerCase();
      const productStock = (row.attr("data-stock") || "").toLowerCase();

      // Aplicar filtro de búsqueda
      if (searchTerm && searchTerm.length > 0) {
        if (!productName.includes(searchTerm)) {
          showRow = false;
        }
      }

      // Aplicar filtro de stock
      if (stockFilter && stockFilter !== "") {
        if (stockFilter === "in-stock" && productStock !== "in-stock") {
          showRow = false;
        } else if (
          stockFilter === "out-of-stock" &&
          productStock !== "out-of-stock"
        ) {
          showRow = false;
        }
      }

      // Agregar a array de filas filtradas
      if (showRow) {
        filteredRows.push(row);
      }
    });

    console.log(
      "✅ Productos filtrados:",
      filteredRows.length,
      "de",
      rows.length
    );

    // Ocultar todas las filas primero
    rows.hide();

    // Mostrar solo las filas de la página actual
    displayPage();

    // Actualizar paginación
    updatePagination();

    // Mostrar mensaje si no hay resultados
    updateEmptyState(filteredRows.length);

    // Ocultar/mostrar paginación según filtros activos
    managePaginationVisibility();
  }

  // Mostrar filas de la página actual
  function displayPage() {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    for (let i = startIndex; i < endIndex && i < filteredRows.length; i++) {
      filteredRows[i].show();
    }

    console.log(
      "📄 Mostrando página",
      currentPage,
      "| Items:",
      startIndex,
      "-",
      Math.min(endIndex, filteredRows.length)
    );
  }

  // Actualizar la paginación
  function updatePagination() {
    const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
    console.log("📊 Total de páginas para filtros:", totalPages);

    if (totalPages > 1) {
      // Crear paginación personalizada para tabla
      let paginationHtml =
        '<nav class="woocommerce-pagination table-pagination mt-8"><ul class="page-numbers flex justify-center gap-2">';

      // Botón anterior
      if (currentPage > 1) {
        paginationHtml +=
          '<li><a class="prev page-numbers px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 cursor-pointer" data-page="' +
          (currentPage - 1) +
          '">←</a></li>';
      }

      // Números de página (máximo 7 números)
      let startPage = Math.max(1, currentPage - 3);
      let endPage = Math.min(totalPages, startPage + 6);

      if (endPage - startPage < 6) {
        startPage = Math.max(1, endPage - 6);
      }

      if (startPage > 1) {
        paginationHtml +=
          '<li><a class="page-numbers px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 cursor-pointer" data-page="1">1</a></li>';
        if (startPage > 2) {
          paginationHtml +=
            '<li><span class="page-numbers px-3 py-2">...</span></li>';
        }
      }

      for (let i = startPage; i <= endPage; i++) {
        if (i === currentPage) {
          paginationHtml +=
            '<li><span aria-current="page" class="page-numbers current px-3 py-2 bg-blue-600 text-white border border-blue-600 rounded-md">' +
            i +
            "</span></li>";
        } else {
          paginationHtml +=
            '<li><a class="page-numbers px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 cursor-pointer" data-page="' +
            i +
            '">' +
            i +
            "</a></li>";
        }
      }

      if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
          paginationHtml +=
            '<li><span class="page-numbers px-3 py-2">...</span></li>';
        }
        paginationHtml +=
          '<li><a class="page-numbers px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 cursor-pointer" data-page="' +
          totalPages +
          '">' +
          totalPages +
          "</a></li>";
      }

      // Botón siguiente
      if (currentPage < totalPages) {
        paginationHtml +=
          '<li><a class="next page-numbers px-3 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 cursor-pointer" data-page="' +
          (currentPage + 1) +
          '">→</a></li>';
      }

      paginationHtml += "</ul></nav>";

      // Reemplazar o agregar paginación
      if ($(".table-pagination").length) {
        $(".table-pagination").replaceWith(paginationHtml);
      } else {
        $("#products-table").after(paginationHtml);
      }

      // Event listeners para paginación
      $(".table-pagination .page-numbers[data-page]").on("click", function (e) {
        e.preventDefault();
        const page = parseInt($(this).data("page"));
        if (page) {
          currentPage = page;
          $("#table-body tr.product-row").hide();
          displayPage();
          updatePagination();

          // Scroll al inicio de la tabla
          $("html, body").animate(
            {
              scrollTop: $("#products-table").offset().top - 100,
            },
            300
          );
        }
      });
    } else {
      // Eliminar paginación si solo hay una página o menos
      $(".table-pagination").remove();
    }
  }

  // Manejar visibilidad de la paginación original
  function managePaginationVisibility() {
    const searchTerm = $("#table-search").val().trim();
    const stockFilter = $("#stock-filter").val();
    const hasActiveFilters = searchTerm.length > 0 || stockFilter !== "";

    const isTableVisible =
      $("#products-table").is(":visible") &&
      !$("#products-table").hasClass("hidden");

    // Si estamos en vista de tabla
    if (isTableVisible) {
      if (hasActiveFilters) {
        // Ocultar paginación original de WooCommerce cuando hay filtros activos
        $(".woocommerce-pagination:not(.table-pagination)").hide();
        console.log("🚫 Paginación original oculta (filtros activos en tabla)");
      } else {
        // Mostrar paginación original si no hay filtros
        $(".woocommerce-pagination:not(.table-pagination)").show();
        $(".table-pagination").remove();
        console.log("✅ Paginación original visible (sin filtros en tabla)");
      }
    } else {
      // Si no estamos en vista tabla, siempre mostrar paginación original
      $(".woocommerce-pagination:not(.table-pagination)").show();
      $(".table-pagination").remove();
    }
  }

  // Limpiar filtros
  function clearTableFilters() {
    $("#table-search").val("");
    $("#stock-filter").val("");
    currentPage = 1;

    // Mostrar todas las filas
    $("#table-body tr.product-row").show();

    // Quitar mensaje de vacío
    updateEmptyState($("#table-body tr.product-row").length);

    // Restaurar paginación original
    $(".table-pagination").remove();
    $(".woocommerce-pagination:not(.table-pagination)").show();

    console.log("✅ Filtros limpiados");
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
})(jQuery);
