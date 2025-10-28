import { PrismaClient, UserRole } from '@prisma/client';
import bcrypt from 'bcryptjs';

const prisma = new PrismaClient();

async function main() {
  console.log('🌱 Start seeding ...');

  // 1. Crear un usuario administrador
  const hashedPassword = await bcrypt.hash('password123', 10);
  const adminUser = await prisma.user.upsert({
    where: { email: 'admin@xlerion.com' },
    update: {},
    create: {
      email: 'admin@xlerion.com',
      name: 'Admin User',
      password: hashedPassword,
      role: UserRole.ADMIN,
    },
  });
  console.log(`👤 Created admin user: ${adminUser.name} (password: password123)`);

  // 2. Crear un cliente de ejemplo
  const exampleClient = await prisma.client.upsert({
    where: { email: 'testclient@example.com' },
    update: {},
    create: {
      name: 'Test Client Inc.',
      email: 'testclient@example.com',
      company: 'Example Corp',
    },
  });
  console.log(`🏢 Created client: ${exampleClient.name}`);

  // 3. Crear un proyecto para ese cliente
  const initialProject = await prisma.project.upsert({
    where: { name: 'Initial Project' }, // Necesita un campo único para `upsert`
    update: {},
    create: {
      name: 'Initial Project',
      description: 'This is the first project seeded into the database.',
      clientId: exampleClient.id,
    },
  });
  console.log(`🚀 Created project: ${initialProject.name}`);

  console.log('✅ Seeding finished.');
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });