# Cómo Usar el Checkpoint del Tema Nova UI Solar

Este documento explica cómo utilizar el checkpoint del tema Nova UI Solar creado en abril de 2025.

## Opciones para Restaurar a este Checkpoint

### Opción 1: Usar la rama de checkpoint en GitHub

La forma más sencilla de acceder a esta versión estable del tema es usando la rama específica creada para el checkpoint:

1. Ve al repositorio en GitHub: [https://github.com/StrykerUX/Nova-UI-Solar-Theme](https://github.com/StrykerUX/Nova-UI-Solar-Theme)
2. Cambia a la rama `checkpoint-abril-2025` usando el selector de ramas
3. Descarga el ZIP completo usando el botón "Code > Download ZIP"
4. Instala este ZIP como un tema en WordPress

### Opción 2: Clonar el repositorio con Git

Si prefieres usar Git:

```bash
# Clonar el repositorio
git clone https://github.com/StrykerUX/Nova-UI-Solar-Theme.git

# Entrar al directorio
cd Nova-UI-Solar-Theme

# Cambiar a la rama del checkpoint
git checkout checkpoint-abril-2025
```

### Opción 3: Crear una nueva rama desde el checkpoint

Si quieres realizar modificaciones partiendo del checkpoint:

```bash
# Clonar el repositorio si aún no lo has hecho
git clone https://github.com/StrykerUX/Nova-UI-Solar-Theme.git
cd Nova-UI-Solar-Theme

# Cambiar a la rama del checkpoint
git checkout checkpoint-abril-2025

# Crear una nueva rama para tus cambios
git checkout -b mi-nueva-caracteristica
```

## Contenido del Checkpoint

El checkpoint incluye:

- Estructura completa del tema WordPress
- Estilo Soft Neo-Brutalism implementado
- Plantilla de Dashboard funcional
- Sistema de cambio de temas claro/oscuro
- Estructura base para implementar múltiples estilos visuales

Para más detalles sobre el estado del tema en este checkpoint, revisa el archivo `CHECKPOINT-ABRIL-2025.md` incluido en la rama.

## Razones para Usar el Checkpoint

Puedes volver a este checkpoint si:

1. Las nuevas funcionalidades han introducido errores críticos
2. Necesitas comparar el comportamiento actual con la versión estable
3. Quieres iniciar una nueva rama de desarrollo desde un punto conocido y estable
4. El tema actual ha sufrido modificaciones incompatibles con tus necesidades

## Notas Adicionales

- Esta versión del tema ha sido verificada y funciona correctamente con WordPress 6.4
- No requiere compilación ni herramientas de build adicionales
- Es compatible con plugins estándar de WordPress
- Contiene solo un estilo visual (Soft Neo-Brutalism), los otros están pendientes de implementar
