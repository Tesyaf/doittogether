<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan Tim DoItTogether</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fb;font-family:'Inter',Arial,sans-serif;color:#0f172a;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#0f172a;padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 12px 35px rgba(15,23,42,0.12);">
                    <tr>
                        <td style="background:linear-gradient(135deg,#0ea5e9,#2563eb);padding:24px 32px;color:#e0f2fe;">
                            <div style="font-size:14px;letter-spacing:0.08em;text-transform:uppercase;">DoItTogether</div>
                            <div style="font-size:22px;font-weight:700;color:#ffffff;margin-top:4px;">Undangan Bergabung</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 32px;">
                            <p style="margin:0 0 12px;font-size:16px;color:#0f172a;">Halo,</p>
                            <p style="margin:0 0 16px;font-size:16px;color:#0f172a;line-height:1.6;">
                                {{ $inviterName }} mengundang Anda untuk bergabung ke tim
                                <strong>{{ $team->name }}</strong> sebagai
                                <strong>{{ ucfirst($invitation->role) }}</strong>.
                            </p>

                            <div style="margin:16px 0;padding:16px;border:1px dashed #0ea5e9;border-radius:12px;background:#f0f9ff;color:#0f172a;text-align:center;">
                                <div style="font-size:13px;text-transform:uppercase;letter-spacing:0.08em;color:#0284c7;">Kode Undangan</div>
                                <div style="margin-top:6px;font-size:20px;font-weight:700;letter-spacing:0.08em;color:#0f172a;">
                                    {{ $invitation->code }}
                                </div>
                            </div>

                            <p style="margin:0 0 20px;font-size:15px;color:#0f172a;line-height:1.6;">
                                Masuk ke DoItTogether, lalu masukkan kode di halaman join/konfirmasi untuk mulai berkolaborasi.
                            </p>

                            @if($invitation->expires_at)
                                <p style="margin:0 0 16px;font-size:14px;color:#334155;">
                                    Kedaluwarsa: <strong>{{ $invitation->expires_at->toDayDateTimeString() }}</strong>
                                </p>
                            @endif

                            <table role="presentation" cellspacing="0" cellpadding="0" style="margin:0 0 8px;">
                                <tr>
                                    <td>
                                        <a href="{{ url('/login') }}" style="background:#2563eb;color:#ffffff;text-decoration:none;padding:12px 20px;border-radius:10px;font-weight:600;font-size:15px;display:inline-block;">
                                            Masuk ke DoItTogether
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:8px;"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ url('/teams/join?code=' . $invitation->code) }}" style="background:#0ea5e9;color:#ffffff;text-decoration:none;padding:12px 20px;border-radius:10px;font-weight:600;font-size:15px;display:inline-block;">
                                            Buka Halaman Join
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:20px 0 0;font-size:13px;color:#64748b;line-height:1.5;">
                                Jika Anda tidak meminta undangan ini, abaikan saja email ini.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f8fafc;padding:16px 32px;color:#94a3b8;font-size:12px;text-align:center;">
                            © {{ date('Y') }} DoItTogether. Tetap produktif, bersama.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
