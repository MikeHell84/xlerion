
import Link from 'next/link';

// Simulamos los datos que vendrían del backend o CMS
const menuItems = [
  { id: '1', title: 'Inicio', href: '/' },
  { id: '2', title: 'Acerca de', href: '/about' },
  { id: '3', title: 'Servicios', href: '/services' },
  { id: '4', title: 'Contacto', href: '/contact' },
];

// Este es un Server Component, que puede obtener datos del backend
async function getMenuItems() {
  // En un futuro, aquí harías la llamada a tu API o base de datos
  // Por ejemplo: const items = await fetch('https://my-cms.com/api/menu').then(res => res.json());
  // Por ahora, devolvemos los datos simulados.
  return menuItems;
}

export default async function Menu() {
  const items = await getMenuItems();

  return (
    <div style={{ display: 'flex', gap: '1rem' }}>
      {items.map((item) => (
        <Link key={item.id} href={item.href}>
          {item.title}
        </Link>
      ))}
    </div>
  );
}
