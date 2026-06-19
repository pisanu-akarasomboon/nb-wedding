<?php
require_once __DIR__ . '/config.php';
$groom = 'Pisanu';
$bride = 'Nitchakan';
$dateText = '26 SEP 2026';
$dateFull = '26 September 2026';
$dateISO = '2026-09-26T10:30:00+07:00';
$venue = 'Saint Louis church, Bangkok';
$account = '711-2345-406';
$guestDisplayName = 'แขกผู้มีเกียรติ';
$guestId = null;
if (!empty($_GET['token'])) {
  $stmt = $pdo->prepare('SELECT id, guest_name FROM guests WHERE token = ? LIMIT 1');
  $stmt->execute([$_GET['token']]);
  $guest = $stmt->fetch();
  if ($guest) { $guestDisplayName = $guest['guest_name']; $guestId = (int)$guest['id']; }
}
?>
<!doctype html>
<html lang="th">
<head>
  <link rel="icon" type="image/png" href="assets/images/icon-v2.png">
<link rel="apple-touch-icon" href="assets/images/icon-v2.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon-v2.png">

<meta name="theme-color" content="#10140f">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="N&B Wedding">
  <link rel="icon" href="assets/images/icon.jpg">
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>NB-Wedding | <?= h($groom) ?> & <?= h($bride) ?></title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" defer></script>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@400;500;600;700&family=Manrope:wght@300;400;500;600;700;800&family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--dark:#10140f;--forest:#2e3325;--olive:#6c7450;--sage:#aab08d;--ivory:#f6f0e6;--sand:#e8e0d2}*{box-sizing:border-box;scroll-behavior:smooth}body{margin:0;font-family:Manrope,'Noto Sans Thai',sans-serif;background:var(--dark);color:#fff;overflow-x:hidden}.display{font-family:'Bodoni Moda','Noto Sans Thai',serif}.nature{background:radial-gradient(circle at 16% 18%,rgba(170,176,141,.18),transparent 28%),radial-gradient(circle at 82% 8%,rgba(246,240,230,.08),transparent 30%),linear-gradient(135deg,#10140f 0%,#2e3325 48%,#6c7450 100%)}.glass{background:rgba(255,255,255,.075);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border:1px solid rgba(255,255,255,.13)}.grain:before{content:"";pointer-events:none;position:fixed;inset:0;z-index:1;opacity:.04;background-image:radial-gradient(circle at 20% 20%,rgba(255,255,255,.5) 0 1px,transparent 1px),radial-gradient(circle at 80% 80%,rgba(255,255,255,.35) 0 1px,transparent 1px);background-size:4px 4px,6px 6px;mix-blend-mode:overlay}@keyframes fadeUp{from{opacity:0;transform:translateY(34px)}to{opacity:1;transform:translateY(0)}}@keyframes drawLine{from{stroke-dashoffset:1600}to{stroke-dashoffset:0}}.fadeUp{animation:fadeUp .9s ease both}.drawLine{stroke-dasharray:1600;stroke-dashoffset:1600;animation:drawLine 3.6s ease forwards}.schedule-card{position:relative;margin-bottom:2rem}@media(min-width:768px){.schedule-card{position:absolute;width:380px;top:var(--top)}.schedule-card.left{left:0}.schedule-card.right{right:0}}@media(max-width:767px){nav{display:none}.mobile-safe-title{font-size:clamp(3rem,18vw,5rem)!important;line-height:.9!important;letter-spacing:-.04em!important}.mobile-section-title{font-size:clamp(2.7rem,15vw,4.5rem)!important;line-height:.95!important;letter-spacing:-.04em!important}.floating-actions{width:calc(100% - 24px);justify-content:center;gap:.5rem}.floating-actions button{flex:1;padding:.8rem .6rem!important;letter-spacing:.12em!important;font-size:9px!important}.schedule-wrap{min-height:auto!important}.schedule-card{position:relative!important;top:auto!important;left:auto!important;right:auto!important;width:100%!important}.schedule-card .inner{border-radius:26px!important;padding:1.4rem!important}.schedule-card .time{font-size:3.2rem!important}}@media print{.no-print{display:none!important}}

.envelope-card{
  position:relative;
  overflow:hidden;
  background:
    linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,.025)),
    linear-gradient(135deg,#2d3529,#46513a);
}

