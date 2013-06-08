CI MySQL Dump
===============

__CI MySQL Dump__ merupakan file pustaka(library) untuk framework PHP __Codeigniter__ yang berfungsi sebagai proses backup database __MySQL__. Pada dasarnya, database MySQL dapat dibackup melalui perintah _Command Prompt_ (CMD) / Terminal (Dalam Linux) dengan perintah " *mysqldump* *--opt* *-h* *[namahost]* *-u* *[username]* *-p* *[password]* *[database]* *>* *~/[nama-file-output].sql* ". Namun, di beberapa penyedia layanan hosting PHP dan MySQL di Indonesia, fitur command ini tidak diimplementasikan/dinon-aktifkan oleh penyedia layanan hosting tersebut dikarenakan hal keamanan.

Oleh sebab itu, saya sebagai pencinta CI berusaha membuat pustaka ini agar para pemilik situs/developer situs yang terkena masalah diatas, dapat tersolusikan dengan menggunakan pustakan ini.

Pustaka ini bersifat **FREE/Open Source** untuk digunakan, disebarkan atau diperjual-belikan. Adapun lisensi yang saya daftarkan pada pustaka ini menggunakan lisensi resmi dari "[Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)](http://creativecommons.org/licenses/by-sa/3.0/ "Creative Common Links")".

Bagi Anda semua yang ingin berpartisipasi untuk mengembangkan pustaka ini, dapat menerbitkan(Issue) pertanyaan pada [LINK](https://github.com/nurimansyah/CI-MySQL-Dump/issues "Post an Issue") ini. Anda juga dapat mengambil([FORKING](https://github.com/nurimansyah/CI-MySQL-Dump/fork "Fork This Repository")) repositori ini kedalam repositori Anda.

Untuk [Pull Request](https://github.com/nurimansyah/CI-MySQL-Dump/pulls "Pull This Repository"), akan saya pilah terlebih dahulu penerbitan dan FIX yang ada.

Untuk informasi lebih lanjut mengenai **API** dan cara penggunaan pustaka ini, Anda dapat mengunjungi **[WIKI](https://github.com/nurimansyah/CI-MySQL-Dump/wiki "Repository WIKI")** pustaka ini.

Salam Developer CI,  
Nurimansyah Rifwan

***

### TODO's

***

* Import System
* Scheduled Backup (With Databases)