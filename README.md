# 📸 Codegram - Clon de Instagram

Un clon completo de Instagram desarrollado con **Laravel 12**, que replica las funcionalidades principales de la red social más popular de fotografías.

## 🌟 Características Principales

- 📝 **Registro y Autenticación de Usuarios**
- 📸 **Subida y Gestión de Imágenes** con procesamiento automático
- 💬 **Sistema de Comentarios** en tiempo real
- ❤️ **Sistema de Likes** interactivo
- 👤 **Perfiles de Usuario** personalizables
- 📱 **Diseño Responsivo** para todos los dispositivos
- ⚡ **Interacciones en Tiempo Real** con Livewire

## 🛠️ Stack Tecnológico

### Backend
- **PHP**
- **Laravel 12** - Framework PHP moderno
- **MySQL** - Base de datos relacional
- **Intervention Image** - Procesamiento y optimización de imágenes

### Frontend
- **Tailwind CSS** - Framework CSS utility-first
- **Livewire** - Componentes reactivos full-stack
- **Dropzone.js** - Drag & drop file uploads

## 📋 Requisitos del Sistema

- PHP >= 8.2
- Composer
- Node.js >= 16.x
- MySQL >= 8.0
- Intervention Image
- Dropzone

## 🚀 Instalación

### 1. Clonar el Repositorio
```bash
git clone https://github.com/hectorgm26/codegram-laravel.git
cd codegram-laravel
```

### 2. Instalar Dependencias PHP
```bash
composer install
```

### 3. Instalar Dependencias JavaScript
```bash
npm install
```

### 4. Configuración del Entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar Base de Datos
Edita el archivo `.env` con tus credenciales de base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=codegram
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 6. Ejecutar Migraciones
```bash
php artisan migrate
```

### 7. Crear Enlace Simbólico para Storage
```bash
php artisan storage:link
```

### 8. Compilar Assets
```bash
npm run dev
# o para producción
npm run build
```

### 9. Iniciar el Servidor
```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## 📱 Funcionalidades Detalladas

### 🔐 Sistema de Autenticación
- Registro de nuevos usuarios con validación
- Login/Logout seguro
- Verificación de email

### 📸 Gestión de Imágenes
- **Subida por Drag & Drop** con Dropzone.js
- **Redimensionamiento automático** usando Intervention Image
- **Múltiples formatos** soportados (JPEG, PNG, WebP)

### 👤 Perfiles de Usuario
- Edición de información personal
- Foto de perfil personalizable
- Biografía
- Estadísticas de posts y seguidores

### 📝 Sistema de Posts
- Creación de posts con imagen y descripción
- Edición y eliminación de posts propios
- Visualización en timeline
- Ordenamiento cronológico

### 💬 Interacciones Sociales
- **Likes en tiempo real** con Livewire
- **Sistema de comentarios** anidados

## 📊 Base de Datos

### Tablas Principales

#### `users`
- Información de usuarios
- Perfiles y configuraciones
- Timestamps de actividad

#### `posts`
- Contenido de publicaciones
- Referencias a imágenes
- Metadatos de posts

#### `comments`
- Sistema de comentarios
- Relaciones jerárquicas
- Moderación de contenido

#### `likes`
- Registro de likes
- Prevención de duplicados
- Estadísticas de interacciones

## Componentes UI Reutilizables
- Botones con estados hover/active
- Cards con sombras y bordes redondeados
- Formularios con validación visual

## 🔒 Seguridad

- **Validación CSRF** en todos los formularios
- **Sanitización** de inputs de usuario
- **Validación de archivos** subidos

## 📈 Optimizaciones de Performance

- **Optimización de imágenes** automática
- **Paginación** eficiente

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver `LICENSE` para más detalles.

## 👨‍💻 Autor

**Héctor González** - [@hectorgm26](https://github.com/hectorgm26)

---

⭐ Si este proyecto te ha sido útil, ¡considera darle una estrella en GitHub!

---

*Desarrollado con ❤️ y Laravel*
