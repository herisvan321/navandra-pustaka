<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\CompanyProfile;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Package;
use App\Models\PublishingStep;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WritingEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin Nevandra',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );

        // Company Profile
        CompanyProfile::updateOrCreate(
            ['email' => 'Nevandra.press@gmail.com'],
            [
                'name' => 'CV Nevandra Pustaka Nusantara',
                'about' => 'CV Nevandra Pustaka Nusantara adalah perusahaan multisektoral yang bergerak di bidang literasi, penerbitan, percetakan, teknologi informasi, dan pengembangan sumber daya manusia. Berlandaskan semangat inovasi dan dedikasi terhadap penyebaran ilmu pengetahuan, kami hadir sebagai mitra strategis dalam menghilirkan gagasan menjadi produk nyata yang bernilai tinggi.',
                'vision' => 'Menjadi pusat keunggulan literasi dan inovasi digital di Indonesia yang mampu menginspirasi serta mencerdaskan kehidupan bangsa.',
                'mission' => 'Memberikan layanan penerbitan dan percetakan berkualitas tinggi, mengadopsi teknologi digital untuk perluasan akses informasi, serta berkontribusi aktif dalam pengembangan pendidikan kreatif.',
                'address' => 'Jl. Kalumbuk RT003/RW003, Kuranji, Kota Padang, Sumatera Barat',
                'phone' => '085814609558',
            ]
        );

        // FAQs
        $faqs = [
            ['question' => 'Berapa lama proses penerbitan buku dari naskah hingga cetak?', 'answer' => 'Proses penerbitan buku di Nevandra Pustaka Nusantara umumnya membutuhkan waktu 14–30 hari kerja, tergantung paket yang dipilih. Paket Premium memiliki jalur prioritas dengan estimasi 14 hari, sedangkan paket Reguler sekitar 21–30 hari. Proses meliputi review naskah, editing, desain cover & layout, proofreading, percetakan, dan pengiriman.', 'order' => 1],
            ['question' => 'Apakah buku saya akan mendapatkan ISBN?', 'answer' => 'Ya! Semua buku yang diterbitkan melalui Nevandra Pustaka Nusantara akan mendapatkan ISBN resmi yang dikeluarkan oleh Perpustakaan Nasional Republik Indonesia (Perpusnas RI). ISBN gratis tersedia untuk paket Reguler dan Premium. Untuk paket Digital, ISBN tersedia sebagai add-on berbayar.', 'order' => 2],
            ['question' => 'Apakah hak cipta buku tetap milik saya sebagai penulis?', 'answer' => 'Benar! Hak cipta buku sepenuhnya tetap menjadi milik penulis. Nevandra Pustaka Nusantara hanya bertindak sebagai mitra penerbit dan distributor. Kami tidak mengklaim kepemilikan atas karya Anda. Penulis berhak mencetak ulang, mendistribusikan, atau memberi hak penerbitan kepada pihak lain setelah perjanjian berakhir.', 'order' => 3],
            ['question' => 'Format naskah apa yang diterima untuk pengiriman?', 'answer' => 'Kami menerima naskah dalam format Microsoft Word (.doc/.docx), Google Docs, atau PDF. Untuk gambar ilustrasi, disarankan dalam format PNG atau JPG dengan resolusi minimal 300 DPI. Naskah harus dalam bahasa Indonesia baku atau dapat ditulis dalam bahasa daerah dengan catatan terjemahan. Minimal halaman naskah adalah 50 halaman A5.', 'order' => 4],
            ['question' => 'Apakah ada layanan editing dan proofreading?', 'answer' => 'Ya, kami menyediakan layanan editing dan proofreading profesional. Untuk paket Reguler, termasuk proofreading dasar. Paket Premium mencakup substantive editing, copyediting, dan proofreading lengkap oleh editor berpengalaman. Layanan editing tambahan juga tersedia sebagai add-on untuk paket Digital.', 'order' => 5],
            // ['question' => 'Bagaimana sistem pembayaran yang berlaku?', 'answer' => 'Pembayaran dapat dilakukan melalui transfer bank (BRI, BCA, Mandiri), dompet digital (GoPay, OVO, DANA), atau QRIS. Untuk paket Reguler dan Premium, tersedia skema DP 50% di awal dan pelunasan sebelum cetak. Kami tidak menerima pembayaran COD untuk layanan penerbitan.', 'order' => 6],
            ['question' => 'Apakah buku saya bisa dijual di toko buku nasional?', 'answer' => 'Untuk paket Premium, kami menyediakan layanan distribusi ke toko buku mitra dan platform digital seperti Google Play Books dan Tokopedia. Distribusi ke toko buku fisik nasional dapat dikonsultasikan secara khusus. Penulis juga mendapat akses ke platform belanja buku kami sendiri di website ini.', 'order' => 7],
            ['question' => 'Berapa jumlah minimal cetak untuk satu judul buku?', 'answer' => 'Jumlah minimal cetak adalah 10 eksemplar untuk paket Print on Demand. Paket Reguler dimulai dari 50 eksemplar, dan paket Premium dari 100 eksemplar. Semakin banyak jumlah cetak, semakin rendah biaya per eksemplar. Kami juga menyediakan cetak ulang (reprint) dengan harga yang lebih kompetitif.', 'order' => 8],
        ];
        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], array_merge($faq, ['is_active' => true]));
        }

        // Packages
        $packages = [
            [
                'name' => 'Paket Digital',
                'tagline' => 'Ideal untuk penulis pemula',
                'price' => 450000,
                'features' => json_encode(['E-Book (PDF & EPUB)', 'Desain Cover Profesional', 'Layout Interior B5', 'Naskah 50–150 halaman', 'Proofreading Dasar', 'ISBN (Add-on +Rp 100K)', 'Cetak Fisik (Tidak Termasuk)', 'Distribusi Toko Buku (Tidak Termasuk)']),
                'is_featured' => false,
                'order' => 1,
            ],
            [
                'name' => 'Paket Reguler',
                'tagline' => 'Pilihan terbaik penulis aktif',
                'price' => 800000,
                'features' => json_encode(['E-Book + Cetak 6 Eksemplar', 'ISBN Resmi Perpusnas RI', 'Desain Cover Premium', 'Layout Interior Profesional', 'Naskah 100–200 halaman', 'Proofreading & Copyediting', 'Tayang di Website Nevandra', 'Distribusi Nasional (Tidak Termasuk)']),
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'Paket Premium',
                'tagline' => 'Untuk karya berkelas nasional',
                'price' => 1500000,
                'features' => json_encode(['E-Book + Cetak 10 Eksemplar', 'ISBN + KDT (Katalog Dalam Terbitan)', 'Desain Cover Eksklusif', 'Full Editorial Service', 'Naskah hingga 400 halaman', 'Distribusi Platform Digital', 'Promosi Media Sosial', 'Konsultasi Penulis 1-on-1']),
                'is_featured' => false,
                'order' => 3,
            ],
        ];
        foreach ($packages as $pkg) {
            Package::updateOrCreate(['name' => $pkg['name']], $pkg);
        }

        // Publishing Steps
        $steps = [
            ['title' => 'Persiapkan Naskah Anda', 'description' => 'Pastikan naskah sudah selesai dan tersimpan dalam format Word (.docx) atau Google Docs. Naskah minimal 50 halaman A5.', 'note' => 'Tips: Baca panduan penulisan kami di website sebelum mengirimkan naskah.', 'order' => 1],
            ['title' => 'Pilih Paket Penerbitan', 'description' => 'Kunjungi halaman Paket Penerbitan dan pilih paket yang sesuai dengan kebutuhan dan anggaran Anda.', 'note' => null, 'order' => 2],
            ['title' => 'Kirim Naskah & Lakukan Pembayaran', 'description' => 'Kirimkan naskah melalui email ke Nevandra.press@gmail.com atau via WhatsApp.', 'note' => 'Subject email: [NASKAH] Nama Judul – Nama Penulis', 'order' => 3],
            ['title' => 'Proses Editing & Desain', 'description' => 'Tim editor dan desainer kami akan mengerjakan naskah Anda. Anda akan mendapatkan draft layout dan cover.', 'note' => null, 'order' => 4],
            ['title' => 'Persetujuan Final Proses pengajuan ISBN', 'description' => 'Setelah Anda menyetujui semua file cetak, lakukan pelunasan sisa pembayaran.', 'note' => null, 'order' => 5],
            ['title' => 'Cetak & Pengiriman', 'description' => 'Setelah ISBN buku terbit, Buku dicetak dan dikirimkan ke alamat Anda. Estimasi pengiriman 3–14 hari kerja.', 'note' => null, 'order' => 6],
        ];
        foreach ($steps as $step) {
            PublishingStep::updateOrCreate(['title' => $step['title']], $step);
        }

        // Books
        // $books = [
        //     ['title' => 'Di Antara Dua Musim', 'author' => 'Rina Anggraini', 'category' => 'Fiksi', 'price' => 75000],
        //     ['title' => 'Merawat Literasi di Era Digital', 'author' => 'Dr. Ahmad Fauzi, M.Pd', 'category' => 'Non-Fiksi', 'price' => 85000],
        //     ['title' => 'Surat dari Tepian Sungai', 'author' => 'Mira Dewi Saputri', 'category' => 'Puisi', 'price' => 65000],
        //     ['title' => 'Metodologi Penelitian Kualitatif Modern', 'author' => 'Prof. Hendra Kusuma', 'category' => 'Akademik', 'price' => 120000],
        //     ['title' => 'Antologi Cerpen "Tanah Air Beta"', 'author' => '35 Penulis Indonesia', 'category' => 'Antologi', 'price' => 90000],
        //     ['title' => 'Kewirausahaan Berbasis Konten Lokal', 'author' => 'Budi Santoso, S.E., M.M.', 'category' => 'Non-Fiksi', 'price' => 95000],
        //     ['title' => 'Ranah Minang di Mata Pena', 'author' => 'Sari Wahyuni', 'category' => 'Fiksi Lokal', 'price' => 70000],
        //     ['title' => 'Sajak-Sajak Pantai Barat', 'author' => 'Laila Amalia, S.S.', 'category' => 'Puisi', 'price' => 60000],
        // ];
        // foreach ($books as $book) {
        //     Book::updateOrCreate(['title' => $book['title']], array_merge($book, ['status' => 'published']));
        // }

        // News / Documentation
        $news = [
            ['title' => 'Pembukaan Antologi Puisi Nasional 2025 "Suara Nusantara"', 'content' => 'Nevandra Pustaka Nusantara membuka call for writer untuk antologi puisi bertema keberagaman dan kebangsaan.', 'created_at' => '2025-03-15'],
            ['title' => 'Penerimaan Penghargaan Penerbit Inovatif Sumatera Barat 2025', 'content' => 'Dinas Pendidikan Provinsi Sumatera Barat memberikan apresiasi kepada Nevandra Pustaka Nusantara atas kontribusi signifikan dalam peningkatan budaya literasi di wilayah Sumatera Barat.', 'created_at' => '2025-03-01'],
            ['title' => 'Peluncuran Antologi "Nusantara Bercerita" Vol. 3', 'content' => 'Peluncuran antologi cerpen ke-3 yang menampilkan 42 penulis dari 15 provinsi di Indonesia. Acara dihadiri lebih dari 200 undangan termasuk pejabat Dinas Kebudayaan dan perwakilan IKAPI Sumbar.', 'created_at' => '2025-02-15'],
            ['title' => 'Workshop "Menulis Buku Non-Fiksi dari Nol" Hadir di Padang', 'content' => 'Bagi Anda yang ingin mulai menulis buku non-fiksi, kami hadirkan workshop intensif bersama penulis berpengalaman.', 'created_at' => '2025-02-20'],
            ['title' => 'Workshop "Menulis untuk Diterbitkan" — Seri Padang', 'content' => 'Workshop 2 hari yang dihadiri 85 peserta dari berbagai latar belakang. Narasumber utama adalah penulis novel bestseller dan editor senior dari penerbit nasional.', 'created_at' => '2024-11-10'],
            ['title' => 'Padang Book Fair 2024 — Stand Nevandra Pustaka', 'content' => 'Nevandra Pustaka Nusantara berpartisipasi sebagai penerbit lokal unggulan di Padang Book Fair 2024, memperkenalkan lebih dari 50 judul buku terbaru kepada masyarakat umum.', 'created_at' => '2024-08-05'],
            ['title' => 'Penandatanganan MOU dengan Dinas Pendidikan Kota Padang', 'content' => 'Penandatanganan Memorandum of Understanding (MOU) antara Nevandra Pustaka Nusantara dengan Dinas Pendidikan Kota Padang untuk pengadaan buku dan program literasi sekolah.', 'created_at' => '2024-06-17'],
            ['title' => 'Seminar Kepenulisan "Literasi di Era 5.0"', 'content' => 'Seminar nasional yang mempertemukan penulis, penerbit, dan pemangku kepentingan literasi untuk membahas tantangan dan peluang di era teknologi 5.0.', 'created_at' => '2023-10-25'],
        ];
        foreach ($news as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                [
                    'content' => $item['content'],
                    'is_published' => true,
                    'created_at' => $item['created_at'],
                    'published_at' => $item['created_at'],
                ]
            );
        }

        // Writing Events
        $events = [
            ['title' => 'Antologi Cerpen Nasional "Melintas Batas 2026"', 'type' => 'Antologi', 'genre' => 'Cerpen', 'description' => 'Kirimkan cerpen terbaikmu dengan tema "keberagaman, persatuan, dan identitas nusantara".', 'deadline' => '2026-04-30'],
            ['title' => 'Lomba Menulis Puisi "Suara Alam Minangkabau"', 'type' => 'Lomba', 'genre' => 'Puisi', 'description' => 'Abadikan keindahan alam dan budaya Minangkabau dalam bait-bait puisi yang memukau.', 'deadline' => '2026-05-15'],
            ['title' => 'Workshop Penulisan Buku Non-Fiksi Intensif', 'type' => 'Workshop', 'genre' => 'Non-Fiksi', 'description' => 'Workshop 2 hari intensif bersama penulis dan editor berpengalaman.', 'deadline' => '2026-06-01'],
            ['title' => 'Proyek Antologi Anak "Cerita dari Kampung Kami"', 'type' => 'Antologi', 'genre' => 'Cerita Pendek', 'description' => 'Proyek penulisan khusus penulis muda Indonesia usia 10–17 tahun.', 'deadline' => '2026-07-01'],
        ];
        foreach ($events as $event) {
            WritingEvent::updateOrCreate(['title' => $event['title']], array_merge($event, ['is_active' => true]));
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Rina Anggraini', 'role' => 'Penulis Novel, Padang', 'content' => 'Prosesnya cepat dan profesional sekali. Dari kirim naskah sampai buku cetak hanya 3 minggu.'],
            ['name' => 'Dr. Ahmad Fauzi, M.Pd', 'role' => 'Dosen & Penulis Buku Referensi', 'content' => 'Setiap kali hasilnya selalu memuaskan. Tim editor mereka sangat membantu memperbaiki tulisan saya.'],
            ['name' => 'Mira Dewi Saputri', 'role' => 'Penyair, Pekanbaru', 'content' => 'Tim Nevandra sabar membimbing dari awal sampai akhir. Buku antologi kami sukses terjual habis!'],
            ['name' => 'Budi Santoso, M.M.', 'role' => 'Penulis Buku Bisnis, Bukittinggi', 'content' => 'Kualitas cetak sangat bagus, warna cover tajam dan kertas isi bagus. Harga sangat terjangkau.'],
            ['name' => 'Sari Wahyuni', 'role' => 'Guru & Penulis, Solok', 'content' => 'ISBN urus sendiri itu ribet, tapi di Nevandra semua diurus. Sangat merekomendasikan!'],
            ['name' => 'Randi Putra', 'role' => 'Mahasiswa & Penulis Pemula, Padang', 'content' => 'Workshop menulis yang diadakan Nevandra sangat informatif dan praktis.'],
        ];
        foreach ($testimonials as $testi) {
            Testimonial::updateOrCreate(['name' => $testi['name']], array_merge($testi, ['is_active' => true]));
        }

        // Gallery
        $galleries = [
            ['title' => 'Peluncuran Buku Antologi "Nusantara Bercerita" — Maret 2025'],
            ['title' => 'Pameran Buku Padang Book Fair 2024'],
            ['title' => 'Workshop Penulisan di Universitas Andalas, Februari 2025'],
            ['title' => 'Proses Percetakan di Pabrik Nevandra'],
            ['title' => 'Peluncuran Buku "Ranah Minang di Mata Pena" — Jan 2025'],
            ['title' => 'Penyerahan Penghargaan Penerbit Inovatif Sumbar 2025'],
            ['title' => 'Seminar Kepenulisan "Literasi Tanpa Batas" — Nov 2024'],
            ['title' => 'MOU dengan Dinas Pendidikan Kota Padang'],
        ];
        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(['title' => $gallery['title']], $gallery);
        }
    }
}
