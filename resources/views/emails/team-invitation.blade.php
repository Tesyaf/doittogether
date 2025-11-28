<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan Tim</title>
</head>
<body style="font-family: Arial, sans-serif; color:#0f172a;">
    <h2>Halo,</h2>
    <p>{{ $inviterName }} mengundang Anda bergabung ke tim <strong>{{ $team->name }}</strong> sebagai <strong>{{ $invitation->role }}</strong>.</p>

    <p>Kode undangan Anda:</p>
    <div style="padding:12px 16px;border:1px dashed #0ea5e9;display:inline-block;border-radius:8px;font-size:16px;">
        {{ $invitation->code }}
    </div>

    @if($invitation->expires_at)
        <p style="margin-top:12px;">Undangan berlaku sampai: <strong>{{ $invitation->expires_at->toDayDateTimeString() }}</strong></p>
    @endif

    <p style="margin-top:16px;">Silakan login ke aplikasi, lalu masukkan kode undangan untuk bergabung.</p>

    <p>Jika Anda tidak merasa meminta undangan ini, abaikan email ini.</p>

    <p style="margin-top:24px;">Terima kasih,<br>Tim DoIt Together</p>
</body>
</html>
