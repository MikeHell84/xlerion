import { prisma } from '@/lib/prisma';
import type { Post, HomepageSection } from '@prisma/client';

// --- Tipos de Datos Enriquecidos ---
type SectionWithPosts = HomepageSection & { posts?: Post[] };

// --- Componentes de Sección Dinámicos (Ahora síncronos donde sea posible) ---

function HeroSection({ section }: { section: SectionWithPosts }) {
  return (
    <div style={{ padding: '4rem 2rem', background: '#f0f0f0', textAlign: 'center' }}>
      <h1 style={{ fontSize: '3rem', fontWeight: 'bold' }}>{section.title}</h1>
    </div>
  );
}

// Convertido a un componente síncrono. Recibe los posts como prop.
function FeaturedPostsSection({ section }: { section: SectionWithPosts }) {
  return (
    <div style={{ padding: '2rem' }}>
      <h2 style={{ fontSize: '2rem', fontWeight: 'bold', marginBottom: '1.5rem' }}>{section.title}</h2>
      <div>
        {section.posts?.map((post) => (
          <div key={post.id} style={{ border: '1px solid #eee', padding: '1rem', marginBottom: '1rem' }}>
            <h3>{post.title}</h3>
            {/* Si necesitas el autor, tendrás que incluirlo en la consulta de la página principal */}
          </div>
        ))}
      </div>
    </div>
  );
}

function CallToActionSection({ section }: { section: SectionWithPosts }) {
  return (
    <div style={{ padding: '3rem 2rem', background: '#0070f3', color: 'white', textAlign: 'center' }}>
      <h2 style={{ fontSize: '2rem', fontWeight: 'bold' }}>{section.title}</h2>
    </div>
  );
}

function MarkdownSection({ section }: { section: SectionWithPosts }) {
    const content = section.content as { text?: string } | undefined;
    return (
      <div style={{ padding: '2rem', lineHeight: '1.6' }}>
        <h2 style={{ fontSize: '2rem', fontWeight: 'bold', marginBottom: '1rem' }}>{section.title}</h2>
        <p>{content?.text ?? 'Contenido no definido.'}</p>
      </div>
    );
}

const sectionComponents: Record<string, React.ComponentType<{ section: SectionWithPosts }>> = {
  hero: HeroSection,
  featuredPosts: FeaturedPostsSection,
  callToAction: CallToActionSection,
  markdown: MarkdownSection,
};

// --- Página Principal (con obtención de datos centralizada) ---

export default async function HomePage() {
  const sectionConfigs = await prisma.homepageSection.findMany({
    orderBy: { order: 'asc' },
  });

  // Pre-cargamos los datos para las secciones que lo necesiten
  const sections: SectionWithPosts[] = await Promise.all(
    sectionConfigs.map(async (section) => {
      if (section.type === 'featuredPosts') {
        const posts = await prisma.post.findMany({
          where: { published: true },
          orderBy: { createdAt: 'desc' },
          take: 3,
        });
        return { ...section, posts };
      }
      return section;
    })
  );

  return (
    <main>
      {sections.map((section) => {
        const SectionComponent = sectionComponents[section.type];
        return SectionComponent ? <SectionComponent key={section.id} section={section} /> : null;
      })}

      {sections.length === 0 && (
        <div style={{ padding: '4rem 2rem', textAlign: 'center' }}>
          <h1 style={{ fontSize: '2rem' }}>Bienvenido</h1>
          <p>Aún no se ha definido ninguna sección para la página principal.</p>
          <p>Ve al <a href="/admin/homepage" style={{ color: 'blue' }}>panel de administración</a> para empezar a construirla.</p>
        </div>
      )}
    </main>
  );
}