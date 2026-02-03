# Roadmap — Modelado 3D (Personajes y Assets)

Service: Modelado 3D
Sprint duration: 2 semanas (3 semanas recomendado si pipeline incluye muchas revisiones)
Project types: Single asset, Pack de personajes, Set completo con rigging/animaciones

## Cómo leer este roadmap

- Cada sprint incluye entregables artísticos y criterios de aceptación (polys, UVs, texturas, LODs).

---

## Pack de personajes mediano (ejemplo: 4 sprints de 2 semanas)

Sprint 1 — Concept & Blockout

- Objetivos: Concept art y blockouts 3D para 3 personajes.
- Entregables: Concept aprobados, blockouts en ZBrush/Blender.
- Aceptación: 1 dirección aprobada por personaje (máx. 2 rondas de feedback).

Sprint 2 — High Poly & Retopo

- Objetivos: Sculpt high poly; generar retopology para producción.
- Entregables: High poly + retopo por personaje.
- Aceptación: Topology aprobada, polycount objetivo alcanzado según plataforma.

Sprint 3 — UVs y Texturizado

- Objetivos: Unwrap, bake maps, PBR textures.
- Entregables: Albedo, Normal, Roughness, AO maps.
- Aceptación: Texturas validadas en engine (ex: Unity/Unreal) con calidad esperada.

Sprint 4 — Rigging / LODs / Export

- Objetivos: Rigging básico, LOD generation, export final.
- Entregables: FBX/GLB optimizados, LODs, guía de integración.
- Aceptación: Asset probado en target engine sin errores y dentro de budget de performance.

---

## Variables de esfuerzo

- Complejidad geométrica: High poly → +0.5–1 sprint por personaje complejo.
- Animaciones: +0.5–1 sprint por set de animaciones por personaje.
- Rounds de feedback: +0.5 sprint por cada 2 rondas adicionales.
- LODs/Platforms target: +0.5 sprint si se requieren múltiples LODs y formatos.

## Notas

- Definir polycounts y target engine desde inicio.
- Usar un pipeline de revisión claro (JIRA/Asana) con checkpoints de aprobación.
