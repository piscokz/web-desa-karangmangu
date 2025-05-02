{{-- resources/views/sections/marital-category.blade.php --}}
<section id="kategori-perkawinan" class="bg-gray-50 py-12 overflow-visible">
    <div class="max-w-7xl mx-auto px-4 space-y-10">
  
      <!-- Section Title -->
      <h2 class="text-3xl font-bold text-gray-800 text-center" data-aos="fade-down">
        💍 Perkawinan
      </h2>
  
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  
        <!-- Pie Chart + Legend -->
        <div
          class="col-span-1 bg-white rounded-2xl shadow p-4 flex flex-col transform hover:scale-105 hover:shadow-xl transition duration-300"
          data-aos="fade-right" data-aos-anchor-placement="top-bottom"
        >
          <div class="relative h-56 overflow-visible">
            <canvas id="maritalPieChart" class="absolute inset-0 w-full h-full"></canvas>
          </div>
          <div class="mt-4 text-sm">
            <h3 class="font-semibold text-gray-800 mb-1">Total Data</h3>
            <ul class="text-gray-600 space-y-0.5">
              <li>👰 Belum Kawin: <span class="font-semibold">2.206</span> Jiwa (<span class="text-green-600">52%</span>)</li>
              <li>🤵 Kawin: <span class="font-semibold">1.459</span> Jiwa (<span class="text-blue-600">37%</span>)</li>
              <li>⚰️ Cerai Mati: <span class="font-semibold">261</span> Jiwa (<span class="text-pink-500">9%</span>)</li>
              <li>💔 Cerai Hidup: <span class="font-semibold">167</span> Jiwa (<span class="text-yellow-500">2%</span>)</li>
            </ul>
          </div>
        </div>
  
        <!-- Category Cards -->
        <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @php
            $maritals = [
              ['emoji'=>'👰','label'=>'Belum Kawin','percent'=>'52%','color'=>'text-green-600'],
              ['emoji'=>'🤵','label'=>'Kawin','percent'=>'37%','color'=>'text-blue-600'],
              ['emoji'=>'⚰️','label'=>'Cerai Mati','percent'=>'9%','color'=>'text-pink-500'],
              ['emoji'=>'💔','label'=>'Cerai Hidup','percent'=>'2%','color'=>'text-yellow-500'],
            ];
          @endphp
  
          @foreach($maritals as $m)
            <div
              class="bg-white rounded-2xl shadow p-4 flex flex-col items-center transform hover:scale-105 hover:shadow-lg transition duration-300"
              data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}"
            >
              <span class="text-4xl mb-2">{{ $m['emoji'] }}</span>
              <h4 class="font-semibold text-gray-800">{{ $m['label'] }}</h4>
              <p class="mt-1 font-bold {{ $m['color'] }}">{{ $m['percent'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  
    {{-- AOS & Chart.js --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Initialize animate-on-scroll
        AOS.init({ once: true, duration: 800, easing: 'ease-out-cubic' });
  
        // Pie chart data
        const data    = [2206, 1459, 261, 167];
        const labels  = ['Belum Kawin','Kawin','Cerai Mati','Cerai Hidup'];
        const colors  = ['#22C55E','#3B82F6','#EC4899','#F59E0B'];
  
        // Render Chart.js pie
        const ctx = document.getElementById('maritalPieChart').getContext('2d');
        new Chart(ctx, {
          type: 'pie',
          data: { labels, datasets: [{ data, backgroundColor: colors, hoverOffset: 20, borderColor: '#fff', borderWidth: 2 }] },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: { animateRotate: true, duration: 1200, easing: 'easeOutQuart' },
            plugins: {
              legend: { position: 'bottom', labels: { boxWidth: 12, padding: 12, color: '#374151', usePointStyle: true } },
              tooltip: {
                padding: 8,
                backgroundColor: '#fff',
                titleColor: '#111827',
                bodyColor: '#374151',
                borderColor: '#E5E7EB',
                borderWidth: 1,
                callbacks: {
                  label: ctx => {
                    const v   = ctx.parsed;
                    const sum = data.reduce((a,b)=>a+b,0);
                    const p   = ((v/sum)*100).toFixed(1);
                    return `${labels[ctx.dataIndex]}: ${v} (${p}%)`;
                  }
                }
              }
            }
          }
        });
      });
    </script>
  </section>  