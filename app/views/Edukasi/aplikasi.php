<style>
        .custom-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-card img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .custom-card-body {
            padding: 20px;
        }

        .custom-card-text {
            color: #555;
            font-size: 14px;
        }

        .custom-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }
    </style>
<div class="container mt-5">
    <div class="card custom-card">
            <img src="<?= BASEURL;?>assets/img/edukasi/aplikasi.png" class="card-img-top" alt="Image description">
            <div class="custom-card-body mb-4">
                <h5 class="card-title">Aplikasi Manajemen Sampah DISAPU</h5>
                <p class="text-muted">PPk Ormawa UKM Jurnalistik &bull; DISAPU</p>

                <!-- pengertian -->
                <ol>
                    <li>
                        <h3>Pengertian</h3>
                    </li>
                </ol>
                    <p class="custom-card-text" align="justify">
                        <b>DISAPU</b> adalah platform edukasi dan pengelolaan sampah dalam bentuk web apps yang bertujuan membantu warga Desa Purworejo dalam membantu dan mengelola sampah yang mereka hasilkan dengan cara yang lebih baik. DISAPU dirancang tidak hanya untuk mengelola sampah tetapi juga menjadi platform yang edukatif dan interaktif dengan desain yang menarik dengan menerapkan teknologi yang user-friendly dan up-to-date.
                    </p>
                    <p class="custom-card-text" align="justify">
                        Pengguna dapat menggunakan aplikasi ini untuk mendapatkan berbagai keuntungan seperti menjual dan membeli sampah dalam berbagai kategori sampah yang ada pada web apps, membaca artikel tentang lingkungan dan saku digital. Dengan menggunakan aplikasi ini diharapkan masyarakat dapat belajar dan mendapatkan ilmu serta mengelola sampah rumah tangganya dengan lebih baik.
                    </p>
                    <p class="custom-card-text" align="justify">
                        Aplikasi ini juga menyediakan fitur edukasi, pengelolaan sampah, dan penjualan sampah. Memanfaatkan web apps ini menawarkan kemudahan akses untuk menerima sampah dari masyarakat dan jasa lingkungan, yang nantinya akan diolah menjadi barang yang bermanfaat bagi lingkungan seperti budidaya maggot dan pupuk organik cair(POC). Ini adalah aplikasi yang memperjuangkan pengelolaan sampah di Indonesia melalui 3R (reuse, reduce, recycle) yang diharapkan dapat membantu dalam segi kebersihan lingkungan.
                    </p>

                <!-- FITUR -->
                <ol start="2">
                    <li>
                        <h3>Fitur</h3>
                    </li>
                </ol>
                <img src="<?= BASEURL;?>assets/img/edukasi/fitur.png" class="h-150 w-150" alt="Gambar Bahan dan Alat POC">
                <p class="custom-card-text" align="justify">
                    Fitur yang disediakan yaitu:
                    <ol>
                        <li>Edukasi Sampah</li>
                            <p>Fitur yang menyediakan artikel guna menambah wawasan dalam pengelolaan sampah</p>
                        <li>Market/Tukar Poin</li>
                            <p>Fitur yang menyediakan barang-barang yang dapat ditukarkan setelah mengumpulkan target poin yang sediakan oleh hadiah. Fitur ini menggunakan sistem checkout seperti belanja online</p>
                        <li>Sampah</li>
                            <p>Fitur yang menyediakan gambar sampah beserta poin tukarnya sehingga warga dapat memilah sampah yang laku dijual dalam aplikasi DISAPU</p>
                    </ol>
                </p>


            <div class="custom-card-footer">
                <span class="text-muted">❤️ 650</span>
            </div>
        </div>
    </div>
</div>