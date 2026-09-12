<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\ServiceStatusHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Account
        $admin = User::create([
            'name' => 'Super Admin AnyFix',
            'email' => 'admin@anyfix.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081299990001',
            'is_active' => true,
        ]);

        // 2. Technician Accounts
        $techBudi = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.technician@anyfix.com',
            'password' => Hash::make('password123'),
            'role' => 'technician',
            'phone' => '081288880001',
            'bio' => 'Spesialis perbaikan hardware laptop & penggantian LCD smartphone berpengalaman 6 tahun.',
            'experience_years' => 6,
            'service_area' => 'Jakarta Selatan & Tangerang Selatan',
            'is_available' => true,
            'is_active' => true,
            'rating' => 4.90,
        ]);

        $techEko = User::create([
            'name' => 'Eko Prasetyo',
            'email' => 'eko.technician@anyfix.com',
            'password' => Hash::make('password123'),
            'role' => 'technician',
            'phone' => '081288880002',
            'bio' => 'Ahli perakitan PC, troubleshooting jaringan perkantoran, dan perbaikan display TV LED/OLED.',
            'experience_years' => 8,
            'service_area' => 'Jakarta Barat & Jakarta Pusat',
            'is_available' => true,
            'is_active' => true,
            'rating' => 4.85,
        ]);

        $techHendra = User::create([
            'name' => 'Hendra Wijaya',
            'email' => 'hendra.technician@anyfix.com',
            'password' => Hash::make('password123'),
            'role' => 'technician',
            'phone' => '081288880003',
            'bio' => 'Teknisi printer, peralatan rumah tangga cerdas, serta recovery data dan instalasi software.',
            'experience_years' => 5,
            'service_area' => 'Jakarta Timur & Bekasi Barat',
            'is_available' => true,
            'is_active' => true,
            'rating' => 4.75,
        ]);

        // 3. Customer Accounts
        $customers = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi.customer@anyfix.com',
                'phone' => '081377770001',
                'address' => 'Jl. Tebet Barat Dalam No. 15, RT 02/03',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12810',
            ],
            [
                'name' => 'Siti Rahma',
                'email' => 'siti.customer@anyfix.com',
                'phone' => '081377770002',
                'address' => 'Apartemen Sudirman Park Tower B Lt. 12',
                'city' => 'Jakarta Pusat',
                'postal_code' => '10220',
            ],
            [
                'name' => 'Dian Kusuma',
                'email' => 'dian.customer@anyfix.com',
                'phone' => '081377770003',
                'address' => 'Perumahan Bintaro Jaya Sektor 7 Blok A5',
                'city' => 'Tangerang Selatan',
                'postal_code' => '15224',
            ],
            [
                'name' => 'Reza Firmansyah',
                'email' => 'reza.customer@anyfix.com',
                'phone' => '081377770004',
                'address' => 'Jl. Kebon Jeruk Raya No. 44',
                'city' => 'Jakarta Barat',
                'postal_code' => '11530',
            ],
            [
                'name' => 'Maya Anggraini',
                'email' => 'maya.customer@anyfix.com',
                'phone' => '081377770005',
                'address' => 'Jl. Pemuda No. 88, Rawamangun',
                'city' => 'Jakarta Timur',
                'postal_code' => '13220',
            ],
        ];

        $customerModels = [];
        foreach ($customers as $c) {
            $cust = User::create([
                'name' => $c['name'],
                'email' => $c['email'],
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => $c['phone'],
                'is_active' => true,
            ]);

            Address::create([
                'user_id' => $cust->id,
                'label' => 'Rumah Utama',
                'recipient_name' => $c['name'],
                'phone' => $c['phone'],
                'address' => $c['address'],
                'city' => $c['city'],
                'postal_code' => $c['postal_code'],
                'is_default' => true,
            ]);

            $customerModels[] = $cust;
        }

        // 4. Categories
        $categoriesData = [
            [
                'name' => 'Smartphone & Tablet',
                'slug' => 'smartphone-tablet',
                'icon' => '📱',
                'description' => 'Ganti layar LCD, baterai kembung, port charging rusak, dan perbaikan tombol.',
            ],
            [
                'name' => 'Laptop',
                'slug' => 'laptop',
                'icon' => '💻',
                'description' => 'Layar bergaris, keyboard error, ganti baterai, thermal paste, dan upgrade SSD/RAM.',
            ],
            [
                'name' => 'Komputer & PC Desktop',
                'slug' => 'komputer-pc',
                'icon' => '🖥️',
                'description' => 'Perakitan PC, diagnosa mati total, perbaikan power supply, dan upgrade kartu grafis.',
            ],
            [
                'name' => 'Televisi & Audio',
                'slug' => 'tv-audio',
                'icon' => '📺',
                'description' => 'Perbaikan Smart TV LED/OLED suara ada gambar hilang, mati mendadak, atau backlight redup.',
            ],
            [
                'name' => 'Peralatan Rumah Tangga',
                'slug' => 'peralatan-rumah-tangga',
                'icon' => '🧊',
                'description' => 'Perbaikan microwave, dispenser galon, vacuum cleaner robot, dan air fryer.',
            ],
            [
                'name' => 'Printer & Scanner',
                'slug' => 'printer-scanner',
                'icon' => '🖨️',
                'description' => 'Hasil cetak bergaris, paper jam, pembersihan head printer, dan sistem infus tinta.',
            ],
            [
                'name' => 'Jaringan & Wi-Fi',
                'slug' => 'jaringan-wifi',
                'icon' => '🌐',
                'description' => 'Setting router Wi-Fi kantor/rumah, pasang access point, dan crimping kabel LAN.',
            ],
            [
                'name' => 'Software & Pemeliharaan OS',
                'slug' => 'software-os',
                'icon' => '⚙️',
                'description' => 'Instalasi ulang Windows/macOS, pembersihan malware/virus, dan backup data penting.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $catData) {
            $categories[$catData['slug']] = Category::create($catData);
        }

        // 5. Link Skills to Technicians
        $techBudi->skills()->attach([
            $categories['smartphone-tablet']->id,
            $categories['laptop']->id,
        ]);

        $techEko->skills()->attach([
            $categories['laptop']->id,
            $categories['komputer-pc']->id,
            $categories['tv-audio']->id,
            $categories['jaringan-wifi']->id,
        ]);

        $techHendra->skills()->attach([
            $categories['printer-scanner']->id,
            $categories['peralatan-rumah-tangga']->id,
            $categories['software-os']->id,
        ]);

        // 6. Services Catalog
        $servicesData = [
            // Laptop
            [
                'category_id' => $categories['laptop']->id,
                'name' => 'Penggantian Layar LCD Laptop',
                'slug' => 'penggantian-layar-lcd-laptop',
                'description' => 'Mengganti panel LCD laptop yang retak, bergaris, blank putih, atau dead pixel dengan suku cadang original sesuai tipe laptop.',
                'base_price' => 750000,
                'estimated_duration' => '1 - 2 Jam',
            ],
            [
                'category_id' => $categories['laptop']->id,
                'name' => 'Pembersihan Total & Ganti Thermal Paste',
                'slug' => 'pembersihan-thermal-paste-laptop',
                'description' => 'Pembersihan debu kipas pendingin dan penggantian thermal paste kualitas tinggi (Arctic MX-4) untuk mengatasi laptop cepat panas.',
                'base_price' => 150000,
                'estimated_duration' => '45 - 60 Menit',
            ],
            [
                'category_id' => $categories['laptop']->id,
                'name' => 'Penggantian Keyboard Laptop',
                'slug' => 'penggantian-keyboard-laptop',
                'description' => 'Perbaikan tombol keyboard yang mengetik sendiri, macet, atau mati total.',
                'base_price' => 250000,
                'estimated_duration' => '1 Jam',
            ],
            [
                'category_id' => $categories['laptop']->id,
                'name' => 'Upgrade SSD NVMe & Cloning Data',
                'slug' => 'upgrade-ssd-cloning-laptop',
                'description' => 'Tingkatkan performa booting laptop hingga 10x lipat dengan SSD NVMe baru + kloning seluruh data tanpa hilang.',
                'base_price' => 450000,
                'estimated_duration' => '1 - 2 Jam',
            ],

            // Smartphone
            [
                'category_id' => $categories['smartphone-tablet']->id,
                'name' => 'Penggantian Layar / Touchscreen Smartphone',
                'slug' => 'ganti-lcd-touchscreen-smartphone',
                'description' => 'Ganti layar touchscreen pecah atau ghost touch untuk berbagai merek (Samsung, iPhone, Xiaomi, Oppo, Vivo).',
                'base_price' => 350000,
                'estimated_duration' => '1 - 2 Jam',
            ],
            [
                'category_id' => $categories['smartphone-tablet']->id,
                'name' => 'Ganti Baterai Smartphone Original',
                'slug' => 'ganti-baterai-smartphone',
                'description' => 'Solusi baterai cepat habis, drop, atau kembung dengan baterai bergaransi.',
                'base_price' => 200000,
                'estimated_duration' => '45 Menit',
            ],

            // PC Desktop
            [
                'category_id' => $categories['komputer-pc']->id,
                'name' => 'Diagnosa PC Mati Total & Troubleshooting Hardware',
                'slug' => 'diagnosa-pc-mati-total',
                'description' => 'Pemeriksaan komprehensif motherboard, PSU, prosesor, dan RAM untuk menemukan penyebab komputer tidak mau menyala.',
                'base_price' => 150000,
                'estimated_duration' => '1 - 3 Jam',
            ],
            [
                'category_id' => $categories['komputer-pc']->id,
                'name' => 'Jasa Rakit PC Custom & Cable Management',
                'slug' => 'jasa-rakit-pc-custom',
                'description' => 'Perakitan komponen PC rakitan gaming/editing dengan manajemen kabel rapi dan airflow optimal.',
                'base_price' => 250000,
                'estimated_duration' => '2 - 3 Jam',
            ],

            // TV & Audio
            [
                'category_id' => $categories['tv-audio']->id,
                'name' => 'Servis TV LED Gambar Gelap Suara Ada',
                'slug' => 'servis-tv-led-backlight',
                'description' => 'Penggantian lampu backlight LED original agar gambar kembali terang dan jernih.',
                'base_price' => 400000,
                'estimated_duration' => '1 - 2 Hari',
            ],

            // Printer
            [
                'category_id' => $categories['printer-scanner']->id,
                'name' => 'Pembersihan Printhead & Reset Ink Pad',
                'slug' => 'servis-head-reset-printer',
                'description' => 'Mengatasi hasil cetak bergaris, warna putus-putus, atau printer blinking absorber full.',
                'base_price' => 150000,
                'estimated_duration' => '1 - 2 Jam',
            ],

            // Jaringan
            [
                'category_id' => $categories['jaringan-wifi']->id,
                'name' => 'Instalasi & Konfigurasi Wi-Fi Router',
                'slug' => 'instalasi-wifi-router',
                'description' => 'Setup router baru, optimasi channel frekuensi, perbaikan sinyal lemah, dan setup keamanan Wi-Fi.',
                'base_price' => 175000,
                'estimated_duration' => '1 - 2 Jam',
            ],

            // Software
            [
                'category_id' => $categories['software-os']->id,
                'name' => 'Instal Ulang Windows / macOS + Driver Lengkap',
                'slug' => 'instal-ulang-os-driver',
                'description' => 'Instalasi sistem operasi bersih, aktivasi update resmi, dan paket software standar siap pakai.',
                'base_price' => 125000,
                'estimated_duration' => '1 - 2 Jam',
            ],
        ];

        $services = [];
        foreach ($servicesData as $s) {
            $services[$s['slug']] = Service::create($s);
        }

        // 7. Seed Sample Service Requests with full Realistic Workflow!
        
        // --- Order 1: Completed Order with Quotation, Mock Payment & Review ---
        $custAndi = $customerModels[0];
        $addrAndi = $custAndi->addresses->first();
        $srvLcd = $services['penggantian-layar-lcd-laptop'];

        $orderCompleted = ServiceRequest::create([
            'request_number' => 'AF-20260910-0001',
            'customer_id' => $custAndi->id,
            'service_id' => $srvLcd->id,
            'technician_id' => $techBudi->id,
            'address_id' => $addrAndi->id,
            'device_name' => 'Laptop ASUS VivoBook 14',
            'device_brand' => 'ASUS',
            'device_model' => 'A412DA',
            'problem_description' => 'Layar LCD retak di bagian sudut kiri bawah setelah terjepit tas. Timbul garis-garis hitam vertikal.',
            'address' => $addrAndi->address . ', ' . $addrAndi->city,
            'preferred_date' => now()->subDays(2),
            'preferred_time' => '10:00',
            'status' => 'completed',
            'estimated_price' => 750000,
            'final_price' => 950000,
            'customer_notes' => 'Tolong bawa cadangan LCD tipe IPS 14 inch Full HD ya pak.',
            'technician_notes' => 'LCD lama tipe FHD 30-pin sudah diganti dengan panel IPS original. Tes warna dan kecerahan normal.',
            'created_at' => now()->subDays(2)->setTime(9, 15),
        ]);

        // Status history for Order 1
        $histories = [
            ['status' => 'pending', 'by' => $custAndi->id, 'notes' => 'Permintaan servis dibuat oleh customer.', 'time' => now()->subDays(2)->setTime(9, 15)],
            ['status' => 'confirmed', 'by' => $admin->id, 'notes' => 'Permintaan dikonfirmasi admin AnyFix.', 'time' => now()->subDays(2)->setTime(9, 30)],
            ['status' => 'technician_assigned', 'by' => $admin->id, 'notes' => 'Teknisi Budi Santoso ditugaskan.', 'time' => now()->subDays(2)->setTime(9, 45)],
            ['status' => 'technician_on_the_way', 'by' => $techBudi->id, 'notes' => 'Teknisi sedang dalam perjalanan ke lokasi.', 'time' => now()->subDays(2)->setTime(10, 10)],
            ['status' => 'diagnosing', 'by' => $techBudi->id, 'notes' => 'Pemeriksaan fisik soket eDP dan frame engsel.', 'time' => now()->subDays(2)->setTime(10, 40)],
            ['status' => 'waiting_customer_approval', 'by' => $techBudi->id, 'notes' => 'Penawaran biaya suku cadang dan jasa telah dikirimkan.', 'time' => now()->subDays(2)->setTime(10, 50)],
            ['status' => 'repairing', 'by' => $custAndi->id, 'notes' => 'Customer menyetujui penawaran. Pengerjaan dimulai.', 'time' => now()->subDays(2)->setTime(11, 00)],
            ['status' => 'completed', 'by' => $techBudi->id, 'notes' => 'Penggantian LCD selesai dan telah diuji.', 'time' => now()->subDays(2)->setTime(12, 15)],
        ];

        foreach ($histories as $h) {
            ServiceStatusHistory::create([
                'service_request_id' => $orderCompleted->id,
                'status' => $h['status'],
                'changed_by' => $h['by'],
                'notes' => $h['notes'],
                'created_at' => $h['time'],
            ]);
        }

        // Quotation for Order 1
        $quote1 = Quotation::create([
            'service_request_id' => $orderCompleted->id,
            'technician_id' => $techBudi->id,
            'subtotal' => 900000,
            'service_fee' => 100000,
            'discount' => 50000,
            'total' => 950000,
            'notes' => 'Panel LCD IPS Full HD Original 14 inch + Jasa Pemasangan & Pembersihan Kipas.',
            'status' => 'approved',
            'created_at' => now()->subDays(2)->setTime(10, 50),
        ]);

        QuotationItem::create([
            'quotation_id' => $quote1->id,
            'description' => 'Panel Layar LCD IPS 14.0" FHD 30-pin Slim Original',
            'quantity' => 1,
            'unit_price' => 750000,
            'subtotal' => 750000,
        ]);

        QuotationItem::create([
            'quotation_id' => $quote1->id,
            'description' => 'Jasa Bongkar Pasang Bezel & Kalibrasi Display',
            'quantity' => 1,
            'unit_price' => 150000,
            'subtotal' => 150000,
        ]);

        // Payment for Order 1
        Payment::create([
            'service_request_id' => $orderCompleted->id,
            'quotation_id' => $quote1->id,
            'amount' => 950000,
            'method' => 'bank_transfer_mock',
            'status' => 'paid',
            'reference' => 'TRX-MOCK-2026091001',
            'paid_at' => now()->subDays(2)->setTime(12, 20),
        ]);

        // Review for Order 1
        Review::create([
            'service_request_id' => $orderCompleted->id,
            'customer_id' => $custAndi->id,
            'technician_id' => $techBudi->id,
            'rating' => 5,
            'comment' => 'Pelayanan mas Budi sangat profesional! Layar laptop kembali jernih seperti baru, pengerjaan cepat dan rapi langsung di tempat.',
            'created_at' => now()->subDays(2)->setTime(13, 00),
        ]);

        // --- Order 2: Active Order (In Diagnosing State) ---
        $custSiti = $customerModels[1];
        $addrSiti = $custSiti->addresses->first();
        $srvThermal = $services['pembersihan-thermal-paste-laptop'];

        $orderActive = ServiceRequest::create([
            'request_number' => 'AF-20260912-0002',
            'customer_id' => $custSiti->id,
            'service_id' => $srvThermal->id,
            'technician_id' => $techBudi->id,
            'address_id' => $addrSiti->id,
            'device_name' => 'MacBook Air M1 2020',
            'device_brand' => 'Apple',
            'device_model' => 'A2337',
            'problem_description' => 'Laptop terasa sangat panas di bagian bawah dan performa melambat drastis saat membuka Photoshop.',
            'address' => $addrSiti->address . ', ' . $addrSiti->city,
            'preferred_date' => now(),
            'preferred_time' => '13:00',
            'status' => 'diagnosing',
            'estimated_price' => 150000,
            'customer_notes' => 'Ada anjing kecil di rumah, mohon kabari sebelum tiba.',
            'technician_notes' => 'Sedang memeriksa suhu sensor idle dan membuka casing bawah.',
            'created_at' => now()->subHours(2),
        ]);

        ServiceStatusHistory::create([
            'service_request_id' => $orderActive->id,
            'status' => 'pending',
            'changed_by' => $custSiti->id,
            'notes' => 'Permintaan servis dibuat.',
            'created_at' => now()->subHours(2),
        ]);
        ServiceStatusHistory::create([
            'service_request_id' => $orderActive->id,
            'status' => 'confirmed',
            'changed_by' => $admin->id,
            'notes' => 'Admin menyetujui jadwal.',
            'created_at' => now()->subHours(1)->subMinutes(40),
        ]);
        ServiceStatusHistory::create([
            'service_request_id' => $orderActive->id,
            'status' => 'technician_assigned',
            'changed_by' => $admin->id,
            'notes' => 'Teknisi Budi Santoso ditugaskan.',
            'created_at' => now()->subHours(1)->subMinutes(30),
        ]);
        ServiceStatusHistory::create([
            'service_request_id' => $orderActive->id,
            'status' => 'technician_on_the_way',
            'changed_by' => $techBudi->id,
            'notes' => 'Menuju ke alamat pelanggan.',
            'created_at' => now()->subHours(1),
        ]);
        ServiceStatusHistory::create([
            'service_request_id' => $orderActive->id,
            'status' => 'diagnosing',
            'changed_by' => $techBudi->id,
            'notes' => 'Mengecek aliran udara dan pasta pendingin.',
            'created_at' => now()->subMinutes(20),
        ]);

        // --- Order 3: Pending Order ---
        $custDian = $customerModels[2];
        $addrDian = $custDian->addresses->first();
        $srvTv = $services['servis-tv-led-backlight'];

        $orderPending = ServiceRequest::create([
            'request_number' => 'AF-20260912-0003',
            'customer_id' => $custDian->id,
            'service_id' => $srvTv->id,
            'address_id' => $addrDian->id,
            'device_name' => 'Smart TV Samsung 43 Inch',
            'device_brand' => 'Samsung',
            'device_model' => 'UA43T6500',
            'problem_description' => 'Layar gelap total namun suara siaran YouTube masih terdengar jelas.',
            'address' => $addrDian->address . ', ' . $addrDian->city,
            'preferred_date' => now()->addDay(),
            'preferred_time' => '14:00',
            'status' => 'pending',
            'estimated_price' => 400000,
            'customer_notes' => 'Posisi TV di ruang keluarga lantai 1.',
            'created_at' => now()->subMinutes(15),
        ]);

        ServiceStatusHistory::create([
            'service_request_id' => $orderPending->id,
            'status' => 'pending',
            'changed_by' => $custDian->id,
            'notes' => 'Permintaan servis baru diajukan.',
            'created_at' => now()->subMinutes(15),
        ]);
    }
}