.envelope-card:before{
  content:"";
  position:absolute;
  inset:0;
  background:
    linear-gradient(145deg, transparent 49.7%, rgba(255,255,255,.18) 50%, transparent 50.3%),
    linear-gradient(215deg, transparent 49.7%, rgba(255,255,255,.12) 50%, transparent 50.3%);
  opacity:.8;
  pointer-events:none;
}

.envelope-flap{
  position:absolute;
  left:0;
  top:0;
  width:100%;
  height:42%;
  background:linear-gradient(180deg, rgba(246,240,230,.18), rgba(255,255,255,.02));
  clip-path:polygon(0 0,100% 0,50% 100%);
  border-top:1px solid rgba(255,255,255,.22);
  pointer-events:none;
}

.envelope-bottom{
  position:absolute;
  left:0;
  bottom:0;
  width:100%;
  height:46%;
  background:linear-gradient(0deg, rgba(16,20,15,.28), transparent);
  clip-path:polygon(0 100%,50% 0,100% 100%);
  pointer-events:none;
}

.envelope-seal{
  position:absolute;
  left:50%;
  top:39%;
  transform:translate(-50%,-50%);
  width:54px;
  height:54px;
  border-radius:999px;
  background:#aab08d;
  box-shadow:0 20px 50px rgba(0,0,0,.35);
  display:flex;
  align-items:center;
  justify-content:center;
  color:#2e3325;
  font-family:'Bodoni Moda',serif;
  font-size:22px;
  z-index:3;
}

.envelope-content{
  position:relative;
  z-index:5;
}

@media(max-width:767px){
  .envelope-seal{
    width:46px;
    height:46px;
    font-size:18px;
    top:41%;
  }
}
</style>
</head>
<body><main class="min-h-screen bg-[#10140f] text-white"><audio id="weddingMusic" loop preload="auto" playsinline><source src="assets/music/nothing-gonna-change-my-love-for-you.mp3" type="audio/mpeg"></audio><div class="grain"></div>
<section id="opening" class="fixed inset-0 z-[100] flex items-center justify-center nature px-6 transition duration-700"><div class="absolute left-[8%] top-[18%] text-[9rem] text-white opacity-[.035]">P</div><div class="absolute bottom-[10%] right-[8%] text-[9rem] text-white opacity-[.035]">N</div><div class="relative w-full max-w-md rounded-[42px] glass p-7 text-center shadow-[0_40px_140px_rgba(0,0,0,.55)] md:p-9">
  <div class="absolute inset-4 rounded-[32px] border border-white/10"></div><div class="relative z-10"><p class="text-[10px] uppercase tracking-[0.42em] text-[#e8e0d2] md:tracking-[0.52em]">Private Invitation</p><p class="mt-6 text-[10px] uppercase tracking-[0.3em] text-white/45">เรียนเชิญ</p><p class="mt-3 text-lg leading-8 text-[#f6f0e6]"><?= h($guestDisplayName) ?></p><div class="mx-auto my-8 h-20 w-[1px] bg-gradient-to-b from-transparent via-[#e8e0d2] to-transparent md:my-10 md:h-24"></div><h1 class="display mobile-safe-title text-6xl leading-[0.9] tracking-[-0.04em] md:text-7xl"><?= h($groom) ?><span class="block italic text-[#aab08d]">& <?= h($bride) ?></span></h1><p class="mt-8 text-xs uppercase tracking-[0.24em] text-white/55 md:tracking-[0.32em]"><?= h($dateFull) ?></p><button id="openBtn" class="mt-10 rounded-full bg-[#f6f0e6] px-8 py-4 text-xs font-bold uppercase tracking-[0.22em] text-[#2e3325] transition hover:scale-105 md:mt-12 md:tracking-[0.28em]">Open Invitation</button><p id="audioHint" class="mt-4 hidden text-[11px] leading-5 text-white/50">หากมือถือไม่เล่นเพลงอัตโนมัติ ให้กด Music On อีกครั้ง</p></div></div></section>
