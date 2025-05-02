{{-- resources/views/sections/age-category.blade.php --}}
<section id="kategori-umur" class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 space-y-10">
  
      <!-- Section Title -->
      <h2 class="text-3xl font-bold text-gray-800 text-center" data-aos="fade-down">
        📊 Kategori Umur
      </h2>
  
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  
        <!-- Pie Chart + Legend -->
        <div class="col-span-1 bg-white rounded-2xl shadow p-4 flex flex-col" data-aos="fade-right">
          <div class="relative h-56">
            <canvas id="agePieChart" class="absolute inset-0 w-full h-full"></canvas>
          </div>
          <div class="mt-4 text-sm">
            <h3 class="font-semibold text-gray-800 mb-1">Total Data</h3>
            <ul class="text-gray-600 space-y-0.5">
              <li>👶 Balita & Batita: <span class="font-semibold">890</span> Jiwa (<span class="text-green-600">27.3%</span>)</li>
              <li>🧒 Anak-Anak: <span class="font-semibold">642</span> Jiwa (<span class="text-blue-600">12%</span>)</li>
              <li>🧑 Remaja: <span class="font-semibold">733</span> Jiwa (<span class="text-yellow-500">18%</span>)</li>
              <li>🧔 Dewasa: <span class="font-semibold">802</span> Jiwa (<span class="text-pink-500">22.7%</span>)</li>
              <li>👵 Lansia: <span class="font-semibold">779</span> Jiwa (<span class="text-purple-600">20%</span>)</li>
              <li>👥 Kelompok: <span class="font-semibold">120</span> Jiwa (<span class="text-indigo-400">4%</span>)</li>
            </ul>
          </div>
        </div>
  
        <!-- Category Cards -->
        <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @php
            $categories = [
              ['emoji'=>'👶','label'=>'Balita & Batita','percent'=>'27.3%','color'=>'text-green-600'],
              ['emoji'=>'🧒','label'=>'Anak-Anak','percent'=>'12%','color'=>'text-blue-600'],
              ['emoji'=>'🧑','label'=>'Remaja','percent'=>'18%','color'=>'text-yellow-500'],
              ['emoji'=>'🧔','label'=>'Dewasa','percent'=>'22.7%','color'=>'text-pink-500'],
              ['emoji'=>'👵','label'=>'Lansia','percent'=>'20%','color'=>'text-purple-600'],
              ['emoji'=>'👥','label'=>'Kelompok','percent'=>'4%','color'=>'text-indigo-400'],
            ];
          @endphp
  
          @foreach($categories as $cat)
          <div class="bg-white rounded-2xl shadow p-4 flex flex-col items-center transform hover:scale-105 transition-transform duration-300"
               data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
            <span class="text-4xl mb-2">{{ $cat['emoji'] }}</span>
            <h4 class="font-semibold text-gray-800">{{ $cat['label'] }}</h4>
            <p class="mt-1 font-bold {{ $cat['color'] }}">{{ $cat['percent'] }}</p>
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
        // Initialize AOS
        AOS.init({
          once: true,
          duration: 800,
          easing: 'ease-out-cubic'
        });
  
        // Pie Chart
        const data = [890, 642, 733, 802, 779, 120];
        const labels = ['Balita & Batita','Anak-Anak','Remaja','Dewasa','Lansia','Kelompok'];
        const ctx = document.getElementById('agePieChart').getContext('2d');
  
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels,
            datasets: [{
              data,
              backgroundColor: ['#22C55E','#3B82F6','#F59E0B','#EC4899','#8B5CF6','#6366F1'],
              hoverOffset: 20,
              borderColor: '#fff',
              borderWidth: 2
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
              animateRotate: true,
              duration: 1200,
              easing: 'easeOutQuart'
            },
            plugins: {
              legend: {
                position: 'bottom',
                labels: { boxWidth: 12, padding: 12, color: '#374151', usePointStyle: true }
              },
              tooltip: {
                padding: 8,
                backgroundColor: '#fff',
                titleColor: '#111827',
                bodyColor: '#374151',
                borderColor: '#E5E7EB',
                borderWidth: 1,
                callbacks: {
                  label: ctx => {
                    const v = ctx.parsed;
                    const sum = data.reduce((a, b) => a + b, 0);
                    const pct = ((v / sum) * 100).toFixed(1);
                    return `${labels[ctx.dataIndex]}: ${v} (${pct}%)`;
                  }
                }
              }
            }
          }
        });
      });
    </script>
  </section>  