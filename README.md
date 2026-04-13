# JuegAlmi - Tienda de Videojuegos Online

## 🚀 Instalación y Configuración

### Requisitos
- Apache 2.4+
- PHP 7.4+
- MySQL 5.7+ o MariaDB

### Pasos de instalación

#### 1. Copiar archivos a Apache
```bash
sudo cp -r /home/almimarcas/Downloads/juegAlmi /var/www/html/
```

#### 2. Iniciar MySQL
```bash
sudo systemctl start mysql
```

#### 3. Crear usuario MySQL
```bash
mysql -u root -p
```

Dentro de MySQL ejecuta:
```sql
CREATE USER 'admin'@'127.0.0.1' IDENTIFIED BY 'Almi123';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'127.0.0.1';
FLUSH PRIVILEGES;
EXIT;
```

#### 4. Acceder a la aplicación
Abre en tu navegador:
```
http://localhost/juegAlmi/
```

La base de datos se creará automáticamente en el primer acceso.

---

## 📋 Características

### ✅ Implementadas
- **Portada**: Muestra categorías y juegos con filtro expandible
- **Menú dinámico**: Carga categorías desde BD
- **Registro de usuarios**: Con email obligatorio y validación
- **Login**: Con contraseñas hasheadas
- **Gestión de juegos**: Solo accesible para usuarios logueados
- **Página de detalles**: Información completa de cada juego
- **Recomendaciones**: Tabla con todos los juegos
- **Géneros**: Filtrado de juegos por categoría
- **Efecto especial**: Pulsar "a" tres veces pone el menú rojo

### 🔐 Seguridad
- Contraseñas hasheadas con `password_hash()`
- Prepared Statements contra SQL injection
- Validación de email con `filter_var()`
- Escapado de datos sensibles con `htmlspecialchars()`

---

## 📊 Estructura de BD

### Tabla: Usuario
```
id_usuario (int, PK)
nombre (varchar)
usuario (varchar, UNIQUE)
password (varchar)
email (varchar, UNIQUE)
```

### Tabla: Categoria
```
id_categoria (int, PK)
nombre (varchar)
```

### Tabla: Juego
```
id_juego (int, PK)
titulo (varchar)
descripcion (text)
precio (decimal)
imagen (varchar)
enlace (varchar)
id_categoria (int, FK)
```

---

## 🔧 Configuración

### Credenciales MySQL
- Usuario: `admin`
- Contraseña: `Almi123`
- Base de datos: `juegalmi`
- Host: `127.0.0.1`

Estos valores están en `bbdd.php`. Para cambiarlos, edita la función `conectarBBDD()`.

---

## 🧪 Datos de Prueba

La BD se populate automáticamente con:
- **Categorías**: Acción, Aventura, Estrategia, Puzzle
- **Juegos**: Super Shooter, Mundo Mágico, Commander Pro
- **Usuario de prueba**: admin/secret123

Para crear más usuarios, usa la página de registro.

---

## 📝 Archivos Principales

```
juegAlmi/
├── index.php           # Portada con categorías
├── registro.php        # Formulario de registro
├── login.php           # Formulario de login
├── iniciarSesion.php   # Procesa login
├── insertarUsuario.php # Procesa registro
├── detalles.php        # Detalle del juego
├── generos.php         # Juegos por categoría
├── recomendaciones.php # Tabla de todos los juegos
├── gestionJuegos.php   # Panel de admin
├── menu.php            # Menú navegable
├── bbdd.php            # Funciones BD
├── init_db.php         # Inicializa BD automáticamente
├── cerrarSesion.php    # Cierra sesión
├── css/                # Estilos
├── js/                 # Scripts JavaScript
└── images/             # Imágenes
```

---

## 🚨 Solución de problemas

### "Página azul vacía"
- Verifica que MySQL está corriendo: `sudo systemctl start mysql`
- Comprueba credenciales en `bbdd.php`

### "ERROR de conexión"
- Asegúrate de que el usuario `admin` existe en MySQL
- Verifica el archivo `/var/www/html/juegAlmi/.db_initialized`

### "Archivos no encontrados (404)"
- Usa `http://localhost/juegAlmi/` en la URL
- No uses rutas como `~/Downloads/juegAlmi`

---

## 📞 Soporte

Si algo no funciona:
1. Revisa el log de Apache: `/var/log/apache2/error.log`
2. Comprueba que los permisos de carpeta son 755
3. Verifica que PHP tiene módulo `mysqli` instalado

