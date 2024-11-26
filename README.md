
## TASK MANAGER ⭐ 
![image](https://github.com/user-attachments/assets/fb0c21ab-48de-44e0-80ea-6c94a273a1cf)


## Descripción del Proyecto 🖊️

**_Gestor de tareas que permite gestionar empleados, equipos, con funciones avanzandas de asignar proyectos y tareas._**

 ## Contenido 
 - **Dashboard 🖥️**
 - **Panel de Secciones 🔎**
 - **Sección Departamentos 🏢**
 - **Sección Empleados 👤**
 - **Sección Equipos 👥**
 - **Sección Proyectos 📂**
 - **Sección Tareas 📚**

## Características 
- **Visualización la cantidad de empleados que hay**
- **Departamentos con un código único 🔏**
- **Equipos creados por Departamento 👥**
- **Para los proyectos y tareas se tiene un seguimiento del inicio y la finalización de la actividad 🗓️**
- **Se tiene un orden de estado y prioridad para los proyectos y tareas tales como :**
<ul>
 <strong>Estado</strong>
  <li><span style="color: red;">🔴</span> <strong>No iniciado</strong></li>
  <li><span style="color: yellow;">🟡</span> <strong>En progreso</strong></li>
  <li><span style="color: green;">🟢</span> <strong>Finalizado</strong></li>
</ul>  
<ul>
<strong>Prioridad</strong>
<li><strong>Baja</strong></li>
<li><strong>Media</strong></li>
<li><strong>Alta</strong></li>
</ul>  

- **Flitros de búsqueda en cada sección**

## Tecnologías Utilizadas 🔎

- **Laravel**: Framework de PHP para el desarrollo del backend.
- **Filament**: Librería para construir paneles administrativos y CRUDs rápidamente en Laravel.
- **MySQL**: Sistema de gestión de bases de datos relacional utilizado para almacenar y gestionar los datos.

# Requisitos 📕

**Para ejecutar este proyecto, se debe de tener instalados los siguientes componentes:**

- **[PHP](https://www.php.net/)** : Versión 8.1 o superior.
- **[Composer](https://getcomposer.org/)** : Para gestionar las dependencias de PHP.
- **[Laravel Framework](https://laravel.com/docs/11.x/installation)**: Versión 10 o superior, instalado globalmente o como parte del proyecto.
- **[Filament](https://filamentphp.com/docs/3.x/panels/installation)**: Versión 3.2 o superior.
- **[MySQl](https://dev.mysql.com/downloads/installer/)** : Como base de datos relacional.

# Instalación 🖥️
- **Clona este repositorio:**
```
git clone https://github.com/noemvy/task--manager.git
cd taskManager
```
- **Instala las dependencias de PHP:**
```
composer install
```
- **Configura el archivo env. y Modifica las variables del entorno**

- **Ejecuta las migraciones:** 
```
php artisan migrate 
```
- **Inicia el servidor:**
```
php artisan serve
```
