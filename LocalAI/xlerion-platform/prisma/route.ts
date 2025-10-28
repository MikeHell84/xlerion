import { NextResponse } from 'next/server';
import { prisma } from '@/lib/prisma';
import { transporter, mailOptions } from '@/lib/nodemailer';
import crypto from 'crypto';

export async function POST(request: Request) {
  try {
    const { email } = await request.json();

    const user = await prisma.user.findUnique({ where: { email } });

    // Por seguridad, no revelamos si el email existe o no.
    if (!user) {
      return new NextResponse('If this email is registered, a password reset link has been sent.', { status: 200 });
    }

    // Generar un token seguro
    const token = crypto.randomBytes(32).toString('hex');
    const expires = new Date(new Date().getTime() + 60 * 60 * 1000); // Expira en 1 hora

    await prisma.passwordResetToken.create({
      data: {
        email,
        token,
        expires,
      },
    });

    const resetLink = `${process.env.NEXTAUTH_URL}/password/reset?token=${token}`;

    // Enviar el email
    await transporter.sendMail({
      ...mailOptions,
      to: email,
      subject: 'Restablecimiento de contraseña',
      html: `<p>Hola ${user.name},</p><p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p><a href="${resetLink}">Restablecer contraseña</a><p>Este enlace expirará en 1 hora.</p>`,
    });

    return new NextResponse('If this email is registered, a password reset link has been sent.', { status: 200 });

  } catch (error) {
    console.error('FORGOT_PASSWORD_ERROR', error);
    return new NextResponse('Internal Server Error', { status: 500 });
  }
}
