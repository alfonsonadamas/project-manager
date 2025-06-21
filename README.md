
# Proyecto de Gestión de Tareas y Proyectos

Este proyecto es una aplicación web para gestionar proyectos, tareas y usuarios. Está desarrollado utilizando **Laravel** para el backend y **Vue.js** con **Inertia.js** para el frontend.

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalados los siguientes programas en tu entorno:

- PHP 8.1 o superior
- Composer
- Node.js y npm
- MySQL o cualquier base de datos compatible con Laravel

## Configuración del Entorno

1. Copia el archivo `.env.example` a un nuevo archivo `.env`:

```bash
cp .env.example .env
```

## Configuración de la Base de Datos

Asegúrate de que tu base de datos esté configurada en el archivo `.env`. Actualiza las siguientes variables con los detalles de tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

## Instalación de Dependencias

### Dependencias de PHP

Ejecuta el siguiente comando para instalar las dependencias de PHP:

```bash
composer install
```

### Dependencias de JavaScript

Ejecuta el siguiente comando para instalar las dependencias de JavaScript:

```bash
npm install
```

## Generar la Clave de la Aplicación

Genera una clave para la aplicación Laravel:

```bash
php artisan key:generate
```

## Migrar la Base de Datos

Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

```bash
php artisan migrate
```

Si necesitas datos de prueba, puedes ejecutar el seeder:

```bash
php artisan db:seed
```

## Ejecutar el Servidor

Finalmente, puedes ejecutar el servidor de desarrollo de Laravel:

```bash
php artisan serve
```

El servidor estará disponible en [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Ejecutar el Frontend

Para el frontend, ejecuta el siguiente comando para iniciar el servidor de desarrollo de Vue.js con Vite:

```bash
npm run dev
```

Este comando iniciará un servidor de desarrollo en [http://localhost:3000](http://localhost:3000).

## Funcionalidades

El sistema tiene las siguientes funcionalidades:

### 1. Gestión de Proyectos

- Listar proyectos.
- Crear nuevos proyectos.
- Editar proyectos existentes.
- Eliminar proyectos.

### 2. Gestión de Tareas

- Listar tareas.
- Crear nuevas tareas.
- Editar tareas existentes.
- Eliminar tareas.
- Asignar tareas a usuarios.

### 3. Gestión de Usuarios

- Listar usuarios.
- Ver detalles de un usuario y asignar proyectos.
- Asignar y quitar proyectos a usuarios.

### 4. Roles y Permisos

- **Administrador (Admin)**: Puede crear, editar y eliminar proyectos, tareas y usuarios. También puede asignar proyectos a los usuarios.
- **Colaborador (User)**: Puede ver y actualizar tareas asignadas a él.

### 5. Autenticación

- Los usuarios pueden registrarse, iniciar sesión y gestionar sus tareas y proyectos asignados.
- Los administradores tienen acceso completo a todas las funcionalidades.

## Estructura del Proyecto

### Backend (Laravel)

- `app/`: Contiene la lógica del backend (controladores, modelos, etc.).
- `database/migrations/`: Migraciones para crear las tablas de la base de datos.
- `routes/web.php`: Rutas del backend para manejar las solicitudes HTTP.
- `.env`: Configuración del entorno (base de datos, correo, etc.).

### Frontend (Vue.js + Inertia.js)

- `resources/js/`: Contiene el frontend en Vue 3.
  - `components/`: Componentes reutilizables.
  - `views/`: Vistas (páginas) principales del proyecto.
  - `resources/js/Layouts/`: Layouts que se utilizan en las vistas.
  - `resources/js/app.js`: Punto de entrada principal del frontend.