<div class="floating-actions no-print fixed bottom-5 left-1/2 z-50 flex -translate-x-1/2 gap-3"><button id="musicBtn" class="rounded-full bg-white px-5 py-3 text-[10px] font-semibold uppercase tracking-[0.25em] text-[#10140f] shadow-2xl">Music On</button><button id="downloadBtn" class="rounded-full bg-[#aab08d] px-5 py-3 text-[10px] font-semibold uppercase tracking-[0.25em] text-[#10140f] shadow-2xl">Download</button></div>
<nav class="no-print fixed left-0 top-0 z-50 w-full border-b border-white/10 bg-[#10140f]/76 backdrop-blur-xl"><div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 md:px-10"><a href="#" class="display text-2xl italic tracking-[-0.03em]">P<span class="text-[#aab08d]">&</span>N</a><div class="hidden gap-8 text-[10px] uppercase tracking-[0.3em] text-white/50 md:flex"><a href="#video">Video</a><a href="#story">Story</a><a href="#schedule">Schedule</a><a href="#rsvp">RSVP</a><a href="#venue">Venue</a><a href="#gift">Gift</a><a href="admin.php">Admin</a></div></div></nav>
<section class="relative min-h-screen overflow-hidden"><img src="assets/images/hero.jpg" class="absolute inset-0 h-full w-full object-cover" alt="Hero"><div class="absolute inset-0 bg-gradient-to-b from-black/55 via-black/25 to-[#10140f]"></div><div class="absolute left-[-8%] top-[16%] text-[14rem] font-bold leading-none text-white opacity-[.035] md:text-[28rem]">26</div><div class="relative z-10 flex min-h-screen flex-col items-center justify-center px-5 text-center"><p class="mb-5 text-[11px] uppercase tracking-[0.34em] text-[#dfe7c8] md:text-xs md:tracking-[0.5em]">NB Wedding</p><h1 class="display mobile-safe-title text-[clamp(4.5rem,10vw,10rem)] font-semibold leading-[.82] tracking-[-0.06em]"><?= h($groom) ?></h1><div class="my-4 flex w-full max-w-xl items-center gap-4 md:my-5"><div class="h-px flex-1 bg-[#dfe7c8]/50"></div><span class="display text-4xl italic text-[#dfe7c8] md:text-5xl">&</span><div class="h-px flex-1 bg-[#dfe7c8]/50"></div></div><h1 class="display mobile-safe-title text-[clamp(4.5rem,10vw,10rem)] font-semibold leading-[.82] tracking-[-0.06em] text-[#dfe7c8]"><?= h($bride) ?></h1><p class="mt-7 max-w-2xl text-base leading-8 text-white/80 md:text-lg md:leading-9">ขอเรียนเชิญร่วมเป็นเกียรติและเป็นสักขีพยาน ในวันสำคัญของเราทั้งสองคน</p><p class="mt-5 text-xs uppercase tracking-[0.26em] text-white/60 md:tracking-[0.35em]"><?= h($dateFull) ?> • <?= h($venue) ?></p><div class="mt-8 flex flex-wrap justify-center gap-3 md:mt-10 md:gap-4"><a href="#rsvp" class="rounded-full bg-[#f6f0e6] px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-[#10140f] transition hover:scale-105 md:px-8 md:text-xs md:tracking-[0.28em]">Kindly Respond</a><a href="#video" class="rounded-full border border-white/35 px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-white transition hover:bg-white hover:text-black md:px-8 md:text-xs md:tracking-[0.28em]">Watch Video</a></div></div></section>
<section id="video" class="bg-[#10140f] px-5 py-20 md:px-10 md:py-24"><div class="mx-auto max-w-4xl"><div class="mb-10 text-center md:mb-12"><p class="mb-5 text-xs uppercase tracking-[0.35em] text-[#aab08d] md:tracking-[0.5em]">Our Moment</p><h2 class="display mobile-section-title text-[clamp(3rem,8vw,6rem)] leading-none tracking-[-0.06em]">♪ Soundtrack of Us</h2><p class="mx-auto mt-6 max-w-xl leading-8 text-white/55">วิดีโอช่วงเวลาพิเศษของเรา</p></div><div class="mx-auto max-w-3xl overflow-hidden rounded-[28px] shadow-[0_30px_90px_rgba(0,0,0,.45)] md:rounded-[36px]"><video id="heroVideo" controls playsinline muted poster="assets/images/hero.jpg" class="w-full bg-black"><source src="assets/video/hero.mp4" type="video/mp4"></video></div></div></section>
<section class="border-y border-white/10 bg-[#141a12] px-5 py-10 md:px-10"><div class="mx-auto grid max-w-7xl gap-5 md:grid-cols-3"><?php foreach ([

['Date',$dateText],

['Venue','Saint Louis Church, Bangkok'],

['Reception','Maekmai Chaiklong Restaurant']

] as $i=>$info): ?>
<div class="rounded-[24px] glass p-6 md:rounded-[28px] md:p-7"><p class="text-[10px] uppercase tracking-[0.3em] text-[#aab08d] md:tracking-[0.35em]"><?= h($info[0]) ?></p><p class="display mt-3 text-2xl tracking-[-0.04em] md:text-3xl"><?= h($info[1]) ?></p></div><?php endforeach; ?></div></section>
<section id="story"
class="bg-[#f6f0e6] text-[#10140f] py-24 px-6">

