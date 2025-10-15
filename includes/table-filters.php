<?php
/**
 * Table Filters Component
 * Filtros para la vista de tabla de productos
 */
?>

<div id="table-filters" class="hidden mb-6 bg-white rounded-lg border border-gray-200 p-4">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <!-- Búsqueda -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Buscar producto</label>
            <input type="text" id="table-search" placeholder="Buscar por nombre..." 
                   class="product-search-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <!-- Filtro por disponibilidad -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Disponibilidad</label>
            <select id="stock-filter" class="availability-filter w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Todos</option>
                <option value="in-stock">En stock</option>
                <option value="out-of-stock">Agotado</option>
            </select>
        </div>
        
        <!-- Filtro por precio -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Precio máximo</label>
            <input type="number" id="max-price-filter" placeholder="Precio máx" 
                   class="price-filter w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <!-- Botones de acción -->
        <div class="flex items-end">
            <button id="apply-filters-btn" class="apply-filters w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors font-medium">
                Aplicar Filtros
            </button>
        </div>
        
        <!-- Botón limpiar -->
        <div class="flex items-end">
            <button id="clear-table-filters" class="clear-filters w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">
                Limpiar
            </button>
        </div>
    </div>
    
    <!-- Estado de carga -->
    <div class="filters-loading hidden mt-4 text-center">
        <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Filtrando productos...
        </div>
    </div>
</div>