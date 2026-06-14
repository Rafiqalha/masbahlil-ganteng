<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const faqs = ref([
    {
        question: 'Apa itu Program Makan Bergizi Gratis (MBG)?',
        answer: 'MBG adalah program nasional untuk menyediakan makanan bergizi secara gratis guna meningkatkan kualitas kesehatan gizi. Platform ini menghubungkan SPPG selaku pelaksana program dengan Supplier UMKM lokal.',
        open: false
    },
    {
        question: 'Siapa saja yang bisa mendaftar menjadi Supplier?',
        answer: 'Seluruh pelaku UMKM yang memproduksi bahan makanan, bahan pokok, atau makanan jadi yang memiliki legalitas usaha (minimal NIB) dapat berpartisipasi dalam program ini.',
        open: false
    },
    {
        question: 'Apakah proses pemadanan (matching) dilakukan manual?',
        answer: 'Tidak. Sistem MBGBrain menggunakan algoritma cerdas yang memperhitungkan jarak lokasi, kapasitas produksi, dan kelengkapan dokumen untuk merekomendasikan Supplier terbaik kepada SPPG.',
        open: false
    },
    {
        question: 'Apakah pendaftaran dipungut biaya?',
        answer: 'Tidak, seluruh proses pendaftaran dan verifikasi di platform MBGBrain adalah gratis tanpa dipungut biaya apapun.',
        open: false
    }
]);

const toggleFaq = (index) => {
    faqs.value[index].open = !faqs.value[index].open;
};

// Simple animation observer
onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach((el) => {
        el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-1000', 'ease-out');
        observer.observe(el);
    });
});
</script>

