# Sistema de Animaciones Three.js

Este directorio contiene todos los archivos JavaScript para las animaciones Three.js del portafolio.

## Estructura de Archivos

```
public/js/
├── main.js                    # Archivo principal que coordina todas las animaciones
└── threejs/
    ├── hero-animation.js      # Animación del hero con partículas que forman texto
    ├── skills-animation.js    # Animación de la sección de habilidades
    ├── projects-animation.js  # Animación de la sección de proyectos
    ├── experience-animation.js # Animación de la sección de experiencia
    └── cta-animation.js       # Animación de la sección de llamada a la acción
```

## Descripción de Archivos

### `main.js`
- **Clase principal**: `AdvancedThreeJSAnimationSystem`
- **Función**: Coordina todas las animaciones y maneja eventos globales
- **Responsabilidades**:
  - Manejo del mouse y eventos de ventana
  - Loop principal de animación
  - Inicialización de todos los sistemas

### `hero-animation.js`
- **Clase**: `HeroAnimationSystem`
- **Función**: Animación de partículas que forman el texto "ORIVASDEV"
- **Características**:
  - Partículas que forman texto inicialmente
  - Transición a dispersión orgánica
  - Reacción al movimiento del mouse
  - Control de visibilidad del contenido del hero

### `skills-animation.js`
- **Clase**: `SkillsAnimationSystem`
- **Función**: Elementos flotantes para la sección de habilidades
- **Características**:
  - Octaedros flotantes
  - Rotación y movimiento suave
  - Efectos de flotación

### `projects-animation.js`
- **Clase**: `ProjectsAnimationSystem`
- **Función**: Líneas conectivas para la sección de proyectos
- **Características**:
  - Líneas animadas
  - Movimiento ondulatorio
  - Efectos de conexión

### `experience-animation.js`
- **Clase**: `ExperienceAnimationSystem`
- **Función**: Partículas de experiencia con efectos de pulso
- **Características**:
  - Partículas con colores dinámicos
  - Efectos de onda
  - Pulsación de colores

### `cta-animation.js`
- **Clase**: `CTAAnimationSystem`
- **Función**: Esferas flotantes para la sección de llamada a la acción
- **Características**:
  - Esferas blancas translúcidas
  - Rotación y movimiento
  - Efectos de flotación

## Uso

Los archivos se cargan automáticamente en el layout principal (`layouts/app.blade.php`) y se inicializan solo en la página de inicio.

## Dependencias

- **Three.js**: Librería principal para gráficos 3D
- **WebGL**: Renderizado de gráficos acelerado por hardware

## Características Técnicas

- **Shaders personalizados**: Para efectos avanzados de partículas
- **Animaciones suaves**: Con funciones de easing
- **Responsive**: Se adapta al tamaño de la ventana
- **Optimizado**: Renderizado eficiente con requestAnimationFrame
- **Modular**: Cada animación en su propio archivo
