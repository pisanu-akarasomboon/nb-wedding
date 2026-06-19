NB-Wedding v2

วิธีติดตั้ง:
1) วางโฟลเดอร์ NB-Wedding-v2 ใน htdocs หรือ hosting
2) Import database.sql เข้า MySQL/phpMyAdmin
3) ตรวจ config.php ให้ DB เป็น wedding_db, user/pass ถูกต้อง
4) ใส่รูป hero ที่ assets/images/hero.jpg และ QR ที่ assets/images/qr.jpg
5) ใส่เพลงที่ assets/music/nothing-gonna-change-my-love-for-you.mp3
6) ใส่วิดีโอที่ assets/video/hero.mp4

หน้าใช้งาน:
- index.php หน้าเว็บการ์ด
- admin_guest.php สร้างลิงก์เฉพาะแขก เช่น index.php?token=xxxx
- admin.php ดูรายชื่อ RSVP
