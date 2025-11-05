# Gestión de Roles y Permisos

Este documento explica cómo funciona el sistema de roles y permisos en el proyecto y cómo gestionarlos a través de la línea de comandos con `php artisan tinker`.

El proyecto utiliza el paquete `spatie/laravel-permission` para un control de acceso granular.

---

## Conceptos Clave

### 1. Rol `super` (Super Administrador)

Existe un rol especial llamado `super`. Cualquier usuario con este rol tiene acceso total y absoluto a todos los módulos y todas las acciones del sistema. Esto se logra a través de una regla `Gate::before` definida en `app/Providers/AppServiceProvider.php`, que automáticamente aprueba cualquier verificación de permisos para este rol.

### 2. Roles

Los roles son conjuntos de permisos que se pueden asignar a los usuarios. Los roles base son `super`, `admin`, y `user`, pero se pueden crear más según sea necesario.

### 3. Permisos

Los permisos se generan automáticamente basados en los módulos registrados en la tabla `system_modules`. Para cada módulo, se crean los siguientes permisos:

- `nombre_del_modulo.view`
- `nombre_del_modulo.create`
- `nombre_del_modulo.edit`
- `nombre_del_modulo.delete`
- `nombre_del_modulo.export`
- `nombre_del_modulo.edit_all`

--- 

## Gestión con `php artisan tinker`

La forma más directa de gestionar roles y permisos para un usuario específico o un rol es a través de `php artisan tinker`.

**Para iniciar tinker, ejecuta:**
```bash
php artisan tinker
```

Una vez dentro de tinker, puedes usar los siguientes comandos. **Recuerda siempre reemplazar `'user@example.com'` por el email del usuario real.**

### Asignar un rol a un usuario
*Esto añade un rol sin afectar los que ya tiene.*
### Aclaracion, ingresar linea por linea los comandos y siempre dentro del comando tinker, ignorar php

```php
$user = App\Models\User::where('email', 'user@example.com')->first();
$user->assignRole('nombre_del_rol');
```

### Sincronizar roles de un usuario
*Esto elimina todos los roles actuales del usuario y le asigna únicamente los que especifiques. **Es la forma más segura de asegurar que un usuario tenga solo un rol**.*

```php
$user = App\Models\User::where('email', 'user@example.com')->first();
$user->syncRoles(['user']); // El usuario ahora solo tendrá el rol 'user'
```

### Asignar un permiso a un rol por ejemplo solo vista de users-usuarios

```php
$role = Spatie\Permission\Models\Role::findByName('user');
$role->givePermissionTo('users.view');
```
### Este es un ejemplo para Añadir permisos (sin borrar los existentes)

Si quieres añadir countries.view a los permisos que el rol ya tiene, puedes pasar un array de nombres de 
  permisos:
  `php
  $role = Spatie\Permission\Models\Role::findByName('user');
  $role->givePermissionTo(['users.view', 'countries.view']);
  `
### Crear un nuevo rol

```php
$role = Spatie\Permission\Models\Role::create(['name' => 'nuevo_rol']);
```

### Verificar roles de un usuario

```php
$user = App\Models\User::where('email', 'user@example.com')->first();
$user->getRoleNames();
```

### Verificar permisos de un rol

```php
$role = Spatie\Permission\Models\Role::findByName('user');
$role->permissions->pluck('name');
```

---

## Importante: Limpieza de Caché

Después de realizar cambios en los roles o permisos, es crucial limpiar la caché del paquete para que los cambios se apliquen correctamente.

Ejecuta el siguiente comando en tu terminal:

```bash
php artisan permission:cache-reset
```
