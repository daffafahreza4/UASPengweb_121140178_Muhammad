# Spesifikasi Laptop - Project Tugas Besar Pemrograman Web

## Identitas

- **Nama:** Muhammad Daffa Fahreza
- **NIM:** 121140178
- **Username GitHub:** DaffaFahreza

## Deskripsi Proyek

Proyek ini adalah aplikasi web sederhana yang bertujuan untuk menambahkan data spesifikasi laptop ke dalam database. Beberapa fitur utama dari proyek ini melibatkan penanganan formulir input, validasi data, serta penyimpanan dan pengambilan data dari database MySQL. Aplikasi ini dibangun menggunakan bahasa pemrograman PHP dan MySQL sebagai sistem manajemen basis data.

## Link Halaman Web

- Link dari website spesifikasi laptop (http://spesifikasilaptop.kesug.com/login.php)

## Bagian 1: Client-side Programming (Bobot: 30%)

- Saya menerapkan DOM pada file `index.php`, dan `tambah.php` dengan kegunaan memberikan day mode dan night mode pada tampilan lalu saya juga membuat untuk melakukan validasi input sebelum diproses oleh PHP

- Saya juga mebuat 2 element input yang jumlahnya 7 pada file `index.php`


## Bagian 2: Server-side Programming (Bobot: 30%)

### 2.1 Script PHP untuk Pengolahan Data

- Saya menerapkan metode POST atau GET pada file.php yang saya buat sebagai contoh file nya adalah `delete.php`, `edit.php`, `register.php`, `tambah.php`. dengan tujuan mengirim dan menerima data antara halaman web dan server.

### 2.2 Objek PHP Berbasis OOP

- Saya juga membuat objek PHP berbasis OOP dan bisa di cek pada file.php yang sudah saya buat.

## Bagian 3: Database Management (Bobot: 20%)

### 3.1 Tabel pada Database MySQL

- Saya melakukan pembuatan basis data dengan media localhost/phpmyadmin dengan menggunakan syntax create tabel dan insert into

### 3.2 Konfigurasi Koneksi ke Database

- Saya juga membuat koneksi ke 2 database yang saya buat pada file php yang saya kerjakan.`

### 3.3 Manipulasi Data pada Tabel Database

- Saya juga memberlakukan manipulasimdata berupa penambahan, pembaruan, dan penghapusan pada tabel yang sudah saya buat melalui file `login.php`, `create.php`, `edit.php`, `create.php`, `tambah.php`, `delete.php`. `register.php`. 

## Bagian 4: State Management (Bobot: 20%)

### 4.1 Skrip PHP dengan Session

- Saya melakukan penerapan  `session_start()` pada `login.php`, `logout.php`, dan `index.php` yang bertujuan untuk menyimpan dan mengelola state user.

### 4.2 Pengelolaan State menggunakan Cookie dan Browser Storage

- Saya melakukan penerapan Cookie dan Browser Storage pada`tambah.php`, `registrasi.php`, dan `index.php` yang bertujuan untuk menyimpan dan mengelola state user.

## Bonus: Hosting Aplikasi Web (Bobot Tambahan: 20%)

### Langkah-langkah Meng-host Aplikasi Web

1. **Pendaftaran Akun:**

   - Mendaftar dan membuat akun di infinityfree.

2. **Upload File:**

   - Mengupload file proyek, termasuk file PHP, CSS, dan JavaScript ke dalam direktori yang sesuai di InfinityFree Manager. (Usahakan upload file 1 per 1 agar tidak terjadi error)

3. **Upload Database:**

   - Mengupload fie database ke dalam direktori yang sesuai di InfinityFree Manager.

4. **Konfigurasi Koneksi Database:**

   - Pastikan konfigurasi pada tiap-tiap file sudah sesuai dari konfigurasi yang diberikan oleh InfinityFree seperti MYSQL USERNAME, MYSQL DATABASE NAME,  MYSQL PASSWORD, dan  MYSQL HOSTNAME.

5. **Testing:**
   - Setelah berhasil terkoneksi langsung uji coba website yang berhasil di hosting.

### Pemilihan Penyedia Hosting Web

Saya memilih Infityfree karena:

- **Mudah Digunakan:** Saya memilih website Infinityfree karena lebih mudah digunakan dari website yang lain dan juga koneksi dari site Infinityfree stabil.

- **Gratis:** Website Infinityfree menyediakan layanan hosting gratis dengan cara hanya harus melakukan login dan ini sangat membantu bagu proyek website uji coba.


### Keamanan Aplikasi Web

Beberapa langkah yang saya terapkan untuk memastikan keamanan aplikasi web:

- **Pengelolaan sandi:** Sandi yang kuat untuk akun-akun server, basis data, dan bagian lainnya karena kata sandi dibuat random saat digunakan.

- **Pengelolaan izin:** Memberikan pengelolaan hanya untuk pengguna yang berwenang atas file.

- **Enkripsi Data:** Enkripsi data sensitif, baik dalam repositori basis data maupun selama transmisi.

### Konfigurasi Server

Penyedia layanan web hosting, InfinityFree, telah mengkonfigurasi server untuk mendukung aplikasi web. Beberapa konfigurasu server yang saya gunakan adalah alamat website dan konfigurasi database website.
