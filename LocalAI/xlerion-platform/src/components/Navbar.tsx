'use client';

import { useSession, signIn, signOut } from 'next-auth/react';
import type { ReactNode } from 'react';
import Link from 'next/link';

export default function Navbar({ menu }: { menu: ReactNode }) {
  const { data: session, status } = useSession();

  if (status === 'loading') {
    return (
      <nav style={{ display: 'flex', justifyContent: 'flex-end', padding: '1rem' }}>
        <p>Cargando...</p>
      </nav>
    );
  }

  return (
    <nav style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', padding: '1rem', background: '#f0f0f0' }}>
      {menu}
      <div>
        {session ? (
          <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
            <p>Hola, {session.user?.name}</p>
            <button onClick={() => signOut()}>Cerrar Sesión</button>
          </div>
        ) : (
          <div style={{ display: 'flex', gap: '1rem' }}>
            <Link href="/login">
              <button>Iniciar Sesión</button>
            </Link>
            <Link href="/register">
              <button>Registrarse</button>
            </Link>
          </div>
        )}
      </div>
    </nav>
  );
}