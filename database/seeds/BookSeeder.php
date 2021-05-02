<?php

use App\Book;
use App\Category;
use App\Media;
use App\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'genre'  => 'Roman',
                'book' => [
                    'title' => '9 Matahari',
                    'writer' => 'Adenita',
                    'year' => '2008',
                    'publisher' => 'Grasindo',
                    'number_of_pages' => '362',
                    'description' => 'Novel 9 Matahari yang ditulis oleh Adenita sempat hit sepanjang 2009. Novel ini sangat inspiratif, bisa dibaca oleh anak muda yang sedang menuntut ilmu. Sebuah kisah yang menceritakan seseorang bernama Matari. Pemuda yang memiliki semangat menimba ilmu di tengah kesulitan ekonomi keluarga. Seorang yang mengejar mimpinya untuk lulus sarjana Ilmu Komunikasi. Di tengah perkuliahannya, Matari dihadapkan berbagai rintangan yang pahit. Beruntung, saat ia sedang kesusahan, kelaparan hingga depresi, Matari bertemu penolongnya yakni keluarga Seruling. Novel yang terbit pada November 2008 ini  memiliki banyak pesan moral yang tersirat di dalamnya. Bahasa yang ringan membuat anak muda wajib membaca novel ini. Novel dengan 362 halaman itu juga mengingatkan kita untuk terus berusaha dan yang membuatnya nyata adalah Tuhan YME.'
                ]
            ],
            [
                'genre'  => 'Bisnis',
                'book' => [
                    'title' => '30 Hari Jago Jualan',
                    'writer' => 'Dewa Eka Prayoga',
                    'year' => '2014',
                    'publisher' => 'Delta Saputra',
                    'number_of_pages' => '160',
                    'description' => 'Ketakutan dan anggapan mengenai jualan itu sulit, nyatanya dipatahkan oleh Dewa Eka Prayoga dalam Buku 30 Hari Jago Jualan. Proses menjual produk agar bisa mencapai omzet hingga milyaran dijelaskan dengan sangat lengkap dan praktikal. Anggapan “menjual itu sulit” hilang dengan seketika jika Anda sudah membaca buku ini. Bahkan penulisnya membagikan 30 trik penjualan yang bisa membuat Anda kewalahan menerima pesanan setelah mempraktekannya.'
                ]
            ],
            [
                'genre'  => 'Biografi',
                'book' => [
                    'title' => 'Agus Salim: Diplomat Jenaka Penopang Republik',
                    'writer' => 'Tim Buku Tempo',
                    'year' => '2013',
                    'publisher' => 'Kepustakaan Populer Gramedia',
                    'number_of_pages' => '178',
                    'description' => 'Menuliskan sejarah dengan pendekatan jurnalistik, tentu gaya menarik khas jurnalis, tapi tetap mempertimbangkan keakuratan. Tujuan jurnalisme adalah mengetengahkan fakta yang menarik, dramatik, tanpa mengabaikan presisi. Tulisan ini menceritakan kisah Agus Salim yang menarik, kita bisa melihat hal-hal yang unik dari gaya hidup beliau. Buku ini begitu ringkas, padat dan efektif, untuk menceritakan seorang tokoh dengan fokus yang tepat. Agus Salim tokoh nasional/pergerakan yang hanya memiliki 1 kelemahan yaitu dia hidup dalam kemelaratan. Memimpin jalan untuk menderita, Agus Salim adalah otak dan hatinya Indonesia.'
                ]
            ],
            [
                'genre'  => 'Islam',
                'book' => [
                    'title' => 'Ayat-ayat Semesta',
                    'writer' => 'Agus Purwanto',
                    'year' => '2015',
                    'publisher' => 'Islam',
                    'number_of_pages' => '450',
                    'description' => 'Mengomentari judul dari buku ini Ayat-Ayat Semesta, Sisi Al Quran Yang Terlupakan. Tentu judul tersebut sekaligus menyindir dengan keras ternyata umat Islam khususnya para ilmuan dan ulama serta para pemimpin di pemerintahan sudah terbuai dengan hal-hal lain yang seoalah ilmiah. Pseudo-ilmiah. Sementara di dalam kitab Al-Quran yang ilmiah sebagai wahyu yang diturunkan oleh Allah justru sudah terukir dimensi-dimensi semesta yang tak terhingga. Namun justru manusia lupa akan hal itu.'
                ]
            ],
            [
                'genre'  => 'Sains',
                'book' => [
                    'title' => 'CODEX, Konspirasi Jahat di Atas Meja Makan Kita',
                    'writer' => 'Rizki Ridyasmara',
                    'year' => '2010',
                    'publisher' => 'Pustaka Al Kautsar',
                    'number_of_pages' => '432',
                    'description' => 'Tahukah Anda jika Vaksin, Obat-Obatan Medis, banyak Makanan, dan Minuman, ternyata disusupi RACUN yang sengaja dibuat untuk membunuh kita? Tahukah Anda, untuk menipu konsumen, MSG punya 20-an nama yang berbeda? Tahukah Anda jika pemanis buatan Aspartame adalah racun bagi tubuh? Tahukah Anda jika berbagai jenis vaksin yang disuntikkan ke tubuh manusia terbuat dari bahan-bahan berbahaya dan menjijikan? Tahukah Anda jika ratusan saintis dunia tewas selama dua dekade terkahir ini? Jika Anda masih tidak percaya dan menyodorkan banyak analisa yang menyangkal semua ini, maka Anda telah ditipu habis-habisan oleh Disinformation Unit CIA yang memang bekerja untuk menipu dunia. Novel ini akan mengubah pandangan hidup Anda agar lebih sehat dan waspada.'
                ]
            ],
            [
                'genre'  => 'Fiksi',
                'book' => [
                    'title' => 'Dunia Shopie',
                    'writer' => 'Jostein Gaarder',
                    'year' => '2010',
                    'publisher' => 'Mizan',
                    'number_of_pages' => '798',
                    'description' => 'Novel karya Jostein Gaarder ini adalah sebuah novel berkaitan sejarah filsafat sejak awal perkembangan dari era Socrates di Yunani hingga Freud di abad kedua puluh ini. Buku tersebut pertama kali terbit dengan bahasa Norwegia dengan judul Sofie’s Verden. Buku ini termasuk deretan karya terlaris, mencapai megabestseller international. Novel dengan latar belakang filsafat ini cukup memberi angin segar kepada pembacanya, karena selama ini, di filsafat yang dipandang sulit dan berat untuk dipelajari ternyata bisa disampaikan dengan bahasa yang sederhana dan mudah dicerna.'
                ]
            ],
            [
                'genre'  => 'Biografi',
                'book' => [
                    'title' => 'Merry Riana (Mimpi Sejuta Dolar)',
                    'writer' => 'Alberthiene Endah',
                    'year' => '2011',
                    'publisher' => 'Gramedia Pustaka Utama',
                    'number_of_pages' => '362',
                    'description' => 'Buku ini berkisah tentang perjalanan hidup Merry Riana saat kuliah di Singapura dengan segala keterbatasan ekonomi yang ada. Kondisi tersebut memaksanya untuk kuliah sambil bekerja. Namun semua kondisi tersebut tidak menyurutkan semangat Merry Riana. Gadis ini bahkan berani membuat impian untuk menggapai kebebasan finansial sebelum usianya menapak 30 tahun.'
                ]
            ],
            [
                'genre'  => 'Self Improvement',
                'book' => [
                    'title' => 'Never Eat Alone',
                    'writer' => 'Keith Ferrazi',
                    'year' => '2011',
                    'publisher' => 'GagasMedia',
                    'number_of_pages' => '394',
                    'description' => 'Kunci utama menuju kesuksesan ternyata bukan sekadar apa yang kita ketahui, tetapi juga siapa yang kita kenal.  Keith Ferrazzi, Sang Jagoan Networking, lewat Never Eat Alone, membongkar semua tip dan triknya dalam membangun jejaring (networking). Dapatkan semua rahasia untuk membangun pertemanan dan memenangkan hati para CEO top dunia lewat buku ini. Never Eat Alone adalah salah satu buku terlaris dunia yang mengupas tuntas langkah-langkah detail–juga pemahaman baru–yang bisa digunakan untuk merangkul banyak orang, mulai dari teman, kolega, hingga klien. Keith Ferrazzi menyaring pengalamannya membangun jejaring ke dalam buku yang praktis dan telah terbukti bisa dipraktikkan.'
                ]
            ],
            [
                'genre'  => 'Fiksi',
                'book' => [
                    'title' => 'Orang-orang Biasa',
                    'writer' => 'Andrea Hirata',
                    'year' => '2019',
                    'publisher' => 'Bentang Pustaka',
                    'number_of_pages' => '300',
                    'description' => 'Andrea Hirata akhirnya meluncurkan karyanya yang ke-10 di awal tahun 2019. Buku fiksi berjudul "Orang-orang Biasa" ini menarik perhatian banyak kalangan. Menceritakan sebuah kisah di suatu pulau yang tentram, aman, jauh dari permasalahan politik, dan tindak kriminal.  Pulau Belantik namanya, selama bertahun-tahun seorang inspektur dari kepolisian menganggur sebab tidak pernah ada laporan tindak kejahatan di pulau tersebut, bahkan maling ayam pun tidak pernah ada. Entah karena memang benar tidak ada atau justru kejahatan itu berhasil bersembunyi. Sama seperti novel-novel sebelumnya, Orang-orang Biasa menceritakan kisah-kisah kaum marginal.'
                ]
            ],
            [
                'genre'  => 'Self Improvement',
                'book' => [
                    'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
                    'writer' => 'Mark Manson',
                    'year' => '2018',
                    'publisher' => 'Self Improvement',
                    'number_of_pages' => '246',
                    'description' => 'Buku ini merupakan buku terlaris versi New York Times dan Globe and Mail, penulisnya adalah Mark Manson seorang blogger terkenal dengan berjuta-juta pembaca. Buku ini merupakan buku pengembangan diri yang mengulas fakta-fakta seputar kehidupan sosial. Seorang blogger superstar menunjukkan pada kita bahwa kunci untuk menjadi orang yang lebih kuat, lebih bahagia adalah dengan mengerjakan segala tantangan dengan lebih baik dan berhenti memaksa diri untuk menjadi "positif" di setiap saat.'
                ]
            ],
            [
                'genre'  => 'Sains',
                'book' => [
                    'title' => 'The Grand Design',
                    'writer' => 'Stephen Hawking',
                    'year' => '2010',
                    'publisher' => 'Gramedia',
                    'number_of_pages' => '206',
                    'description' => 'Bagaimana kita bisa memahami dunia tempat kita mendapati diri kita ada? Bagaimana tingkah laku alam semesta? Apa hakikat kenyataan? Dari mana segalanya berasal? Apakah alam semesta memerlukan pencipta? Secara tradisional, semua yang tadi adalah pertanyaan filosofi, tapi filosofi sudah mati. Filosofi sudah tidak mengimbangi kemajuan terkini dalam sains, terutama fisika. Para ilmuwan telah menjadi pemegang obor penemuan dalam perjalanan pencarian pengetahuan. Tujuan buku ini adalah memberi jawaban yang didukung penemuan terbaru dan kemajuan teoritis.'
                ]
            ],
            [
                'genre'  => 'Self Improvement',
                'book' => [
                    'title' => 'The Secret',
                    'writer' => 'Rhonda Byrne',
                    'year' => '2007',
                    'publisher' => 'Gramedia',
                    'number_of_pages' => '236',
                    'description' => 'The Secret (Rahasia) salah satu buku yang nampaknya pantas dikatakan ‘Rahasia’, buku ini mengisi hampir setiap kekosongan sikologis dalam aspek kehidupan. Rhonda Byrne dengan gamblang membahasakan ‘Rahasia’ yang sering kali tabu dalam kehidupan, sebuah kebiasaan tanpa sadar yang nyatanya mendatangkan akibat yang tidak diharapakan. ‘Rahasia’ ini telah diketahui ratusan tahun lalu oleh manusia-manusia luar biasa dalam sejarah: Plato, Shakespeare, Newton, Lincoln, Edison, Einstein. Buku ini merupakan ‘Rahasia’ kolektif dari orang-orang yang mengetahuinya, Bob Proctor (Filsuf), Dr. Joe Vitale (Metafisikawan), John Assaraf (Ahli Pengolah Keuangan), Dr. Denis Waitley (Psikolog), Jack Canfield (Penulis Chiken Soup) dan banyak lainnya.'
                ]
            ],
            [
                'genre'  => 'Puisi',
                'book' => [
                    'title' => 'Tidak Ada New York Hari Ini',
                    'writer' => 'M Aan Mansyur',
                    'year' => '2016',
                    'publisher' => 'Gramedia',
                    'number_of_pages' => '120',
                    'description' => 'Tidak Ada New York Hari ini merupakan kumpulan sajak yang di mana puisi dan foto Rangga dalam buku ini digunakan untuk film Ada Apa Dengan Cinta 2. Di samping puisi, buku ini banyak terdapat foto bertema street photography yang diabadikan oleh Mo Riza di New York. Dengan adanya foto, pembaca akan terus dialirkan pada puisi-puisi berikutnya.'
                ]
            ],
            [
                'genre'  => 'Self Improvement',
                'book' => [
                    'title' => 'Your Job is Not Your Career & Career Snippet',
                    'writer' => 'Rene Suhardono',
                    'year' => '2012',
                    'publisher' => 'Literati',
                    'number_of_pages' => '162 & 191',
                    'description' => 'Pembuka dalam buku Your Job is Not Your Career diawali dengan 3 pertanyaan, yaitu "are you happy with your career?", "are you happy with your life?", dan "do you care?". Jika pertanyaan tersebut ditujukan kepada anda, apa jawaban anda?  Mungkin bagi sebagian besar orang akan menjawab cukup senang dan baik-baik saja jika perkerjaannya berjalan lancar, dan kebutuhan ekonomi cukup terpenuhi. Karena pada dasarnya pekerjaan atau karier yang kita pilih dalam kehidupan ini untuk mendapatkan penghasilan, dan memenuhi kebutuhan ekonomi. Berapa banyak orang yang bekerja hanya untuk mendapatkan penghasilan dan jabatan yang dianggap mereka sebagai karier? Padahal, pekerjaan (job) dan karier (career) adalah hal yang berbeda. Buku ini memberikan definisi dan deskripsi mengenai job dan career. Serta membantu pembaca untuk menemukan karier yang sesuai dengan memahami hal-hal mendasar mengenai karier.'
                ]
            ],
        ];

        $books = collect($books);
        $owners = User::pluck('id')->toArray();

        foreach ($books as $book) {
            $category = Category::updateOrCreate(['category' => $book['genre']], [
                'category' => $book['genre']
            ]);

            $param_book = $book['book'];
            $param_book['viewer'] = rand(0, 10);
            $param_book['category_id'] = $category->id;
            $param_book['owner_id'] = $owners[array_rand($owners)];
            $model_book = Book::create($param_book);

            Media::create([
                'model_type' => Book::class,
                'model_id' => $model_book->id,
                'filename' => 'uploads/books/'.$book['book']['title'].'.jpeg'
            ]);
        }
    }
}
