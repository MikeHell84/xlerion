import { auth } from "@/app/api/auth/[...auth]/route";
import Link from "next/link";

export default async function DashboardPage() {
  const session = await auth();

  return (
    <div>
      <h1 className="text-3xl font-bold">Dashboard</h1>
      <p className="mt-4">Bienvenido a tu dashboard, {session?.user?.name}.</p>

      <div className="mt-8">
        <h2 className="text-2xl font-semibold">Acciones Rápidas</h2>
        <div className="mt-4 p-4 border rounded-lg bg-gray-50">
          <Link href="/admin/homepage" className="text-blue-600 hover:underline">
            Gestionar la Página Principal
          </Link>
          <p className="text-sm text-gray-600 mt-1">Añade, elimina o reordena las secciones de la página de inicio.</p>
        </div>
      </div>

      <div className="mt-6 p-4 border rounded-lg bg-gray-50">
        <h2 className="text-xl font-semibold">Información de la sesión:</h2>
        <pre className="mt-2 p-2 bg-gray-100 rounded text-sm overflow-x-auto">
          {JSON.stringify(session, null, 2)}
        </pre>
      </div>
    </div>
  );
}
