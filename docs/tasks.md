# Development Task Board: Se-Ru Project

## Phase 1: Database Setup & Configuration (Neon DB - PostgreSQL)
- [x] **1.1 Database Connection:** Konfigurasi koneksi ke Neon DB (Success).
- [x] **1.2 Migration - Users:** Buat tabel `users` dengan `user_id` (UUID, PK), `email` (Unique), `password` (VARCHAR hashed), dan `role` (ENUM: 'admin', 'user')[cite: 41].
- [x] **1.3 Migration - Ruko:** Buat tabel `ruko` dengan `ruko_id` (UUID, PK), `name`, `address`, `price` (NUMERIC), `status` (ENUM), dan `photos` (TEXT Array)[cite: 43].
- [x] **1.4 Migration - Bookings:** Buat tabel `bookings` dengan `booking_id` (UUID, PK), FK ke `user_id` dan `ruko_id`, kolom `transfer_proof`, dan `status` (ENUM)[cite: 45].

## Phase 2: Authentication & Security 
- [x] **2.1 Hash Implementation:** Setup fungsi hashing Bcrypt/Argon2 sebelum simpan ke DB[cite: 48].
- [x] **2.2 Auth Endpoints:** Buat API Register dan Login (SKPL-SR-01) dengan JWT/Session[cite: 24].
- [x] **2.3 User Profile:** Implementasi fitur update informasi kontak dasar untuk pengguna[cite: 25].

## Phase 3: Admin & B2C Product Management
- [x] **3.1 Ruko CRUD API:** Implementasi Create, Read, Update, Delete khusus role 'admin' (SKPL-SR-02 & 03)[cite: 34].
- [x] **3.2 File Upload Setup:** Konfigurasi *storage* lokal atau *cloud* untuk menerima unggahan array foto properti[cite: 43].
- [x] **3.3 Admin Dashboard UI:** Buat tampilan tabel/grid untuk admin mengelola inventaris dan ketersediaan unit ruko[cite: 17].

## Phase 4: User Catalog & Discovery
- [x] **4.1 Search Engine:** Buat fungsi pencarian ruko berdasarkan nama daerah, kata kunci, atau kategori (SKPL-SR-04)[cite: 27].
- [x] **4.2 Filter Logic:** Implementasi filter berdasarkan rentang harga dan lokasi[cite: 28].
- [x] **4.3 Detail Page UI:** Bangun halaman detail ruko yang menampilkan galeri foto, deskripsi fasilitas, legalitas, dan status ketersediaan[cite: 29].
- [x] **4.4 Performance Check:** Uji SLA pencarian untuk memastikan response time < 7 detik[cite: 50].

## Phase 5: Booking & Manual Transaction System
- [x] **5.1 Booking Form UI:** Buat form dengan field: durasi sewa, rencana penggunaan, upload KTP, dan upload bukti transfer (SKPL-SR-05)[cite: 31].
- [x] **5.2 Booking Constraints:** Pastikan UI mendesain form ini agar selesai dalam maksimal 3 klik/langkah[cite: 49].
- [x] **5.3 File Upload Security:** Pastikan file KTP tersimpan dengan aman dan privasi terjamin[cite: 48].
- [x] **5.4 User Dashboard UI:** Buat halaman bagi user untuk memantau status pengajuan mereka (Pending, Approved, Rejected)[cite: 32].

## Phase 6: Admin Validation & Finalization
- [x] **6.1 Validation Dashboard UI:** Buat antarmuka bagi Admin untuk meninjau file KTP dan gambar bukti transfer (SKPL-SR-06)[cite: 35].
- [x] **6.2 Status Mutation:** Buat API bagi admin untuk mengubah status `bookings` dari 'pending' menjadi 'approved' atau 'rejected'[cite: 45].
- [x] **6.3 Auto-Sync Status:** Trigger perubahan `status` ruko secara otomatis menjadi 'rented' jika booking disetujui[cite: 43].
- [x] **6.4 Localization QA:** Pengecekan akhir untuk memastikan seluruh *copywriting* dan *error feedback* 100% menggunakan Bahasa Indonesia[cite: 53].