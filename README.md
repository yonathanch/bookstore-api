Langkah- langkah menjalankan project:
- Buat database dengan nama "bookstore-api".
- Jalankan php artisan migrate.
- Jalankan php artisan db:seed.
- Jalankan php artisan serve.
- Cek Api Buka Postman dan ketika sesuai Url untuk get all data books kita seperti ini contohnya: http://127.0.0.1:8000/api/books dg request GET.

- Cek Api top author memakai request GET : http://127.0.0.1:8000/api/authors/top

- Untuk insert rating Api reqest POST : http://127.0.0.1:8000/api/ratings , misalnya insert data melalui post yaitu dan klik send:
    {
        "book_id": 4,
        "rating": 8
    }

- untuk cek front end kita hanya perlu melihat ke bagian website saja 

Catatan: sedikit lama karna memuat banyak data solusi yg saya gunakan sudah menggunakan bulk insert akan tetapi karna keterbatasan waktu saya akan mencari cara kedepannya untuk optimasi website.