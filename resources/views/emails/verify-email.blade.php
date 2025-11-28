<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email — DoItTogether</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fb;font-family:'Inter',Arial,sans-serif;color:#0f172a;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#0f172a;padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 12px 35px rgba(15,23,42,0.12);">
                    <tr>
                        <td style="background:linear-gradient(135deg,#0ea5e9,#2563eb);padding:24px 32px;color:#e0f2fe;">
                            <div style="font-size:14px;letter-spacing:0.08em;text-transform:uppercase;">DoItTogether</div>
                            <div style="font-size:22px;font-weight:700;color:#ffffff;margin-top:4px;">Verifikasi Email</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 32px;">
                            <p style="margin:0 0 12px;font-size:16px;color:#0f172a;">Halo {{ $user->name }},</p>
                            <p style="margin:0 0 16px;font-size:16px;color:#0f172a;line-height:1.6;">
                                Terima kasih sudah bergabung dengan DoItTogether. Klik tombol di bawah untuk memverifikasi email Anda.
                            </p>

                            <table role="presentation" cellspacing="0" cellpadding="0" style="margin:12px 0 20px;">
                                <tr>
                                    <td>
                                        <a href="{{ $url }}" style="background:#2563eb;color:#ffffff;text-decoration:none;padding:12px 20px;border-radius:10px;font-weight:600;font-size:15px;display:inline-block;">
                                            Verifikasi Email
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 16px;font-size:14px;color:#334155;line-height:1.6;">
                                Jika tombol tidak bisa diklik, gunakan tautan berikut:<br>
                                <a href="{{ $url }}" style="color:#2563eb;text-decoration:none;word-break:break-all;">{{ $url }}</a>
                            </p>

                            <p style="margin:0 0 0;font-size:13px;color:#64748b;line-height:1.5;">
                                Jika Anda tidak merasa membuat akun, abaikan email ini.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f8fafc;padding:16px 32px;color:#94a3b8;font-size:12px;text-align:center;">
                            © {{ date('Y') }} DoItTogether. Kolaborasi lebih mudah.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
