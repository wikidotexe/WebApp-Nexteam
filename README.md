![Logo NFEH](https://github.com/user-attachments/assets/4f456538-9d1e-4b5d-b4b4-bd2a99727b91)


# Landing-page

[![GitHub Stars](https://img.shields.io/github/stars/wikidotexe/Landing-page?style=social)](https://github.com/wikidotexe/Landing-page/stargazers)
[![GitHub Forks](https://img.shields.io/github/forks/wikidotexe/Landing-page?style=social)](https://github.com/wikidotexe/Landing-page/network)

Landing-page ini dirancang untuk menampilkan informasi tim kami dengan antarmuka yang menarik, responsif, dan user-friendly.

> **Project Status**: 🚀 Sedang Aktif Dikembangkan

---

## 🔍 **Fitur Utama**

-   📋 **Struktur Folder Laravel**:
    -   `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, dll.
-   🌐 **Frontend Modern**:
    -   Desain antarmuka responsif dengan **CSS** dan **Blade Templating**.
-   ⚙️ **Backend Robust**:
    -   Framework Laravel sebagai pondasi backend.
-   🔒 **Keamanan**:
    -   File `.env` diatur untuk menyimpan data sensitif.
-   🚀 **Mudah Dideploy**:
    -   Didukung oleh konfigurasi yang memungkinkan integrasi mulus dengan platform deployment seperti Vercel.

---

## 📂 **Struktur Proyek**

```
Landing-page/
├── api/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .editorconfig
├── .env.example
├── .gitignore
├── .vercelignore
└── README.md
```

---

## 🎯 **Cara Install**

1. **Clone Repository**:

    ```bash
    git clone https://github.com/wikidotexe/Landing-page.git
    cd Landing-page
    ```

2. **Install Dependencies**:
   Pastikan Anda sudah menginstal [Composer](https://getcomposer.org/).

    ```bash
    composer install
    ```

3. **Setup Environment**:
   Salin file `.env.example` ke `.env` dan sesuaikan dengan konfigurasi lokal Anda.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Migrasi Database**:
   Pastikan koneksi database sudah diatur di file `.env`.

    ```bash
    php artisan migrate
    ```

5. **Run Development Server**:
   Jalankan server lokal menggunakan perintah berikut:

    ```bash
    php artisan serve
    ```

    Kemudian buka `http://127.0.0.1:8000` di browser Anda.

---

## 🚀 **Kontribusi**

Kami sangat mengapresiasi kontribusi dari siapa pun. Ikuti langkah-langkah berikut untuk berkontribusi:

1. Fork repositori ini.
2. Buat branch fitur baru:
    ```bash
    git checkout -b fitur-keren
    ```
3. Commit perubahan Anda:
    ```bash
    git commit -m "Menambahkan fitur keren"
    ```
4. Push ke branch Anda:
    ```bash
    git push origin fitur-keren
    ```
5. Buat **Pull Request** di GitHub.

---

## 📜 **Lisensi**

Proyek ini menggunakan lisensi MIT. Lihat detailnya di [LICENSE](LICENSE).

---

## 🌟 **Terima Kasih**

Terima kasih sudah mengunjungi repositori ini! Jangan lupa untuk memberikan ⭐ jika Anda merasa proyek ini bermanfaat.