<template>
    <Head title="MBGBrain - Rantai Pasok Gizi Nasional" />

    <div class="min-h-screen bg-white font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900 relative overflow-x-hidden">
        
        <!-- Background Image -->
        <div class="absolute top-0 inset-x-0 h-[800px] z-0 pointer-events-none overflow-hidden">
            <img src="/background.png" alt="" class="w-full h-full object-cover opacity-90" />
            <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-white to-transparent"></div>
        </div>

        <!-- Premium Navbar (Glassmorphism) -->
        <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-xl border-b border-slate-200/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center">
                        <img src="/logos/logo-mbg.png" alt="MBGBrain Logo" class="h-[80px] w-auto object-contain scale-[1.7] origin-left" />
                    </div>
                    
                    <div class="hidden md:flex space-x-8">
                        <a href="#tentang" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors">Tentang Program</a>
                        <a href="#cara-kerja" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors">Cara Kerja</a>
                        <a href="#syarat" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors">Persyaratan</a>
                        <a href="#faq" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition-colors">FAQ</a>
                    </div>

                    <div v-if="canLogin" class="flex items-center gap-4">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 px-5 py-2.5 rounded-full transition-all shadow-md shadow-slate-900/10">
                            Masuk Dashboard
                        </Link>
                        <template v-else>
                            <Link :href="route('login')" class="text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors">
                                Masuk
                            </Link>
                            <Link v-if="canRegister" :href="route('register')" class="text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 px-6 py-2.5 rounded-full transition-all shadow-md shadow-emerald-600/20 ring-1 ring-emerald-600/50">
                                Daftar Supplier
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-40 pb-20 lg:pt-52 lg:pb-32 z-10 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-on-scroll">
                


                <h1 class="font-serif text-5xl md:text-7xl lg:text-[5.5rem] font-bold text-slate-900 tracking-tight leading-[1.1] mb-6">
                    Intelijen Rantai Pasok <br class="hidden md:block"/>
                    <span class="text-[#2eb85c] italic">Gizi Nasional</span>
                </h1>
                
                <p class="mt-4 max-w-2xl mx-auto text-lg text-slate-500 mb-10 leading-relaxed">
                    Sistem pemadanan cerdas yang menghubungkan UMKM lokal dengan Satuan Pelayanan Pemenuhan Gizi (SPPG) secara transparan, adil, dan akuntabel.
                </p>

                <!-- Premium Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <Link :href="route('register')" class="inline-flex justify-center items-center px-8 py-3.5 text-sm font-semibold text-white bg-[#7BC96F] rounded-full shadow-md hover:bg-[#68b35c] transition-all duration-200">
                        Gabung Sebagai Supplier
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </Link>
                    <Link :href="route('login')" class="inline-flex justify-center items-center px-8 py-3.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-full shadow-sm hover:bg-slate-50 transition-all duration-200">
                        Masuk SPPG
                    </Link>
                </div>

                <!-- Mitra Marquee -->
                <div class="mt-24 border-y border-slate-100/50 bg-white/30 backdrop-blur-sm overflow-hidden py-8">
                    <p class="text-center text-sm font-semibold text-slate-400 mb-8 uppercase tracking-widest">Dipercaya oleh</p>
                    <div class="flex overflow-hidden relative">
                        <!-- Fade effect edges -->
                        <div class="absolute inset-y-0 left-0 w-24 md:w-48 bg-gradient-to-r from-white to-transparent z-10"></div>
                        <div class="absolute inset-y-0 right-0 w-24 md:w-48 bg-gradient-to-l from-white to-transparent z-10"></div>
                        
                        <!-- Scrolling container -->
                        <div class="flex whitespace-nowrap animate-marquee items-center w-max">
                            <div class="flex items-center gap-16 px-8 shrink-0">
                                <!-- Set 1 -->
                                <img src="/logos/logo-mbg.png" alt="MBGBrain" class="w-48 h-auto object-contain" />
                                <img src="/logos/Logo_Badan_Gizi_Nasional.svg.png" alt="Badan Gizi Nasional" class="h-14 w-auto object-contain" />
                                <img src="/logos/Logo_Kemenkes.png" alt="Kemenkes RI" class="h-10 w-auto object-contain" />
                                <img src="/logos/Logo_Badan_Pangan_Nasional_(2022).png" alt="Bapanas" class="h-12 w-auto object-contain" />
                                <img src="/logos/Logo_BUMN_Untuk_Indonesia_2020.svg.png" alt="BUMN" class="h-8 w-auto object-contain" />
                                <img src="/logos/Logo_Bulog.svg.png" alt="Bulog" class="h-10 w-auto object-contain" />
                                <img src="/logos/Bank_Mandiri_logo_2016.svg.png" alt="Bank Mandiri" class="h-8 w-auto object-contain" />
                                <img src="/logos/Bank_BRI_2000.svg" alt="Bank BRI" class="h-10 w-auto object-contain" />
                                <img src="/logos/Indofood_logo-en.svg.png" alt="Indofood" class="h-10 w-auto object-contain" />
                                <img src="/logos/Ultra_Milk_Logo.webp" alt="Ultra Milk" class="h-10 w-auto object-contain" />
                                
                                <!-- Set 2 -->
                                <img src="/logos/logo-mbg.png" alt="MBGBrain" class="w-48 h-auto object-contain" />
                                <img src="/logos/Logo_Badan_Gizi_Nasional.svg.png" alt="Badan Gizi Nasional" class="h-14 w-auto object-contain" />
                                <img src="/logos/Logo_Kemenkes.png" alt="Kemenkes RI" class="h-10 w-auto object-contain" />
                                <img src="/logos/Logo_Badan_Pangan_Nasional_(2022).png" alt="Bapanas" class="h-12 w-auto object-contain" />
                                <img src="/logos/Logo_BUMN_Untuk_Indonesia_2020.svg.png" alt="BUMN" class="h-8 w-auto object-contain" />
                                <img src="/logos/Logo_Bulog.svg.png" alt="Bulog" class="h-10 w-auto object-contain" />
                                <img src="/logos/Bank_Mandiri_logo_2016.svg.png" alt="Bank Mandiri" class="h-8 w-auto object-contain" />
                                <img src="/logos/Bank_BRI_2000.svg" alt="Bank BRI" class="h-10 w-auto object-contain" />
                                <img src="/logos/Indofood_logo-en.svg.png" alt="Indofood" class="h-10 w-auto object-contain" />
                                <img src="/logos/Ultra_Milk_Logo.webp" alt="Ultra Milk" class="h-10 w-auto object-contain" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <!-- Global Background Wrapper -->
        <div class="relative bg-[url('/logos/background-utama.png')] bg-cover bg-fixed bg-center bg-no-repeat">
            <!-- Overlay dihilangkan agar background asli terlihat jelas -->

            <!-- Tentang Program -->
            <section id="tentang" class="py-32 z-10 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center animate-on-scroll">
                    <div class="pr-0 lg:pr-12">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="h-px w-10 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                            <h2 class="text-sm font-bold text-emerald-600 uppercase tracking-[0.2em]">Tentang Program</h2>
                        </div>
                        <h3 class="font-serif text-4xl md:text-6xl font-bold text-slate-900 mb-6 leading-tight tracking-tight">Kemandirian Gizi & <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 italic">Ekonomi Lokal</span></h3>
                        <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                            Program Makan Bergizi Gratis (MBG) adalah inisiatif strategis nasional. MBGBrain dirancang khusus sebagai jembatan teknologi terdepan untuk memastikan kebutuhan logistik terpenuhi secara presisi oleh produsen lokal.
                        </p>
                        
                        <div class="flex flex-col gap-5">
                            <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-1">Pencocokan Cerdas Berbasis AI</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed">Algoritma otomatis memprioritaskan UMKM terdekat yang memiliki kapasitas mumpuni.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-1">Efisiensi Rantai Pasok</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed">Memangkas birokrasi dan menciptakan ekosistem suplai logistik yang cepat dan transparan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-12 lg:mt-0 relative">
                        <!-- Decorative background blur -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-100 to-teal-50 rounded-3xl blur-3xl opacity-40 z-0"></div>
                        
                        <div class="relative z-10 bg-white border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 p-8 rounded-2xl group flex flex-col justify-between">
                            <div>
                                <div class="w-14 h-14 bg-slate-50 rounded-xl border border-slate-100 flex items-center justify-center text-slate-700 mb-8 group-hover:-translate-y-1 group-hover:shadow-md group-hover:text-emerald-600 transition-all duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">Pemberdayaan UMKM</h4>
                                <p class="text-slate-500 text-sm leading-relaxed">Akses tender pemerintah tanpa birokrasi rumit, membuka peluang emas bagi industri kecil lokal.</p>
                            </div>
                            <div class="mt-8 pt-6 border-t border-slate-100">
                                <a href="#cara-kerja" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Pelajari Alurnya <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                        
                        <div class="relative z-10 bg-slate-900 border border-slate-800 shadow-2xl p-8 rounded-2xl sm:translate-y-12 group flex flex-col justify-between overflow-hidden">
                            <div class="absolute -top-12 -right-12 w-40 h-40 bg-emerald-500 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>
                            <div class="relative">
                                <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-xl border border-white/10 flex items-center justify-center text-white mb-8 group-hover:-translate-y-1 group-hover:shadow-md transition-all duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Terverifikasi Ketat</h4>
                                <p class="text-slate-300 text-sm leading-relaxed">Seluruh proses audit dilakukan secara sistematis. Hanya supplier terakreditasi yang dilibatkan.</p>
                            </div>
                            <div class="mt-8 pt-6 border-t border-slate-800 relative">
                                <a href="#syarat" class="text-sm font-semibold text-emerald-400 hover:text-emerald-300 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Lihat Syarat <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cara Menjadi Supplier -->
        <section id="cara-kerja" class="py-32 z-10 relative border-y border-slate-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center max-w-3xl mx-auto mb-20 animate-on-scroll">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="h-px w-10 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                        <h2 class="text-sm font-bold text-emerald-600 uppercase tracking-[0.2em]">Alur Kerja</h2>
                        <div class="h-px w-10 bg-gradient-to-l from-emerald-500 to-teal-400"></div>
                    </div>
                    <h3 class="font-serif text-4xl md:text-5xl font-bold text-slate-900 mb-6 tracking-tight text-center">Cara Bergabung</h3>
                    <p class="text-lg text-slate-600 font-light text-center">Proses pendaftaran dirancang semudah mungkin. Dalam hitungan hari, Anda sudah bisa terdaftar di radar SPPG lokal.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative animate-on-scroll">
                    <!-- Premium Connecting line -->
                    <div class="hidden md:block absolute top-14 left-[12%] right-[12%] h-[2px] bg-gradient-to-r from-emerald-200 via-emerald-400 to-emerald-600 z-0 opacity-70"></div>
                    
                    <!-- Step 1 -->
                    <div class="relative z-10 bg-white/70 backdrop-blur-md border border-slate-200 hover:border-emerald-300 shadow-xl shadow-slate-200/20 rounded-3xl p-8 text-center hover:-translate-y-2 transition-all duration-300 group">
                        <div class="w-16 h-16 mx-auto bg-white border border-slate-100 rounded-full shadow-md flex items-center justify-center text-xl font-bold text-slate-900 mb-6 group-hover:scale-110 group-hover:text-emerald-600 transition-all">1</div>
                        <h4 class="text-lg font-bold text-slate-900 mb-3">Registrasi Akun</h4>
                        <p class="text-sm text-slate-600 font-light leading-relaxed">Buat akun dengan email dan tentukan profil dasar usaha Anda.</p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="relative z-10 bg-white/70 backdrop-blur-md border border-slate-200 hover:border-emerald-300 shadow-xl shadow-slate-200/20 rounded-3xl p-8 text-center hover:-translate-y-2 transition-all duration-300 group">
                        <div class="w-16 h-16 mx-auto bg-white border border-slate-100 rounded-full shadow-md flex items-center justify-center text-xl font-bold text-slate-900 mb-6 group-hover:scale-110 group-hover:text-emerald-600 transition-all">2</div>
                        <h4 class="text-lg font-bold text-slate-900 mb-3">Lengkapi Profil</h4>
                        <p class="text-sm text-slate-600 font-light leading-relaxed">Tentukan titik koordinat lokasi pabrik/usaha dan kapasitas harian.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative z-10 bg-white/70 backdrop-blur-md border border-slate-200 hover:border-emerald-300 shadow-xl shadow-slate-200/20 rounded-3xl p-8 text-center hover:-translate-y-2 transition-all duration-300 group">
                        <div class="w-16 h-16 mx-auto bg-white border border-slate-100 rounded-full shadow-md flex items-center justify-center text-xl font-bold text-slate-900 mb-6 group-hover:scale-110 group-hover:text-emerald-600 transition-all">3</div>
                        <h4 class="text-lg font-bold text-slate-900 mb-3">Upload Dokumen</h4>
                        <p class="text-sm text-slate-600 font-light leading-relaxed">Unggah berkas legalitas seperti NIB untuk divalidasi oleh admin.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative z-10 bg-white/70 backdrop-blur-md border border-slate-200 hover:border-emerald-300 shadow-xl shadow-slate-200/20 rounded-3xl p-8 text-center hover:-translate-y-2 transition-all duration-300 group">
                        <div class="w-16 h-16 mx-auto bg-white border border-slate-100 rounded-full shadow-md flex items-center justify-center text-xl font-bold text-slate-900 mb-6 group-hover:scale-110 group-hover:text-emerald-600 transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-3">Terima Order</h4>
                        <p class="text-sm text-slate-600 font-light leading-relaxed">Terima notifikasi permintaan kerja sama dari SPPG yang membutuhkan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Persyaratan -->
        <section id="syarat" class="py-32 z-10 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-20 animate-on-scroll">
                    <div class="flex items-center justify-center gap-4 mb-5">
                        <div class="h-px w-10 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                        <span class="text-xs font-semibold tracking-[0.2em] uppercase text-emerald-600">Compliance & Legalitas</span>
                        <div class="h-px w-10 bg-gradient-to-l from-emerald-500 to-teal-400"></div>
                    </div>
                    <h2 class="font-serif text-4xl md:text-5xl font-bold text-slate-900 mb-6 tracking-tight">Persyaratan Dokumen</h2>
                    <p class="text-lg text-slate-500 font-light leading-relaxed">Kami menjaga integritas program dengan memastikan setiap pasokan berasal dari entitas bisnis yang legal dan tersertifikasi.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 animate-on-scroll">
                    <!-- NIB Card -->
                    <div class="group bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 hover:-translate-y-1.5 hover:border-emerald-200 transition-all duration-500 relative overflow-hidden">
                        <!-- Subtle gradient background on hover -->
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/0 to-emerald-50/0 group-hover:from-emerald-50/40 group-hover:to-teal-50/30 transition-all duration-500 rounded-3xl"></div>
                        
                        <div class="relative z-10">
                            <!-- Official Logo -->
                            <div class="w-full h-24 flex items-center justify-start mb-6">
                                <img src="/logos/nib.png" alt="NIB - Nomor Induk Berusaha" class="h-20 w-auto object-contain" />
                            </div>
                            
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-1 h-1 rounded-full bg-rose-500"></span>
                                <span class="text-[0.65rem] font-bold tracking-widest uppercase text-slate-500">Syarat Wajib</span>
                            </div>
                            <h4 class="font-serif text-2xl font-bold text-slate-900 mb-3">Nomor Induk Berusaha</h4>
                            <p class="text-slate-500 text-sm font-light leading-relaxed mb-6">Dokumen identitas utama pelaku usaha yang diterbitkan oleh sistem OSS pemerintah. Menjadi syarat mutlak untuk berpartisipasi.</p>
                            
                            <!-- Trust Bar -->
                            <div class="flex items-center gap-2 pt-5 border-t border-slate-100">
                                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="text-xs text-slate-400 font-medium">Diverifikasi oleh Sistem OSS</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Halal Card -->
                    <div class="group bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 hover:-translate-y-1.5 hover:border-emerald-200 transition-all duration-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/0 to-emerald-50/0 group-hover:from-emerald-50/40 group-hover:to-teal-50/30 transition-all duration-500 rounded-3xl"></div>
                        
                        <div class="relative z-10">
                            <!-- Official Logo -->
                            <div class="w-full h-24 flex items-center justify-start mb-6">
                                <img src="/logos/Halal_Indonesia.svg" alt="Halal Indonesia" class="h-20 w-auto object-contain" />
                            </div>
                            
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                <span class="text-[0.65rem] font-bold tracking-widest uppercase text-slate-500">Nilai Plus</span>
                            </div>
                            <h4 class="font-serif text-2xl font-bold text-slate-900 mb-3">Sertifikat Halal</h4>
                            <p class="text-slate-500 text-sm font-light leading-relaxed mb-6">Menjamin kehalalan produk sesuai standar BPJPH. Menambah bobot skor Anda pada algoritma pencocokan kami.</p>
                            
                            <!-- Trust Bar -->
                            <div class="flex items-center gap-2 pt-5 border-t border-slate-100">
                                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="text-xs text-slate-400 font-medium">Diverifikasi oleh BPJPH</span>
                            </div>
                        </div>
                    </div>

                    <!-- BPOM / SIUP Card -->
                    <div class="group bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 hover:-translate-y-1.5 hover:border-emerald-200 transition-all duration-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/0 to-emerald-50/0 group-hover:from-emerald-50/40 group-hover:to-teal-50/30 transition-all duration-500 rounded-3xl"></div>
                        
                        <div class="relative z-10">
                            <!-- Official Logo -->
                            <div class="w-full h-24 flex items-center justify-start mb-6">
                                <img src="/logos/BADAN_POM.png" alt="Badan POM" class="h-20 w-auto object-contain" />
                            </div>
                            
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                <span class="text-[0.65rem] font-bold tracking-widest uppercase text-slate-500">Nilai Plus</span>
                            </div>
                            <h4 class="font-serif text-2xl font-bold text-slate-900 mb-3">SIUP / Izin Edar BPOM</h4>
                            <p class="text-slate-500 text-sm font-light leading-relaxed mb-6">Surat Izin Usaha Perdagangan atau Izin Edar BPOM melengkapi portofolio legalitas bisnis Anda.</p>
                            
                            <!-- Trust Bar -->
                            <div class="flex items-center gap-2 pt-5 border-t border-slate-100">
                                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="text-xs text-slate-400 font-medium">Diverifikasi oleh Badan POM RI</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Trust Banner -->
                <div class="mt-16 animate-on-scroll">
                    <div class="bg-gradient-to-r from-slate-50 to-emerald-50/30 rounded-2xl border border-slate-100 p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-900 text-lg">Verifikasi Multi-Lapis</h5>
                                <p class="text-sm text-slate-500 font-light">Seluruh dokumen divalidasi secara otomatis oleh sistem AI kami dan ditinjau oleh tim verifikasi.</p>
                            </div>
                        </div>
                        <Link :href="route('register')" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-emerald-600/20 hover:shadow-xl hover:shadow-emerald-600/30 whitespace-nowrap">
                            Daftar Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="py-32 border-t border-slate-200/50 z-10 relative">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 animate-on-scroll">
                <div class="text-center mb-16">
                    <h2 class="font-serif text-4xl md:text-5xl font-bold text-slate-900 mb-4 tracking-tight">Pertanyaan Seputar MBGBrain</h2>
                </div>
                
                <div class="space-y-4">
                    <div v-for="(faq, index) in faqs" :key="index" class="bg-white border-b border-slate-200 overflow-hidden transition-all duration-300">
                        <button @click="toggleFaq(index)" class="w-full py-6 text-left flex justify-between items-center focus:outline-none group">
                            <span class="font-serif font-bold text-slate-900 text-xl group-hover:text-emerald-600 transition-colors">{{ faq.question }}</span>
                            <div class="ml-4 flex-shrink-0 flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition-colors">
                                <svg class="w-5 h-5 transform transition-transform duration-300" :class="{ 'rotate-180': faq.open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div class="overflow-hidden transition-all duration-500 ease-in-out" :class="faq.open ? 'max-h-40 pb-6 opacity-100' : 'max-h-0 opacity-0'">
                            <p class="text-slate-500 text-base leading-relaxed font-light pr-12">{{ faq.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <!-- Footer -->
        <footer class="relative pt-20 pb-10 z-10 bg-cover bg-center bg-no-repeat border-t border-slate-200" style="background-image: url('/logos/background-footer.png');">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-28">
                    <div class="col-span-1 md:col-span-2 pr-8">
                        <div class="mb-6">
                            <img src="/logos/logo-mbg.png" alt="MBGBrain Logo" class="h-40 w-auto object-contain" />
                        </div>
                        <p class="text-slate-600 text-base max-w-sm leading-relaxed font-light mb-8">
                            Platform ekosistem rantai pasok digital yang mempertemukan SPPG dengan UMKM secara cerdas, adil, dan transparan.
                        </p>
                        
                        <!-- Social Icons -->
                        <div class="flex items-center gap-4">
                            <!-- Facebook -->
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-white hover:bg-emerald-600 hover:border-emerald-600 transition-all duration-300 hover:-translate-y-1 shadow-md">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" /></svg>
                            </a>
                            <!-- X (Twitter) -->
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-white hover:bg-emerald-600 hover:border-emerald-600 transition-all duration-300 hover:-translate-y-1 shadow-md">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" /></svg>
                            </a>
                            <!-- Instagram -->
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-white hover:bg-emerald-600 hover:border-emerald-600 transition-all duration-300 hover:-translate-y-1 shadow-md">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                            </a>
                            <!-- LinkedIn -->
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-white hover:bg-emerald-600 hover:border-emerald-600 transition-all duration-300 hover:-translate-y-1 shadow-md">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" /></svg>
                            </a>
                            <!-- WhatsApp -->
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-white hover:bg-emerald-600 hover:border-emerald-600 transition-all duration-300 hover:-translate-y-1 shadow-md">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.215.603 4.303 1.666 6.136L.24 23.757l5.733-1.504A11.97 11.97 0 0012.031 24c6.646 0 12.03-5.385 12.03-12.03S18.677 0 12.031 0zm0 21.986c-1.862 0-3.62-.511-5.18-1.42l-.37-.22-3.854 1.01.1.05-1.026-3.75-.24-.38a9.98 9.98 0 01-1.543-5.336C1.944 6.446 6.446 1.944 12.03 1.944c5.584 0 10.086 4.502 10.086 10.086 0 5.584-4.502 10.086-10.086 10.086zm5.542-7.56c-.304-.152-1.796-.886-2.074-.988-.28-.1-.482-.153-.684.153-.203.303-.784.987-.96 1.19-.176.202-.353.227-.657.076-1.56-.78-2.677-1.493-3.673-3.23-.203-.356-.022-.548.13-.7.136-.135.303-.355.455-.532.152-.177.202-.303.303-.506.101-.202.05-.38-.025-.532-.076-.151-.684-1.644-.936-2.25-.246-.594-.497-.514-.684-.523-.176-.01-.38-.01-.582-.01-.202 0-.53.075-.808.38C6.67 7.02 5.91 7.73 5.91 9.172c0 1.442.834 2.833.95 2.986.116.152 2.038 3.11 4.938 4.364 2.072.895 2.87.755 3.395.636.634-.144 1.796-.733 2.048-1.44.253-.708.253-1.316.177-1.443-.075-.126-.277-.202-.58-.354z" /></svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-sm">Tautan</h4>
                        <ul class="space-y-4">
                            <li><a href="#tentang" class="text-base text-slate-600 hover:text-emerald-600 transition-colors">Tentang Program</a></li>
                            <li><a href="#cara-kerja" class="text-base text-slate-600 hover:text-emerald-600 transition-colors">Cara Bergabung</a></li>
                            <li><a href="#syarat" class="text-base text-slate-600 hover:text-emerald-600 transition-colors">Persyaratan Dokumen</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-6 uppercase tracking-widest text-sm">Legal</h4>
                        <ul class="space-y-4">
                            <li><a href="#" class="text-base text-slate-600 hover:text-emerald-600 transition-colors">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="text-base text-slate-600 hover:text-emerald-600 transition-colors">Kebijakan Privasi</a></li>
                            <li><a href="#faq" class="text-base text-slate-600 hover:text-emerald-600 transition-colors">Pusat Bantuan</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Bottom section sits on the dark wave, so text must be white -->
                <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-white opacity-70 font-light">
                        &copy; 2026 Badan Gizi Nasional. Hak cipta dilindungi undang-undang.
                    </p>
                    <p class="text-xs text-white opacity-70 font-light tracking-wide flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Powered by Laravel v{{ laravelVersion }} & PHP v{{ phpVersion }}
                    </p>
                </div>
            </div>
        </footer>
        
        </div> <!-- End of Global Background Wrapper -->

    </div>
</template>

<style>
/* Custom animations for Marquee */
@keyframes marquee {
  0% { transform: translateX(0%); }
  100% { transform: translateX(-50%); }
}

.animate-marquee {
  animation: marquee 30s linear infinite;
}

.animate-marquee:hover {
  animation-play-state: paused;
}
</style>
