# Sistema de Gestión de Inventario ITOOLS

## 🚀 Características Principales

### ✅ **Gestión Completa de Inventario**
- **Seguimiento en tiempo real** del stock disponible y reservado
- **Alertas automáticas** cuando el stock está bajo
- **Historial completo** de movimientos de inventario
- **Sincronización automática** con WooCommerce

### ✅ **Tiempos de Disponibilidad Inteligentes**
- **Cálculo automático** de tiempos de entrega basado en stock
- **Fechas de reposición** para productos agotados
- **Estados dinámicos**: En Stock, Stock Limitado, Agotado
- **Información detallada** de disponibilidad para cada producto

### ✅ **Notificaciones de Disponibilidad**
- **Formularios de suscripción** para productos agotados
- **Emails automáticos** cuando los productos vuelven a estar disponibles
- **Base de datos** de clientes interesados en productos

### ✅ **Panel de Administración Avanzado**
- **Dashboard de inventario** con estadísticas en tiempo real
- **Gestión individual** de cada producto
- **Historial de movimientos** detallado
- **Widget en el dashboard** con alertas de stock bajo

## 📊 **Tablas de Base de Datos**

### 1. `wp_itools_product_inventory`
```sql
- product_id: ID del producto
- current_stock: Stock actual disponible
- reserved_stock: Stock reservado en órdenes pendientes
- min_stock_alert: Nivel mínimo para alertas
- max_stock: Stock máximo recomendado
- restock_date: Fecha estimada de reposición
- supplier_info: Información del proveedor
- availability_status: Estado (in_stock, low_stock, out_of_stock)
- estimated_delivery_days: Días estimados de entrega
- last_updated: Fecha de última actualización
```

### 2. `wp_itools_inventory_movements`
```sql
- product_id: ID del producto
- movement_type: Tipo (sale, restock, reserve, release, adjustment)
- quantity: Cantidad del movimiento
- order_id: ID de la orden relacionada (si aplica)
- reason: Razón del movimiento
- user_id: Usuario que realizó el movimiento
- movement_date: Fecha del movimiento
```

### 3. `wp_itools_availability_notifications`
```sql
- product_id: ID del producto
- customer_email: Email del cliente
- customer_name: Nombre del cliente
- notified: Si ya fue notificado
- date_requested: Fecha de solicitud
- date_notified: Fecha de notificación
```

## 🎯 **Funcionalidades Frontend**

### **Página de Producto**
- **Estado visual** del inventario con colores dinámicos
- **Tiempo estimado de entrega** calculado automáticamente
- **Información de stock** disponible vs reservado
- **Formulario de notificación** para productos agotados
- **Datos administrativos** visibles solo para administradores

### **Estados de Disponibilidad**
1. **🟢 En Stock**: Producto disponible inmediatamente
2. **🟡 Stock Limitado**: Pocas unidades disponibles
3. **🔴 Agotado**: Sin stock, con opción de notificación

## ⚙️ **Funcionalidades Backend**

### **Actualización Automática de Inventario**
- **Al completar órdenes**: Reduce stock automáticamente
- **Al crear órdenes**: Reserva stock temporalmente
- **Al cancelar órdenes**: Libera stock reservado
- **Sincronización con WooCommerce**: Mantiene consistencia

### **Sistema de Alertas**
- **Emails diarios** a administradores sobre stock bajo
- **Widget en dashboard** con resumen de inventario
- **Notificaciones push** cuando productos vuelven a estar disponibles

## 🛠️ **Uso del Sistema**

### **Para Administradores**

#### Acceder al Panel de Inventario:
1. Ve a **WordPress Admin → Inventario**
2. Revisa el **dashboard de estadísticas**
3. **Edita inventarios** individualmente
4. Consulta **movimientos** en la pestaña correspondiente

#### Gestionar Inventario:
1. **Clic en "Editar"** en cualquier producto
2. **Actualizar campos**:
   - Stock actual
   - Alerta de stock mínimo
   - Stock máximo
   - Días de entrega
   - Fecha de reposición
   - Información del proveedor
3. **Guardar cambios**

### **Para Clientes**

#### Ver Disponibilidad:
- La información aparece automáticamente en cada producto
- **Estados visuales** claros con colores
- **Tiempos de entrega** estimados
- **Cantidad disponible** si hay stock

#### Solicitar Notificaciones:
1. En productos agotados, aparece **formulario automáticamente**
2. **Llenar email y nombre**
3. **Recibir confirmación** de suscripción
4. **Email automático** cuando vuelva a estar disponible

## 📱 **Shortcodes Disponibles**

### `[itools_inventory]`
Muestra información de inventario en cualquier lugar:

```php
// Básico (producto actual)
[itools_inventory]

// Con parámetros específicos
[itools_inventory product_id="123" show_stock="true" show_delivery="true" show_status="true"]
```

## 🔧 **Funciones PHP Útiles**

```php
// Obtener inventario de un producto
$inventory = itools_get_product_inventory($product_id);

// Calcular estado de disponibilidad
$status = itools_calculate_availability_status($inventory);

// Obtener fecha estimada de entrega
$delivery = itools_get_estimated_delivery_date($product_id);

// Actualizar inventario
itools_update_inventory($product_id, array(
    'current_stock' => 50,
    'min_stock_alert' => 10
));

// Registrar movimiento de inventario
itools_record_inventory_movement($product_id, 'restock', 25, null, 'Reposición manual');
```

## 🚀 **Instalación y Activación**

1. **Las tablas se crean automáticamente** al activar el tema
2. **Los productos existentes** se inicializan automáticamente
3. **El panel de administración** está disponible inmediatamente
4. **Los widgets y alertas** se configuran automáticamente

## 📈 **Beneficios del Sistema**

### **Para el Negocio:**
- ✅ **Control total** del inventario
- ✅ **Reducción de ventas perdidas** por falta de stock
- ✅ **Mejor planificación** de compras y reposiciones
- ✅ **Reportes automáticos** de estado de inventario
- ✅ **Sincronización perfecta** con WooCommerce

### **Para los Clientes:**
- ✅ **Información transparente** de disponibilidad
- ✅ **Expectativas claras** de tiempos de entrega
- ✅ **Notificaciones automáticas** de productos de interés
- ✅ **Mejor experiencia** de compra

## 🎉 **¡Sistema Completamente Funcional!**

El sistema está **listo para usar** inmediatamente después de activar el tema. Todas las funcionalidades están integradas y funcionando automáticamente.

### **Próximos Pasos Recomendados:**
1. **Revisar** el panel de inventario
2. **Configurar** alertas de stock mínimo
3. **Probar** el sistema con productos existentes
4. **Capacitar** al equipo en el uso del panel de administración

---

**¿Necesitas personalizar algo o agregar más funcionalidades?** El sistema está diseñado para ser completamente extensible y personalizable según las necesidades específicas del negocio.
