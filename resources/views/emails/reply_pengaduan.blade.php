<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Balasan Pengaduan</title>
</head>
<body style="background:#F0FFF4; margin:0; padding:20px; font-family:Arial,sans-serif;">
  <div style="max-width:600px; margin:auto; background:#FFFFFF; border-radius:8px; overflow:hidden;">
    
    <!-- Header -->
    <div style="background:#14532D; padding:20px; text-align:center; color:#fff;">
      <img src="{{ url('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo" style="width:50px; height:50px; border-radius:50%; margin-bottom:10px;">
      <h1 style="margin:0; font-size:24px;">Kelurahan Winduherang</h1>
    </div>
    
    <!-- Konten Utama -->
    <div style="padding:20px; color:#2D3748;">
      <p>Yth. <strong>{{ $pengaduan->nama }}</strong>,</p>
      <p>Berikut adalah balasan atas pengaduan Anda:</p>

      <!-- Isi Balasan -->
      <div style="background:#F7FAFC; border:1px solid #E2E8F0; padding:15px; border-radius:4px; margin:10px 0;">
        {!! nl2br(e($body)) !!}
      </div>

      <!-- Garis Pembatas -->
      <hr style="border:none; border-top:1px solid #E2E8F0; margin:20px 0;">

      <!-- Detail Pengaduan -->
      <h4 style="margin-bottom:5px;">📋 Detail Pengaduan Anda:</h4>
      <ul style="padding-left:20px;">
        <li><strong>RW/RT:</strong> {{ $pengaduan->rw }}/{{ $pengaduan->rt }}</li>
        <li><strong>Lokasi:</strong> {{ $pengaduan->lokasi }}</li>
        <li><strong>Waktu:</strong> {{ $pengaduan->waktu->format('d M Y H:i') }}</li>
      </ul>

      <!-- Gambar Bukti -->
      @if($pengaduan->bukti && is_array($pengaduan->bukti) && count($pengaduan->bukti))
        <h4 style="margin-top:20px; margin-bottom:10px;">📎 Bukti Terkait:</h4>
        <div style="display:flex; flex-direction:column; gap:10px;">
          @foreach($pengaduan->bukti as $bukti)
            <div style="width:100%; margin-bottom:10px;">
              <img src="{{ url('storage/' . $bukti) }}" alt="Bukti" style="width:100%; max-height:300px; object-fit:contain; border:1px solid #E2E8F0; border-radius:6px;">
            </div>
          @endforeach
        </div>
      @endif

      <!-- Penutup -->
      <p style="margin-top:20px;">Terima kasih atas partisipasi Anda.</p>
      <p>Salam,<br><strong>Tim Kelurahan Winduherang</strong></p>
    </div>

  </div>
</body>
</html>