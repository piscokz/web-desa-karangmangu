{{-- resources/views/emails/new_pengaduan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaduan Baru</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; color: #1f4f24; padding: 20px;">

    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); padding: 24px; border-left: 8px solid #f0c000;">
        <h2 style="color: #1f4f24; border-bottom: 2px solid #eeeeee; padding-bottom: 8px;">📩 Pengaduan Baru dari <span style="color: #f0c000;">{{ $c->nama }}</span></h2>

        <ul style="list-style-type: none; padding: 0; margin: 16px 0;">
            <li><strong>👥 RW/RT:</strong> RW {{ $c->rw }} / RT {{ $c->rt }}</li>
            <li><strong>📅 Waktu:</strong> {{ $c->waktu->format('d M Y H:i') }}</li>
            <li><strong>📍 Lokasi:</strong> {{ $c->lokasi }}</li>
        </ul>

        <div style="margin-top: 16px;">
            <p><strong>📝 Deskripsi Masalah:</strong></p>
            <p style="background-color: #f0f9f0; padding: 12px; border-radius: 8px; border-left: 4px solid #1f4f24;">
                {!! nl2br(e($c->deskripsi)) !!}
            </p>
        </div>

        @if($c->bukti)
            <div style="margin-top: 20px;">
                <p><strong>📎 Bukti Terlampir:</strong></p>
                <ul>
                    @foreach($c->bukti as $img)
                        <li>
                            <a href="{{ asset('storage/'.$img) }}" style="color: #1f4f24; text-decoration: underline;">
                                {{ $img }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="margin-top: 30px; text-align: center;">
            <p style="font-size: 14px; color: #888;">Email ini dikirim otomatis dari sistem pengaduan warga Winduherang.</p>
        </div>
    </div>

</body>
</html>