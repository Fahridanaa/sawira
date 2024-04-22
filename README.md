### **Tentang Website**

---

> SAWIRA merupakan aplikasi e-government berbasis web yang dirancang untuk membantu memenuhi kebutuhan administrasi dan
> manajemen di lingkup RW, dengan tambahan beberapa fitur untuk memudahkan pengelolaan arsip, surat-menyurat, dan fitur
> pembagian zakat fitrah yang inovatif. Sistem ini dibangun dengan fokus pada kemudahan penggunaan dan pemberdayaan
> masyarakat, SAWIRA menjadi solusi terdepan bagi warga Villa Bukit Tidar dalam mengatasi berbagai kebutuhan mereka.

### **Anggota Tim**

---

- Ahmad Faza Alfan Fashlah (**Project Manager**)
- Fahridana Ahmad Rayyansyah (**Front-end Developer**)
- Hanief Mochsin (**Back-end Developer**)
- Rista Marlina Hutagaol (**UI/UX Designer**)

### **Tech Stack:**

---

- **[Laravel](https://laravel.com/docs/10.x/releases#laravel-10)**
- **[Bootstrap](https://getbootstrap.com/docs/5.3/getting-started/introduction/)**
- **[Mysql](https://dev.mysql.com/doc/refman/8.0/en/)**

### **Software Requirement:**

---
Sebelum menjalankan project ini, diwajibkan memiliki:

- **[Git](https://git-scm.com/downloads)**
- **[Composer](https://getcomposer.org/download/)**
- **[NodeJS](https://nodejs.org/en/download/current)**

### Do & Don't

---

1. Gunakan Aturan [conventional commit](https://www.conventionalcommits.org/en/v1.0.0/) ketika ingin
   menulis pesan commit:
    * `feat`: untuk fitur baru
    * `fix`: untuk perbaikan bug
    * `refactor`: untuk perubahan kode tanpa ada perubahan fungsi
    * `style`: untuk perubahan gaya/format kode tanpa ada perubahan fungsi
    * `docs`: untuk perubahan dokumentasi
    * `test`: untuk penambahan atau perubahan tes
    * `chore`: untuk perubahan rutin atau kebersihan kode
      <br/>Contoh: `feat: add login functionality`
2. Gunakan bahasa inggris untuk pesan commit
3. **Jangan** push di main

### How to

--- 
Ubahlah kata yang terdapat `<>`

1. **Clone Project ini**
    1. buka laragon
    2. klik tombol root (memiliki icon folder)
    3. pada folder tersebut klik kanan dan `Open in Terminal` (folder www)
    4. ketik perintah `git clone https://github.com/Fahridanaa/sawira.git`
    5. masuk ke folder dengan perintah `cd .\sawira\`
    6. jalankan `npm install` dan `composer install`
    7. Anda dapat menjalankan seperti biasa ketikkan perintah `npm run dev` dan `php artisan serve`
    8. buka http://localhost:8000

2. **push to GitHub**
    1. `git add .`
    2. `git commit -m "<kata-kata mutiara>"`
    3. `git push -u <nama-remote> <nama-branch>`

   **Contoh:** (semisal sekarang aku berada di remote origin dan branch login)
    1. `git add .`
    2. `git commit -m "feat: add login functionality"`
    3. `git push -u origin login`

   Dan sudah, kode anda akan berada di branch login :D

3. **Membuat branch**
    1. `git checkout -b "<nama branch>"`

   **Contoh:** Semisal saya ingin membuat branch login
    1. `git checkout -b "login"`
    2. udah gitu doang

### Resources

--- 

1. https://laravel.com/docs/10.x
2. https://getbootstrap.com/docs/5.3/getting-started/introduction/
3. https://www.freecodecamp.org/news/the-model-view-controller-pattern-mvc-architecture-and-frameworks-explained/
4. https://www.google.com/
