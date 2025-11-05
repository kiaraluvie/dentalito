# Guía Rápida para Usar la API del Sistema

Este documento explica de forma sencilla cómo interactuar con la API de nuestro sistema, tanto para consultarla como para integrarla con otras aplicaciones.

---

## El API Token y la Base de Datos

Para que la autenticación de la API funcione, es necesario que la tabla de `tenants` (inquilinos) en la base de datos tenga un campo para guardar el API Token.

### La Migración `add_api_token_to_tenants_table`

Dentro del sistema, existe un archivo de migración con el nombre `..._add_api_token_to_tenants_table.php`. 

- **¿Qué hace?** Su única función es añadir una nueva columna llamada `api_token` a la tabla `tenants`.
- **¿Para qué sirve?** En esta columna se guarda la clave de la API (el "token") en formato de texto plano. Su propósito es **únicamente poder mostrarle la clave al usuario la primera vez que se genera**. La autenticación real de las peticiones se realiza de forma segura a través de Laravel Sanctum, que maneja una versión encriptada del token.

Cuando se ejecutan las migraciones del proyecto (`php artisan migrate`), esta columna se crea automáticamente.

---

## 1. ¿Cómo Ver la Documentación Interactiva de la API? (Swagger)

Para que sea fácil entender qué acciones permite nuestra API, usamos una herramienta llamada **Swagger**.

**Analogía:** Piensa en Swagger como un **manual de instrucciones interactivo** para la API. Te muestra todas las funciones disponibles y te permite probarlas en tiempo real.

### Pasos para Acceder a Swagger:

1.  **Asegúrate de que el servidor local (Laragon) esté funcionando.**
2.  Abre tu navegador web y ve a la siguiente dirección:
    `http://<tu-dominio-local>/api/documentation`
    *(Reemplaza `<tu-dominio-local>` con el nombre de tu proyecto, por ejemplo: `blog_main_base.test`)*

### ¿Cómo Usar la Página de Swagger?

-   **Autorización (El Candado):** La mayoría de las acciones requieren un "API Token" para funcionar.
    1.  Haz clic en el botón verde **"Authorize"** que verás en la parte superior derecha.
    2.  En la ventana que aparece, en el campo `BearerAuth`, escribe `Bearer ` (con un espacio al final) seguido de tu API Token. Ejemplo: `Bearer 1|abc...xyz`.
    3.  Haz clic en **"Authorize"** y luego en **"Close"**. Ahora todas tus peticiones estarán autenticadas.

-   **Acciones (Endpoints):** Verás una lista de acciones agrupadas por categorías (como `Languages`, `Tenant`, etc.). Cada acción tiene un color:
    -   <span style="color:blue;">**GET (Azul):**</span> Sirve para **consultar** u obtener información.
    -   <span style="color:green;">**POST (Verde):**</span> Sirve para **crear** un nuevo elemento.
    -   <span style="color:orange;">**PUT (Naranja):**</span> Sirve para **actualizar** un elemento existente.
    -   <span style="color:red;">**DELETE (Rojo):**</span> Sirve para **borrar** un elemento.

-   **Probar una Acción:**
    1.  Haz clic en la acción que quieras probar (por ejemplo, `GET /api/languages`).
    2.  Haz clic en el botón **"Try it out"**.
    3.  Si la acción necesita parámetros (como un ID), rellena los campos.
    4.  Haz clic en el botón azul **"Execute"**.
    5.  Más abajo verás la respuesta del servidor, que son los datos que has solicitado o el resultado de la acción.

---

## 2. ¿Cómo Usar la API desde Otro Sistema?

**Analogía:** Piensa en la API como un **camarero en un restaurante**. Tu otro sistema (el cliente) le da una orden específica al camarero (hace una "petición"), y el camarero va a la cocina (la base de datos) y trae de vuelta el plato solicitado (los "datos").

### La Llave de Acceso (Autenticación)

Para que el camarero te haga caso, necesitas demostrar que eres un cliente válido. En la API, esto se hace con el **API Token**.

Cada petición que tu sistema haga a la API debe incluir una "cabecera" (Header) de autorización.

-   **Nombre de la cabecera:** `Authorization`
-   **Valor de la cabecera:** `Bearer <tu_api_token_aqui>`

### Acciones Principales Disponibles (Endpoints)

Estas son las URLs que tu otro sistema puede llamar para realizar acciones.

#### Idiomas (`Languages`)

-   **`GET /api/languages`**
    -   **Propósito:** Obtiene una lista de todos los idiomas disponibles.
-   **`POST /api/languages`**
    -   **Propósito:** Crea un nuevo idioma.
    -   **Datos necesarios:** `name` (ej: "Alemán") y `iso_code` (ej: "de").
    -   **Respuesta:** Te devolverá el `id` y `name` del idioma recién creado.
-   **`GET /api/languages/{id}`**
    -   **Propósito:** Obtiene los datos de un solo idioma usando su `id`.
-   **`PUT /api/languages/{id}`**
    -   **Propósito:** Actualiza los datos de un idioma usando su `id`.
-   **`DELETE /api/languages/{id}`**
    -   **Propósito:** Marca un idioma como "borrado" usando su `id`.

#### Inquilino (`Tenant`)

-   **`GET /api/tenant-profile`**
    -   **Propósito:** Obtiene la información del "inquilino" (la cuenta principal) a la que pertenece el API Token que estás usando.

### Ejemplo de Flujo de Trabajo

Imagina que quieres borrar el idioma "Português".

1.  **Paso 1: Obtener la lista para saber el ID.**
    -   Tu sistema hace una petición `GET` a `/api/languages`.
    -   La API responde con una lista, y ves que "Português" tiene el `id: 3`.

2.  **Paso 2: Borrar el idioma usando su ID.**
    -   Ahora que sabes el ID, tu sistema hace una petición `DELETE` a `/api/languages/3`.
    -   La API marcará ese idioma como borrado. Si vuelves a pedir la lista, ya no aparecerá.
