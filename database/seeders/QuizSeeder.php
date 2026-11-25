<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'kalkulus' => [
                'Kalkulus',
                [
                    ['Jika x mendekati 2, berapakah nilai limit (x² - 4) / (x - 2)?', ['A' => '2', 'B' => '4', 'C' => '6', 'D' => 'Tidak terdefinisi'], 'B', 'Faktorkan x² - 4 menjadi (x - 2)(x + 2). Setelah faktor yang sama dicoret, substitusi x = 2 menghasilkan 4.'],
                    ['Jika f(x) = 3x² - 2x + 5, berapakah f′(2)?', ['A' => '6', 'B' => '8', 'C' => '10', 'D' => '12'], 'C', 'Turunannya f′(x) = 6x - 2, sehingga f′(2) = 12 - 2 = 10.'],
                    ['Berapakah nilai integral tentu ∫₀² 2x dx?', ['A' => '2', 'B' => '3', 'C' => '4', 'D' => '8'], 'C', 'Anti-turunan 2x adalah x². Nilai x² dari 0 sampai 2 adalah 4 - 0 = 4.'],
                    ['Apa turunan dari cos x terhadap x?', ['A' => 'sin x', 'B' => '-sin x', 'C' => 'cos x', 'D' => '-cos x'], 'B', 'Aturan turunan dasar trigonometri menyatakan d(cos x)/dx = -sin x.'],
                    ['Fungsi f(x) = x² - 6x + 10 mencapai nilai minimum pada titik mana?', ['A' => 'x = 1', 'B' => 'x = 2', 'C' => 'x = 3', 'D' => 'x = 6'], 'C', 'Titik puncak parabola berada pada x = -b/(2a) = 6/2 = 3. Karena koefisien x² positif, titik tersebut adalah minimum.'],
                ],
            ],
            'dasar-komputer-pemrograman' => [
                'Dasar Komputer dan Pemrograman',
                [
                    ['Bilangan desimal 13 jika ditulis dalam biner adalah ...', ['A' => '1011', 'B' => '1100', 'C' => '1101', 'D' => '1110'], 'C', '13 = 8 + 4 + 1, sehingga representasi binernya adalah 1101.'],
                    ['Dalam ekspresi 2 + 3 * 4, operasi yang dikerjakan lebih dahulu adalah ...', ['A' => 'Penjumlahan 2 + 3', 'B' => 'Perkalian 3 * 4', 'C' => 'Dikerjakan dari kiri tanpa aturan', 'D' => 'Pembagian'], 'B', 'Perkalian memiliki prioritas lebih tinggi daripada penjumlahan, jadi hasilnya 2 + 12 = 14.'],
                    ['Pada array berbasis indeks mulai dari 0, elemen ketiga berada pada indeks ...', ['A' => '0', 'B' => '1', 'C' => '2', 'D' => '3'], 'C', 'Indeks array dimulai dari 0: elemen pertama di indeks 0, kedua di 1, dan ketiga di 2.'],
                    ['Apa yang diperiksa oleh operator perbandingan === pada PHP?', ['A' => 'Hanya apakah dua nilai sama', 'B' => 'Kesamaan nilai dan tipe data', 'C' => 'Apakah nilai pertama lebih besar', 'D' => 'Apakah dua variabel memiliki nama sama'], 'B', 'Operator === membandingkan nilai sekaligus tipe data; misalnya 5 tidak identik dengan "5".'],
                    ['Sebuah perulangan memproses setiap elemen array satu kali. Jika jumlah elemennya n, kompleksitas waktunya adalah ...', ['A' => 'O(1)', 'B' => 'O(log n)', 'C' => 'O(n)', 'D' => 'O(n²)'], 'C', 'Jumlah operasi bertambah sebanding dengan jumlah elemen karena setiap elemen dikunjungi satu kali.'],
                ],
            ],
            'pancasila' => [
                'Pancasila',
                [
                    ['Bunyi sila pertama Pancasila adalah ...', ['A' => 'Kemanusiaan yang adil dan beradab', 'B' => 'Ketuhanan Yang Maha Esa', 'C' => 'Persatuan Indonesia', 'D' => 'Keadilan sosial bagi seluruh rakyat Indonesia'], 'B', 'Sila pertama Pancasila berbunyi Ketuhanan Yang Maha Esa.'],
                    ['Sikap menjaga kerukunan dan keutuhan bangsa mencerminkan sila ...', ['A' => 'Pertama', 'B' => 'Kedua', 'C' => 'Ketiga', 'D' => 'Kelima'], 'C', 'Persatuan Indonesia adalah sila ketiga dan menjadi dasar untuk menjaga keutuhan bangsa.'],
                    ['Pengambilan keputusan melalui musyawarah untuk mencapai mufakat terutama mencerminkan sila ...', ['A' => 'Pertama', 'B' => 'Kedua', 'C' => 'Keempat', 'D' => 'Kelima'], 'C', 'Sila keempat menekankan kerakyatan yang dipimpin oleh hikmat kebijaksanaan dalam permusyawaratan/perwakilan.'],
                    ['Bunyi sila kelima Pancasila adalah ...', ['A' => 'Persatuan Indonesia', 'B' => 'Keadilan sosial bagi seluruh rakyat Indonesia', 'C' => 'Ketuhanan Yang Maha Esa', 'D' => 'Kemanusiaan yang adil dan beradab'], 'B', 'Sila kelima berbunyi Keadilan sosial bagi seluruh rakyat Indonesia.'],
                    ['Menghormati martabat setiap orang dan tidak melakukan perundungan paling dekat dengan nilai sila ...', ['A' => 'Pertama', 'B' => 'Kedua', 'C' => 'Ketiga', 'D' => 'Keempat'], 'B', 'Sila kedua mengajarkan pengakuan terhadap martabat manusia serta perilaku yang adil dan beradab.'],
                ],
            ],
            'bahasa-indonesia' => [
                'Bahasa Indonesia',
                [
                    ['Manakah penulisan kata baku yang tepat?', ['A' => 'Resiko', 'B' => 'Risiko', 'C' => 'Resikko', 'D' => 'Riziko'], 'B', 'Bentuk baku yang digunakan dalam bahasa Indonesia adalah risiko.'],
                    ['Kalimat manakah yang paling efektif?', ['A' => 'Para mahasiswa-mahasiswa hadir semua.', 'B' => 'Mahasiswa hadir di dalam kelas semua sekali.', 'C' => 'Para mahasiswa mengikuti kuliah dengan tertib.', 'D' => 'Kuliah itu adalah merupakan kuliah yang penting.'], 'C', 'Pilihan C tidak mengulang penanda jamak atau menggunakan kata yang berlebihan.'],
                    ['Manakah kata baku yang benar?', ['A' => 'Aktifitas', 'B' => 'Aktivitas', 'C' => 'Aktifitaz', 'D' => 'Aktifvitas'], 'B', 'Bentuk baku menurut ejaan bahasa Indonesia adalah aktivitas.'],
                    ['Kalimat yang menggunakan tanda baca dengan tepat adalah ...', ['A' => 'Karena hujan deras praktikum, ditunda.', 'B' => 'Karena, hujan deras praktikum ditunda.', 'C' => 'Karena hujan deras, praktikum ditunda.', 'D' => 'Karena hujan, deras praktikum ditunda.'], 'C', 'Anak kalimat yang mendahului induk kalimat dipisahkan dengan koma.'],
                    ['Sinonim kata cermat dalam konteks mengerjakan laporan adalah ...', ['A' => 'Teliti', 'B' => 'Lambat', 'C' => 'Ragu', 'D' => 'Keras'], 'A', 'Cermat berarti teliti atau saksama dalam melakukan sesuatu.'],
                ],
            ],
            'fisika-teknik' => [
                'Fisika Teknik',
                [
                    ['Resistor 6 Ω dipasang pada sumber 12 V. Berapakah arus yang mengalir?', ['A' => '0,5 A', 'B' => '2 A', 'C' => '6 A', 'D' => '72 A'], 'B', 'Hukum Ohm: I = V/R = 12/6 = 2 A.'],
                    ['Sebuah resistor 5 Ω dialiri arus 2 A. Berapakah daya listriknya?', ['A' => '10 W', 'B' => '15 W', 'C' => '20 W', 'D' => '25 W'], 'C', 'Gunakan P = I²R = 2² × 5 = 20 W.'],
                    ['Dua resistor 4 Ω dan 6 Ω disusun seri. Berapakah hambatan totalnya?', ['A' => '2 Ω', 'B' => '5 Ω', 'C' => '10 Ω', 'D' => '24 Ω'], 'C', 'Hambatan pada rangkaian seri dijumlahkan: 4 + 6 = 10 Ω.'],
                    ['Benda bermassa 2 kg bergerak dengan kecepatan 3 m/s. Berapakah energi kinetiknya?', ['A' => '3 J', 'B' => '6 J', 'C' => '9 J', 'D' => '18 J'], 'C', 'Energi kinetik Eₖ = ½mv² = ½ × 2 × 3² = 9 J.'],
                    ['Sinyal periodik memiliki frekuensi 25 Hz. Berapakah periodenya?', ['A' => '0,004 s', 'B' => '0,025 s', 'C' => '0,04 s', 'D' => '25 s'], 'C', 'Periode T = 1/f = 1/25 = 0,04 s.'],
                ],
            ],
            'pengenalan-bidang-teknik-elektro' => [
                'Pengenalan Bidang Teknik Elektro',
                [
                    ['Bidang teknik elektro yang berfokus pada pembangkitan dan penyaluran energi listrik adalah ...', ['A' => 'Sistem tenaga listrik', 'B' => 'Teknik geologi', 'C' => 'Arsitektur', 'D' => 'Teknik pangan'], 'A', 'Sistem tenaga listrik mencakup pembangkitan, transmisi, distribusi, dan pemanfaatan energi listrik.'],
                    ['Komponen yang terutama digunakan untuk membatasi arus dalam rangkaian adalah ...', ['A' => 'Resistor', 'B' => 'Saklar mekanis', 'C' => 'Transformator', 'D' => 'Antena'], 'A', 'Resistor memberikan hambatan listrik dan dapat digunakan untuk membatasi arus sesuai Hukum Ohm.'],
                    ['Transformator konvensional bekerja dengan prinsip ...', ['A' => 'Induksi elektromagnetik', 'B' => 'Pemuaian termal', 'C' => 'Efek fotolistrik saja', 'D' => 'Gaya apung'], 'A', 'Perubahan fluks magnet pada kumparan primer menginduksi tegangan pada kumparan sekunder.'],
                    ['Arus bolak-balik (AC) memiliki ciri utama ...', ['A' => 'Arah arus selalu tetap', 'B' => 'Arah dan nilainya berubah secara periodik', 'C' => 'Tidak dapat menyalakan motor', 'D' => 'Selalu bernilai nol'], 'B', 'Arus AC berubah arah dan besar secara periodik, misalnya pada jaringan listrik rumah.'],
                    ['Untuk mengukur tegangan pada suatu komponen, multimeter idealnya dipasang ...', ['A' => 'Secara seri dengan komponen', 'B' => 'Secara paralel pada komponen', 'C' => 'Tanpa menyentuh rangkaian', 'D' => 'Menggantikan sumber tegangan'], 'B', 'Tegangan diukur di antara dua terminal komponen, sehingga voltmeter dipasang paralel.'],
                ],
            ],
            'gambar-teknik' => [
                'Gambar Teknik',
                [
                    ['Pada skala 1:50, panjang garis pada gambar 4 cm. Berapa panjang benda sebenarnya?', ['A' => '20 cm', 'B' => '50 cm', 'C' => '2 m', 'D' => '20 m'], 'C', 'Panjang sebenarnya = 4 cm × 50 = 200 cm = 2 m.'],
                    ['Jenis garis yang umum digunakan untuk menunjukkan tepi benda yang tidak terlihat adalah ...', ['A' => 'Garis putus-putus', 'B' => 'Garis kontinu tebal', 'C' => 'Garis kontinu tipis', 'D' => 'Garis bebas bergelombang'], 'A', 'Garis putus-putus tipis digunakan untuk menggambarkan bagian atau tepi yang tersembunyi.'],
                    ['Gambar proyeksi ortogonal biasanya menyajikan ...', ['A' => 'Satu tampilan perspektif saja', 'B' => 'Tampak depan, atas, dan samping', 'C' => 'Warna bahan benda', 'D' => 'Urutan perakitan saja'], 'B', 'Proyeksi ortogonal menggambarkan beberapa tampak dua dimensi yang saling tegak lurus.'],
                    ['Apa fungsi utama garis ukuran pada gambar teknik?', ['A' => 'Menunjukkan warna benda', 'B' => 'Menunjukkan ukuran dan jarak bagian benda', 'C' => 'Menandai bagian yang rusak', 'D' => 'Menggantikan garis benda'], 'B', 'Garis ukuran bersama angka ukuran menyampaikan dimensi benda secara jelas.'],
                    ['Skala 1:1 pada gambar teknik berarti ...', ['A' => 'Gambar dua kali lebih besar dari benda', 'B' => 'Gambar setengah ukuran benda', 'C' => 'Ukuran gambar sama dengan ukuran sebenarnya', 'D' => 'Ukuran benda tidak diketahui'], 'C', 'Skala 1:1 adalah skala sebenarnya; satu satuan pada gambar mewakili satu satuan pada benda.'],
                ],
            ],
            'keselamatan-kesehatan-kerja' => [
                'Keselamatan dan Kesehatan Kerja',
                [
                    ['Sebelum memperbaiki panel listrik, tindakan pengamanan utama adalah ...', ['A' => 'Langsung menyentuh kabel', 'B' => 'Memutus sumber energi dan menerapkan penguncian/penandaan', 'C' => 'Menyiram panel dengan air', 'D' => 'Bekerja sendirian tanpa memberi tahu orang lain'], 'B', 'Isolasi energi dan prosedur lockout/tagout mencegah peralatan aktif kembali saat pekerjaan berlangsung.'],
                    ['Dalam hierarki pengendalian bahaya, langkah yang paling efektif adalah ...', ['A' => 'Menghilangkan sumber bahaya', 'B' => 'Mengandalkan alat pelindung diri saja', 'C' => 'Memasang tanda peringatan saja', 'D' => 'Mengabaikan bahaya berisiko rendah'], 'A', 'Eliminasi menghilangkan bahaya dari sumbernya dan berada pada tingkat paling efektif dalam hierarki pengendalian.'],
                    ['Alat pemadam yang sesuai untuk kebakaran pada peralatan listrik yang masih bertegangan adalah ...', ['A' => 'Air bertekanan', 'B' => 'Busa berbasis air', 'C' => 'CO₂ atau serbuk kering yang sesuai', 'D' => 'Kain basah'], 'C', 'CO₂ atau serbuk kering yang sesuai dapat digunakan pada kebakaran listrik; air dapat menghantarkan listrik.'],
                    ['Apa yang sebaiknya dilakukan saat melihat kejadian nyaris celaka (near miss)?', ['A' => 'Menyembunyikannya karena tidak ada korban', 'B' => 'Melaporkannya agar bahaya dapat dievaluasi', 'C' => 'Menunggu kejadian terulang', 'D' => 'Menghapus catatan kerja'], 'B', 'Pelaporan near miss membantu menemukan dan mengendalikan risiko sebelum menimbulkan cedera atau kerusakan.'],
                    ['Pemilihan alat pelindung diri (APD) yang tepat harus didasarkan pada ...', ['A' => 'Warna yang paling menarik', 'B' => 'Jenis bahaya dan hasil penilaian risiko', 'C' => 'Harga paling murah saja', 'D' => 'APD yang digunakan teman'], 'B', 'APD harus sesuai dengan bahaya yang dinilai, cara kerja, dan standar keselamatan yang berlaku.'],
                ],
            ],
            'laboratorium-fisika-dasar' => [
                'Laboratorium Fisika Dasar',
                [
                    ['Skala utama jangka sorong bernilai 1 mm per divisi. Jika 10 divisi nonius sama dengan 9 mm, ketelitian alat tersebut adalah ...', ['A' => '1 mm', 'B' => '0,9 mm', 'C' => '0,1 mm', 'D' => '0,01 mm'], 'C', 'Satu divisi nonius = 9/10 mm = 0,9 mm. Ketelitian = 1 mm - 0,9 mm = 0,1 mm.'],
                    ['Mengapa pengukuran berulang dilakukan dalam praktikum?', ['A' => 'Agar hasil selalu sama persis', 'B' => 'Untuk mengurangi pengaruh kesalahan acak melalui analisis data', 'C' => 'Untuk mengubah satuan alat', 'D' => 'Agar alat ukur menjadi lebih teliti'], 'B', 'Pengukuran berulang membantu memperkirakan nilai rata-rata dan menilai sebaran akibat kesalahan acak.'],
                    ['Sebuah mistar analog memiliki skala terkecil 1 mm. Ketidakpastian pembacaan sederhana umumnya diperkirakan sebesar ...', ['A' => '±0,1 mm', 'B' => '±0,5 mm', 'C' => '±1 cm', 'D' => '±5 mm'], 'B', 'Untuk pembacaan alat analog, ketidakpastian sederhana sering diambil setengah skala terkecil, yaitu ±0,5 mm.'],
                    ['Alat yang paling tepat untuk mengukur diameter luar sebuah silinder kecil adalah ...', ['A' => 'Jangka sorong', 'B' => 'Stopwatch', 'C' => 'Neraca pegas', 'D' => 'Termometer'], 'A', 'Rahang luar jangka sorong dirancang untuk mengukur dimensi luar seperti diameter silinder.'],
                    ['Panjang 0,25 m setara dengan ...', ['A' => '2,5 cm', 'B' => '25 cm', 'C' => '250 cm', 'D' => '2500 cm'], 'B', 'Satu meter sama dengan 100 cm, sehingga 0,25 m = 25 cm.'],
                ],
            ],
        ];

        foreach ($subjects as $slug => [$name, $questions]) {
            foreach ($questions as $index => [$prompt, $choices, $answer, $explanation]) {
                QuizQuestion::updateOrCreate(
                    [
                        'subject_slug' => $slug,
                        'question_number' => $index + 1,
                    ],
                    [
                        'subject_name' => $name,
                        'prompt' => $prompt,
                        'choices' => $choices,
                        'correct_answer' => $answer,
                        'explanation' => $explanation,
                    ]
                );
            }
        }
    }
}
