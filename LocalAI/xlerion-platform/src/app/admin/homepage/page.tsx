import { prisma } from '@/lib/prisma';
import { revalidatePath } from 'next/cache';

async function getHomepageSections() {
  const sections = await prisma.homepageSection.findMany({
    orderBy: { order: 'asc' },
  });
  return sections;
}

async function addSection(formData: FormData) {
  'use server';

  const title = formData.get('title') as string;
  const type = formData.get('type') as string;

  if (!title || !type) {
    return;
  }

  // Obtenemos el orden más alto para añadir la nueva sección al final
  const lastSection = await prisma.homepageSection.findFirst({
    orderBy: { order: 'desc' },
  });

  const newOrder = lastSection ? lastSection.order + 1 : 0;

  await prisma.homepageSection.create({
    data: {
      title,
      type,
      order: newOrder,
    },
  });

  // Invalidamos la cache de esta ruta para que se vuelva a cargar con los nuevos datos
  revalidatePath('/admin/homepage');
}

export default async function ManageHomepage() {
  const sections = await getHomepageSections();

  return (
    <div style={{ padding: '2rem' }}>
      <h1 style={{ fontSize: '2rem', fontWeight: 'bold', marginBottom: '2rem' }}>
        Gestionar Página Principal
      </h1>

      <div style={{ display: 'grid', gridTemplateColumns: '2fr 1fr', gap: '2rem' }}>
        <div>
          <h2 style={{ fontSize: '1.5rem', fontWeight: '600', marginBottom: '1rem' }}>
            Secciones Actuales
          </h2>
          <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
            {sections.map((section) => (
              <div key={section.id} style={{ border: '1px solid #ccc', padding: '1rem', borderRadius: '0.5rem' }}>
                <p><strong>Título:</strong> {section.title}</p>
                <p><strong>Tipo:</strong> {section.type}</p>
                <p><strong>Orden:</strong> {section.order}</p>
              </div>
            ))}
            {sections.length === 0 && <p>Aún no hay secciones. ¡Añade una!</p>}
          </div>
        </div>

        <div>
          <h2 style={{ fontSize: '1.5rem', fontWeight: '600', marginBottom: '1rem' }}>
            Añadir Nueva Sección
          </h2>
          <form action={addSection} style={{ display: 'flex', flexDirection: 'column', gap: '1rem', border: '1px solid #eee', padding: '1.5rem', borderRadius: '0.5rem' }}>
            <div>
              <label htmlFor="title" style={{ display: 'block', marginBottom: '0.5rem' }}>Título de la sección</label>
              <input type="text" id="title" name="title" required style={{ width: '100%', padding: '0.5rem' }} />
            </div>
            <div>
              <label htmlFor="type" style={{ display: 'block', marginBottom: '0.5rem' }}>Tipo de sección</label>
              <select id="type" name="type" required style={{ width: '100%', padding: '0.5rem' }}>
                <option value="">Selecciona un tipo</option>
                <option value="hero">Hero</option>
                <option value="featuredPosts">Posts Destacados</option>
                <option value="callToAction">Llamada a la Acción</option>
                <option value="markdown">Contenido Markdown</option>
              </select>
            </div>
            <button type="submit" style={{ padding: '0.75rem', background: '#0070f3', color: 'white', border: 'none', borderRadius: '0.25rem', cursor: 'pointer' }}>
              Añadir Sección
            </button>
          </form>
        </div>
      </div>
    </div>
  );
}
