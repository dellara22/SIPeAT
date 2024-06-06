# Sistem Peminjaman Aula dan Teater FMIPA USK

Ini adalah Sistem Peminjaman Aula dan Teater dalam lingkup Fakultas Matematika dan Ilmu Pengetahuan Alam yang dapat memudahkan seluruh Mahasiswa maupun Dosen yang ada di FMIPA USK untuk meminjam ruangan baik aula maupun teater.

## Fitur
- Lihat Kalender Peminjaman
- Meminjam Aula dan Teater

### Peran Pengguna
- Home: Pengguna dapat melihat Kalender berisi jadwal aula yang dipinjam.
- Ruangan: Pengguna dapat melihat informasi tentang ruangan yang tersedia.
- Peminjaman: Pengguna dapat melakukan peminjaman ruangan.
- Profil: Pengguna dapat melihat informasi akun serta mengupdate data.

### Peran Admin
- Dashboard: Admin dapat melihat data ruangan, pengguna, jurusan, dan peminjaman.
- Data Ruangan: Admin dapat menambahkan, mengedit, serta menghapus ruangan.
- Manajemen User: Admin dapat menambahkan akun pengguna baru.
- Data Peminjaman: Admin dapat melihat, menambah, menyetujui, menolak, membatalkan, serta menghapus peminjaman.

## Instalasi

Untuk menginstal dan menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1. Clone repositori:
   bash
   git clone https://github.com/asans22/Sistem-Manajemen-klinik.git
   cd sistem-manajemen-klinik
   

2. Instal dependensi:
   bash
   composer install
   npm install
   

3. Salin file environment contoh dan konfigurasikan variabel lingkungan Anda:
   bash
   cp .env.example .env
   

4. Generate kunci aplikasi:
   bash
   php artisan key:generate
   

5. Jalankan migrasi database:
   bash
   php artisan migrate
   

6. Seed database (opsional):
   bash
   php artisan db:seed
   
7. Import database dari file sistem_manajemen_klinik.sql (opsional):
   bash
   -buka phpmyadmin
   -import file sistem_manajemen_klinik.sql
   

8. Kompilasi aset:
   bash
   npm run dev
   

9. Mulai server pengembangan lokal:
   bash
   php artisan serve
   

## Penggunaan

Setelah menyelesaikan langkah-langkah instalasi, Anda dapat mengakses aplikasi di http://localhost:8000. Bergantung pada peran yang diberikan kepada akun Anda, Anda akan memiliki akses ke fungsionalitas yang berbeda seperti yang dijelaskan di atas.

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan ikuti langkah-langkah berikut:

1. Fork repositori.
2. Buat branch baru (git checkout -b fitur/FiturAnda).
3. Commit perubahan Anda (git commit -am 'Tambahkan fitur baru').
4. Push ke branch (git push origin fitur/FiturAnda).
5. Buat Pull Request baru.

## Team members:
1. Ahmad Syah Ramadhan 2208107010033
2. Agil Mughni 2208107010025


## Kontak

Untuk pertanyaan atau saran, silakan hubungi saya di [ahmadsyahrmdn@gmail.com] atau rekan saya [agilmughni1@gmail.com].

---

README ini memberikan gambaran umum tentang Sistem Manajemen Klinik, instruksi instalasi, dan detail tentang cara menggunakan dan berkontribusi pada proyek ini. Jika Anda memiliki pertanyaan tambahan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi saya.
