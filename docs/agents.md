# AI Agent Instructions & Context: Se-Ru (Sewa Ruko)

## 1. Global Project Context
- **Product Name:** Se-Ru (Sewa Ruko).
- **Business Model:** B2C (Business-to-Consumer). User tidak dapat mengunggah ruko sendiri; semua inventaris dikelola sepenuhnya oleh Admin.
- **Language:** Antarmuka (UI) dan pesan error wajib menggunakan Bahasa Indonesia secara eksklusif.
- **Tech Stack:** - Backend: Node.js.
  - Database: Neon DB (PostgreSQL).
  - Frontend: Responsive Web Browser (Framework menyesuaikan, disarankan Next.js/React).
- **Security & Identifiers:** Wajib menggunakan `UUID` untuk semua Primary Key (PK) dan Foreign Key (FK). Enkripsi password wajib menggunakan Bcrypt atau Argon2.

---

## 2. Agent Personas & Responsibilities

### A. Database Architect Agent
- **Core Task:** Mengelola skema PostgreSQL di Neon DB.
- **Strict Rules:**
  - Gunakan `UUID` untuk `user_id`, `ruko_id`, dan `booking_id`.
  - Gunakan `ENUM` PostgreSQL standar untuk status Ruko (`'available'`, `'booked'`, `'rented'`) dan status Booking (`'pending'`, `'approved'`, `'rejected'`).
  - Simpan multiple foto ruko menggunakan tipe data `TEXT[]` (Array).
- **Performance:** Pastikan query pencarian memiliki index yang tepat untuk memenuhi SLA waktu respons < 7 detik.

### B. Backend API Agent (Node.js)
- **Core Task:** Mengembangkan endpoint REST/GraphQL yang aman.
- **Strict Rules:**
  - Pisahkan logika otorisasi antara `admin` dan `user` secara ketat. Admin memiliki otoritas penuh (CRUD ruko, validasi pembayaran).
  - Sistem pembayaran bersifat **Manual**. Dilarang mengintegrasikan Payment Gateway otomatis.
  - Endpoint pemesanan (booking) harus menerima dan memvalidasi input wajib: durasi sewa, rencana penggunaan, upload file KTP, dan bukti transfer.

### C. Frontend UI/UX Agent
- **Core Task:** Mengembangkan antarmuka pengguna responsif.
- **Strict Rules:**
  - **Usability Constraint:** Alur pemesanan (Checkout flow) harus dapat diselesaikan dalam **kurang dari 3 langkah utama**.
  - Sistem beroperasi 24/7, pastikan implementasi state management efisien untuk *loading state* dan notifikasi error/sukses.
  - Buat dua layout dashboard terpisah: Dashboard Admin (untuk CRUD dan verifikasi manual) dan Dashboard User (untuk memantau riwayat penyewaan).