<div class="max-w-6xl mx-auto">

<div class="text-center mb-20">

<p class="uppercase tracking-[0.5em]
text-[#6c7450] text-xs">

OUR JOURNEY

</p>

<h2
class="display
text-[clamp(3rem,7vw,5.5rem)]
leading-none
tracking-[-0.06em]
mt-4">

Our Love Story

</h2>

<p class="max-w-2xl mx-auto mt-6
text-black/55 leading-8">

ทุกความสัมพันธ์เริ่มต้นจากการพบกัน
และค่อยๆ เติบโตเป็นความรักที่งดงาม

</p>

</div>

<div class="relative">

<div
class="hidden md:block
absolute top-12 left-0 right-0
h-[2px]
bg-[#aab08d]">
</div>

<div
class="grid
md:grid-cols-4
gap-10">

<!-- 2021 -->

<div class="text-center relative">

<div
class="mx-auto
w-6 h-6
rounded-full
bg-[#6c7450]
relative z-10">
</div>

<h3
class="display
text-5xl
mt-8
text-[#6c7450]">

2021

</h3>

<h4
class="font-semibold
mt-4
text-xl">

First Meet

</h4>

<p
class="mt-3
text-black/55
leading-7">

วันแรกที่เราได้รู้จักกัน

</p>

</div>

<!-- 2022 -->

<div class="text-center relative">

<div
class="mx-auto
w-6 h-6
rounded-full
bg-[#6c7450]
relative z-10">
</div>

<h3
class="display
text-5xl
mt-8
text-[#6c7450]">

2022

</h3>

<h4
class="font-semibold
mt-4
text-xl">

Relationship

</h4>

<p
class="mt-3
text-black/55
leading-7">

วันที่เราเริ่มต้นเดินไปด้วยกัน

</p>

</div>

<!-- 2023 -->

<div class="text-center relative">

<div
class="mx-auto
w-6 h-6
rounded-full
bg-[#6c7450]
relative z-10">
</div>

<h3
class="display
text-5xl
mt-8
text-[#6c7450]">

2023

</h3>

<h4
class="font-semibold
mt-4
text-xl">

Engagement

</h4>

<p
class="mt-3
text-black/55
leading-7">

วันที่เราตัดสินใจสร้างอนาคตร่วมกัน

</p>

</div>

<!-- 2026 -->

<div class="text-center relative">

<div
class="mx-auto
w-6 h-6
rounded-full
bg-[#aab08d]
relative z-10 animate-pulse">
</div>

<h3
class="display
text-5xl
mt-8
text-[#6c7450]">

2026

</h3>

<h4
class="font-semibold
mt-4
text-xl">

Wedding Day

</h4>

<p
class="mt-3
text-black/55
leading-7">

วันที่ความรักของเรากลายเป็นครอบครัว

</p>

</div>

</div>

</div>

</div>

</section><section id="schedule" class="relative px-5 py-20 md:px-10 md:py-28"><div class="mx-auto max-w-7xl"><div class="mb-12 flex flex-col justify-between gap-6 md:mb-16 md:flex-row md:items-end"><div><p class="mb-5 text-xs uppercase tracking-[0.35em] text-[#aab08d] md:tracking-[0.5em]">Schedule</p><h2 class="display mobile-section-title text-[clamp(3.5rem,8vw,8rem)] leading-none tracking-[-0.06em]">ลำดับพิธี</h2></div><p class="max-w-md leading-8 text-white/55">เส้นทางของวันสำคัญ เรียงลำดับช่วงเวลาหลักอย่างเรียบหรู พร้อมรายละเอียดที่จำเป็นสำหรับแขกทุกท่าน</p></div><div class="schedule-wrap relative min-h-[960px]"><svg class="absolute left-1/2 top-0 hidden h-full w-[460px] -translate-x-1/2 md:block" viewBox="0 0 460 960" fill="none"><path class="drawLine" d="M235 0 C40 130 410 235 205 370 C40 500 420 610 215 760 C90 850 320 910 235 960" stroke="#aab08d" stroke-width="2" fill="none"/></svg><?php $schedule=[['10:30','พิธีสมรส','Wedding Ceremony','เริ่มต้นพิธีแห่งความสุขและคำอวยพรจากครอบครัว','left','0px'],['12:00','รับ Snack Box','Snack Box','รับประทานของว่าง','right','190px'],['13:00','ลงทะเบียนแขก','Guest Registration','ต้อนรับแขกผู้มีเกียรติบริเวณหน้างาน','left','380px'],['13:30','งานเลี้ยงฉลอง','Wedding Reception','ร่วมรับประทานอาหารกลางวันและเฉลิมฉลอง','right','570px'],['17:30','ช่วงเวลาแห่งความสุข','After Party','ถ่ายภาพ พูดคุย และร่วมสร้างความทรงจำไปด้วยกัน','left','760px']]; foreach($schedule as $item): ?><div class="schedule-card <?= h($item[4]) ?>" style="--top:<?= h($item[5]) ?>"><div class="inner group rounded-[36px] bg-white/[.06] p-8 transition duration-500 hover:-translate-y-3 hover:bg-[#aab08d] hover:text-[#10140f]"><p class="time display text-6xl tracking-[-0.06em] text-[#aab08d] group-hover:text-[#10140f]"><?= h($item[0]) ?></p><div class="my-5 h-px w-24 bg-white/20 group-hover:bg-black/20 md:my-6"></div><h3 class="text-xl font-semibold md:text-2xl"><?= h($item[1]) ?></h3><p class="mt-1 text-sm text-white/45 group-hover:text-black/60"><?= h($item[2]) ?></p><p class="mt-4 text-sm leading-7 text-white/50 group-hover:text-black/65 md:mt-5"><?= h($item[3]) ?></p></div></div><?php endforeach; ?></div></div></section>
  <!-- VENUE MAPS -->
<section id="venue" class="bg-[#f6f0e6] px-5 py-20 text-[#10140f] md:px-10 md:py-28">
  <div class="mx-auto max-w-7xl">

    <div class="mb-14 text-center">
      <p class="mb-5 text-xs uppercase tracking-[0.35em] text-[#6c7450] md:tracking-[0.5em]">
        Wedding Venue
      </p>

      <h2 class="display mobile-section-title text-[clamp(3rem,7vw,7rem)] leading-none tracking-[-0.06em]">
        สถานที่จัดงาน
      </h2>

      <p class="mx-auto mt-6 max-w-2xl leading-8 text-black/55">
        พิธีช่วงเช้าจัดที่โบสถ์เซนต์หลุยส์ สาทร และงานเลี้ยงช่วงบ่ายที่ร้านอาหารแมกไม้ชายคลอง
      </p>
    </div>

    <div class="grid gap-10 md:grid-cols-2">

      <!-- Morning Church -->
      <div class="overflow-hidden rounded-[34px] bg-white shadow-2xl">
        <img
          src="assets/images/saint-louis.jpg"
          class="h-[280px] w-full object-cover md:h-[360px]"
          alt="Saint Louis Catholic Church"
        >

        <div class="p-6 md:p-8">
          <p class="text-[10px] uppercase tracking-[0.35em] text-[#6c7450]">
            Morning Ceremony
          </p>

          <h3 class="display mt-4 text-4xl tracking-[-0.04em] md:text-5xl">
            โบสถ์เซนต์หลุยส์ สาทร
          </h3>

          <p class="mt-4 leading-8 text-black/55">
            Saint Louis Catholic Church<br>
            พิธีสมรสช่วงเช้า เวลา 10:30 น.
          </p>

          <div class="mt-6 overflow-hidden rounded-[24px]">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9796573758413!2d100.52174717466542!3d13.719681386668825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e298cc274dcaf7%3A0x73dca61dfa0e4364!2sSaint%20Louis%20Catholic%20Church!5e0!3m2!1sen!2sth!4v1780978190852!5m2!1sen!2sth"
              class="h-[300px] w-full border-0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>

          <a
            href="https://www.google.com/maps/search/?api=1&query=Saint%20Louis%20Catholic%20Church%20Bangkok"
            target="_blank"
            class="mt-6 inline-block rounded-full bg-[#6c7450] px-7 py-3 text-xs font-bold uppercase tracking-[0.22em] text-white">
            Open Map
          </a>
        </div>
      </div>

      <!-- Afternoon Restaurant -->
      <div class="overflow-hidden rounded-[34px] bg-white shadow-2xl">
        <img
          src="assets/images/mmck.png"
          class="h-[280px] w-full object-cover md:h-[360px]"
          alt="Maekmai Chaiklong Restaurant"
        >

        <div class="p-6 md:p-8">
          <p class="text-[10px] uppercase tracking-[0.35em] text-[#6c7450]">
            Afternoon Reception
          </p>

          <h3 class="display mt-4 text-4xl tracking-[-0.04em] md:text-5xl">
            ร้านอาหารแมกไม้ชายคลอง
          </h3>

          <p class="mt-4 leading-8 text-black/55">
            Maekmai Chaiklong Café and Restaurant<br>
            งานเลี้ยงช่วงบ่าย เวลา 13:30 น.
          </p>

          <div class="mt-6 overflow-hidden rounded-[24px]">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3877.445841464703!2d100.40021847466366!3d13.630621986748775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2bcf3ce75c603%3A0x46367c87a62ce8ff!2sMaekmai%20Chaiklong%20Caf%C3%A9%20and%20Restaurant!5e0!3m2!1sen!2sth!4v1780978226598!5m2!1sen!2sth"
              class="h-[300px] w-full border-0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>

          <a
            href="https://www.google.com/maps/search/?api=1&query=Maekmai%20Chaiklong%20Cafe%20and%20Restaurant"
            target="_blank"
            class="mt-6 inline-block rounded-full bg-[#6c7450] px-7 py-3 text-xs font-bold uppercase tracking-[0.22em] text-white">
            Open Map
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
<section class="bg-[#f6f0e6] px-5 py-20 text-[#10140f] md:px-10 md:py-24"><div class="mx-auto max-w-6xl text-center"><p class="mb-5 text-xs uppercase tracking-[0.4em] text-[#6c7450] md:tracking-[0.5em]">Countdown</p><div class="grid grid-cols-2 gap-6 md:grid-cols-4 md:gap-8"><?php foreach([['Days','days'],['Hours','hours'],['Minutes','minutes'],['Seconds','seconds']] as $item): ?><div><p id="count-<?= h($item[1]) ?>" class="display text-5xl tracking-[-0.06em] md:text-8xl">00</p><p class="mt-2 text-[9px] uppercase tracking-[0.22em] text-black/45 md:tracking-[0.3em]"><?= h($item[0]) ?></p></div><?php endforeach; ?></div></div></section>
<section id="rsvp" class="nature px-5 py-20 md:px-10 md:py-28"><div class="mx-auto grid max-w-6xl gap-10 md:grid-cols-[.85fr_1.15fr] md:gap-12"><div><p class="mb-5 text-xs uppercase tracking-[0.35em] text-[#aab08d] md:tracking-[0.5em]">Kindly Respond</p><h3 class="display mobile-section-title text-[clamp(3rem,7vw,7rem)] leading-none tracking-[-0.06em]">ความประสงค์ร่วมงาน</h3><p class="mt-7 leading-8 text-white/58">กรุณาตอบกลับเพื่อให้เราจัดเตรียมที่นั่ง อาหาร และการต้อนรับได้อย่างเหมาะสม</p></div><div class="rounded-[32px] glass p-5 md:rounded-[40px] md:p-10"><form id="rsvpForm" class="space-y-5"><input type="hidden" name="guest_id" value="<?= h($guestId) ?>"><input name="guest_name" required class="w-full rounded-2xl bg-white/10 px-5 py-4 outline-none placeholder:text-white/35 focus:bg-white focus:text-black" placeholder="ชื่อ - นามสกุล" value="<?= $guestId ? h($guestDisplayName) : '' ?>"><select name="attendance" class="w-full rounded-2xl bg-white/10 px-5 py-4 outline-none focus:bg-white focus:text-black"><option value="attending">ยินดีไปร่วมงาน</option><option value="not_attending">ไม่สามารถร่วมงานได้</option></select><input name="guests" type="number" min="1" max="20" value="1" class="w-full rounded-2xl bg-white/10 px-5 py-4 outline-none placeholder:text-white/35 focus:bg-white focus:text-black" placeholder="จำนวนผู้ร่วมงาน"><input name="dietary" class="w-full rounded-2xl bg-white/10 px-5 py-4 outline-none placeholder:text-white/35 focus:bg-white focus:text-black" placeholder="อาหารที่แพ้ / ข้อจำกัดด้านอาหาร"><textarea name="message" class="h-28 w-full rounded-2xl bg-white/10 px-5 py-4 outline-none placeholder:text-white/35 focus:bg-white focus:text-black" placeholder="คำอวยพร"></textarea><button class="w-full rounded-full bg-[#f6f0e6] py-4 text-xs font-bold uppercase tracking-[0.22em] text-[#10140f] transition hover:scale-[1.02] md:tracking-[0.28em]">Send RSVP</button><div id="rsvpMsg" class="hidden rounded-2xl bg-[#aab08d] p-5 text-center text-[#10140f]"></div></form></div></div></section>
<section id="gift" class="bg-[#f6f0e6] px-5 py-20 text-[#10140f] md:px-10 md:py-28"><div class="mx-auto grid max-w-6xl items-center gap-10 md:grid-cols-2 md:gap-12"><div><p class="mb-5 text-xs uppercase tracking-[0.35em] text-[#6c7450] md:tracking-[0.5em]">Digital Blessing</p><h2 class="display mobile-section-title text-[clamp(3rem,7vw,7rem)] leading-none tracking-[-0.06em]">QR Code</h2><p class="mt-7 max-w-md leading-8 text-black/55">หากท่านประสงค์มอบของขวัญแทนคำอวยพร สามารถใช้ QR Code นี้ได้</p></div><div class="mx-auto w-full max-w-md rounded-[32px] bg-white p-6 text-center shadow-2xl md:rounded-[40px] md:p-8"><p class="mb-5 text-xs uppercase tracking-[0.3em] text-[#6c7450] md:tracking-[0.35em]">With Love</p><img src="assets/images/qr.jpg" class="mx-auto h-56 w-56 rounded-2xl object-cover md:h-60 md:w-60" alt="QR Code"><p class="display mt-8 text-3xl tracking-[-0.04em] md:text-4xl"><?= h($groom) ?> & <?= h($bride) ?></p><p class="mt-3 text-sm tracking-[0.2em] text-black/45 md:tracking-[0.25em]"><?= h($account) ?></p></div></div></section>
<section id="card" class="px-5 py-20 md:px-10 md:py-28"><div class="mx-auto max-w-5xl text-center"><p class="mb-5 text-xs uppercase tracking-[0.35em] text-[#aab08d] md:tracking-[0.5em]">Downloadable</p><h2 class="display mobile-section-title text-[clamp(3rem,7vw,7rem)] leading-none tracking-[-0.06em]">Save as card</h2>
<div id="cardRef"
class="mx-auto mt-12
grid
max-w-[1200px]
overflow-hidden
rounded-[42px]
bg-[#10140f]
shadow-2xl
md:grid-cols-[1fr_0.85fr]">  <div class="flex items-center justify-center bg-[#10140f] p-4">

    <img
        src="assets/images/hero.jpg"
        class="max-h-[520px] w-auto object-contain"
        alt="Wedding Card">

</div><div class="flex flex-col justify-center p-7 md:p-10"><p class="text-[10px] uppercase tracking-[0.35em] text-[#aab08d] md:tracking-[0.45em]">Wedding Invitation</p><h3 class="display mt-8 text-5xl leading-none tracking-[-0.06em] md:mt-10 md:text-6xl"><?= h($groom) ?><span class="block italic text-[#aab08d]">& <?= h($bride) ?></span></h3><div class="mt-8 space-y-6 text-left">

<div>
  <p class="text-[10px] uppercase tracking-[0.3em] text-[#aab08d]">
    Date
  </p>

  <p class="mt-2 text-white/70">
    26 September 2026
  </p>
</div>

<div class="h-px bg-white/10"></div>

<div>
  <p class="text-[10px] uppercase tracking-[0.3em] text-[#aab08d]">
    Morning Ceremony
  </p>

  <p class="mt-2 text-white/70">
    Saint Louis Catholic Church
  </p>

  <p class="text-white/40 text-sm">
    Sathorn, Bangkok
  </p>

  <p class="text-white/40 text-sm">
    10:30 AM
  </p>
</div>

<div class="h-px bg-white/10"></div>

<div>
  <p class="text-[10px] uppercase tracking-[0.3em] text-[#aab08d]">
    Reception
  </p>

  <p class="mt-2 text-white/70">
    Maekmai Chaiklong Restaurant
  </p>

  <p class="text-white/40 text-sm">
    1:30 PM
  </p>
</div>

<div class="h-px bg-white/10"></div>

<div>
  <p class="text-[10px] uppercase tracking-[0.3em] text-[#aab08d]">
    Dress Code
  </p>
  <!-- <div class="mt-8 text-center">

<img
src="assets/images/qr.jpg"
class="mx-auto w-28 h-28 rounded-xl object-cover">

<p class="mt-3 text-xs tracking-[0.2em] text-white/40">
SCAN FOR DETAILS
</p>

</div> -->

  <div class="flex gap-2 mt-3">
    <div class="w-5 h-5 rounded-full bg-[#F6F0E6]"></div>
    <div class="w-5 h-5 rounded-full bg-[#D7D2C8]"></div>
    <div class="w-5 h-5 rounded-full bg-[#AAB08D]"></div>
    <div class="w-5 h-5 rounded-full bg-[#6C7450]"></div>
  </div>
</div>

</div></p></div></div><button id="downloadCard2" class="mt-10 rounded-full bg-[#aab08d] px-8 py-4 text-xs font-bold uppercase tracking-[0.22em] text-[#10140f] md:tracking-[0.28em]">Download PNG</button></div></section>
<footer class="min-h-[50vh] border-t border-white/10 px-5 py-20 text-center md:min-h-[70vh] md:py-24"><p class="mb-6 text-xs uppercase tracking-[0.35em] text-[#aab08d] md:tracking-[0.5em]">Thank you</p><h2 class="display mobile-safe-title text-[clamp(4rem,10vw,10rem)] leading-none tracking-[-0.06em]"><?= h($groom) ?><span class="block italic text-[#aab08d]">& <?= h($bride) ?></span></h2><p class="mt-8 text-[10px] uppercase tracking-[0.3em] text-white/35 md:tracking-[0.35em]">Made with Love • 2026</p></footer>
</main><script>
const targetDate=new Date('<?= $dateISO ?>').getTime();function updateCountdown(){const diff=targetDate-Date.now();if(diff<=0)return;document.getElementById('count-days').textContent=String(Math.floor(diff/86400000)).padStart(2,'0');document.getElementById('count-hours').textContent=String(Math.floor((diff/3600000)%24)).padStart(2,'0');document.getElementById('count-minutes').textContent=String(Math.floor((diff/60000)%60)).padStart(2,'0');document.getElementById('count-seconds').textContent=String(Math.floor((diff/1000)%60)).padStart(2,'0')}setInterval(updateCountdown,1000);updateCountdown();
const audio=document.getElementById('weddingMusic'),musicBtn=document.getElementById('musicBtn'),audioHint=document.getElementById('audioHint');let musicOn=false;async function startMusic(){try{audio.muted=false;audio.volume=.85;await audio.play();musicOn=true;musicBtn.textContent='Music Off';audioHint&&audioHint.classList.add('hidden')}catch(e){musicOn=false;musicBtn.textContent='Music On';audioHint&&audioHint.classList.remove('hidden')}}musicBtn.addEventListener('click',async()=>{if(musicOn){audio.pause();musicOn=false;musicBtn.textContent='Music On'}else await startMusic()});function closeOpening(){const o=document.getElementById('opening');if(!o)return;o.style.opacity='0';o.style.pointerEvents='none';setTimeout(()=>o&&o.remove(),700)}document.getElementById('openBtn').addEventListener('click',async()=>{window.scrollTo({top:0,behavior:'auto'});closeOpening();startMusic();const video=document.getElementById('heroVideo');if(video){setTimeout(()=>{document.getElementById('video').scrollIntoView({behavior:'smooth',block:'start'});video.muted=true;video.play().catch(()=>{});},900)}});
async function downloadCard(){const el=document.getElementById('cardRef');if(!window.html2canvas||!el)return;const canvas=await html2canvas(el,{scale:2,backgroundColor:'#10140f',useCORS:true});const a=document.createElement('a');a.download='pisanu-nitchakan-wedding-card.png';a.href=canvas.toDataURL('image/png');a.click()}document.getElementById('downloadBtn').addEventListener('click',downloadCard);document.getElementById('downloadCard2').addEventListener('click',downloadCard);
document.getElementById('rsvpForm').addEventListener('submit',async e=>{e.preventDefault();const form=e.currentTarget,msg=document.getElementById('rsvpMsg'),fd=new FormData(form);msg.classList.remove('hidden');msg.textContent='กำลังบันทึกข้อมูล...';try{const res=await fetch('save_rsvp.php',{method:'POST',body:fd});const data=await res.json();msg.textContent=data.message||'บันทึกข้อมูลเรียบร้อยแล้ว';if(data.success)form.reset()}catch(err){msg.textContent='ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง'}});
</script></body></html>
