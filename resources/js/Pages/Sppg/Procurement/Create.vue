<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { 
    ClipboardList, 
    Box, 
    MapPin, 
    CalendarClock, 
    FileText, 
    Banknote, 
    ArrowLeft, 
    Save,
    ChevronDown
} from 'lucide-vue-next';

const form = useForm({
    kategori_kebutuhan: '',
    kuantitas_porsi: '',
    harga_maksimal_per_porsi: '',
    radius_maksimal_km: '',
    tanggal_mulai: '',
    tanggal_selesai: '',
    deskripsi_kebutuhan: '',
});

const submit = () => {
    form.post(route('sppg.procurement.store'));
};
</script>

<template>
    <Head title="Buat Pengadaan Baru" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-3">
                <Link :href="route('sppg.procurement.index')" class="flex items-center justify-center w-8 h-8 rounded-full bg-white text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-colors shadow-sm ring-1 ring-gray-900/5">
                    <ArrowLeft class="w-4 h-4" />
                </Link>
                <h2 class="font-display font-semibold text-xl text-gray-800 leading-tight">Buat Permintaan Pengadaan Baru</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <!-- Form Container -->
                <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden relative">
                    <!-- Top accent border -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-mbg-green to-blue-500"></div>
                    
                    <div class="p-8 sm:p-10">
                        <div class="mb-8">
                            <h3 class="text-lg font-display font-bold text-gray-900">Detail Pengadaan</h3>
                            <p class="text-sm text-gray-500 mt-1">Lengkapi informasi kebutuhan untuk disebarkan ke jaringan supplier MBGBrain.</p>
                        </div>

                        <form @submit.prevent="submit" class="space-y-8">
                            
                            <!-- Kategori -->
                            <div>
                                <label for="kategori_kebutuhan" class="block text-sm font-semibold text-gray-700 mb-2">Kategori Kebutuhan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <ClipboardList class="w-5 h-5" />
                                    </div>
                                    <select
                                        id="kategori_kebutuhan"
                                        v-model="form.kategori_kebutuhan"
                                        class="block w-full pl-11 pr-10 py-3 text-gray-900 border-gray-200 focus:border-mbg-green focus:ring-mbg-green rounded-xl shadow-sm appearance-none transition-colors cursor-pointer"
                                        required
                                    >
                                        <option value="" disabled>Pilih kategori yang paling sesuai...</option>
                                        <option value="Makanan Pokok">Makanan Pokok</option>
                                        <option value="Lauk Pauk">Lauk Pauk</option>
                                        <option value="Sayuran">Sayuran</option>
                                        <option value="Buah-buahan">Buah-buahan</option>
                                        <option value="Susu/Minuman Sehat">Susu/Minuman Sehat</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-gray-400">
                                        <ChevronDown class="w-5 h-5" />
                                    </div>
                                </div>
                                <InputError class="mt-2" :message="form.errors.kategori_kebutuhan" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Kuantitas -->
                                <div>
                                    <label for="kuantitas_porsi" class="block text-sm font-semibold text-gray-700 mb-2">Kuantitas</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                            <Box class="w-5 h-5" />
                                        </div>
                                        <input
                                            id="kuantitas_porsi"
                                            type="number"
                                            class="block w-full pl-11 pr-16 py-3 border-gray-200 focus:border-mbg-green focus:ring-mbg-green rounded-xl shadow-sm transition-colors"
                                            v-model="form.kuantitas_porsi"
                                            min="1"
                                            placeholder="Contoh: 500"
                                            required
                                        />
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-sm font-medium text-gray-400">Porsi</span>
                                        </div>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.kuantitas_porsi" />
                                </div>

                                <!-- Harga Maksimal -->
                                <div>
                                    <label for="harga_maksimal_per_porsi" class="block text-sm font-semibold text-gray-700 mb-2">Harga Maksimal</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <span class="text-sm font-bold text-gray-500">Rp</span>
                                        </div>
                                        <input
                                            id="harga_maksimal_per_porsi"
                                            type="number"
                                            class="block w-full pl-11 pr-16 py-3 border-gray-200 focus:border-mbg-green focus:ring-mbg-green rounded-xl shadow-sm transition-colors"
                                            v-model="form.harga_maksimal_per_porsi"
                                            min="0"
                                            placeholder="15000"
                                            required
                                        />
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-sm font-medium text-gray-400">/ Porsi</span>
                                        </div>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.harga_maksimal_per_porsi" />
                                </div>
                            </div>

                            <!-- Radius Pencarian -->
                            <div>
                                <label for="radius_maksimal_km" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                    Radius Pencarian Maksimal
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold" title="Membantu Anda menemukan supplier terdekat">?</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <MapPin class="w-5 h-5" />
                                    </div>
                                    <input
                                        id="radius_maksimal_km"
                                        type="number"
                                        class="block w-full pl-11 pr-14 py-3 border-gray-200 focus:border-mbg-green focus:ring-mbg-green rounded-xl shadow-sm transition-colors"
                                        v-model="form.radius_maksimal_km"
                                        step="0.1"
                                        min="0"
                                        placeholder="Contoh: 15.5"
                                        required
                                    />
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-sm font-bold text-gray-500">KM</span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center gap-1.5">
                                    <MapPin class="w-3.5 h-3.5 text-gray-400" />
                                    Sistem akan memprioritaskan supplier yang berada di dalam radius ini dari lokasi Anda.
                                </p>
                                <InputError class="mt-2" :message="form.errors.radius_maksimal_km" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-2 border-t border-gray-100">
                                <!-- Tanggal Mulai -->
                                <div>
                                    <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai Pengiriman</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                            <CalendarClock class="w-5 h-5" />
                                        </div>
                                        <input
                                            id="tanggal_mulai"
                                            type="date"
                                            class="block w-full pl-11 pr-4 py-3 border-gray-200 focus:border-mbg-green focus:ring-mbg-green rounded-xl shadow-sm transition-colors text-gray-700"
                                            v-model="form.tanggal_mulai"
                                            required
                                        />
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.tanggal_mulai" />
                                </div>

                                <!-- Tanggal Selesai -->
                                <div>
                                    <label for="tanggal_selesai" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Berakhir</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                            <CalendarClock class="w-5 h-5" />
                                        </div>
                                        <input
                                            id="tanggal_selesai"
                                            type="date"
                                            class="block w-full pl-11 pr-4 py-3 border-gray-200 focus:border-mbg-green focus:ring-mbg-green rounded-xl shadow-sm transition-colors text-gray-700"
                                            v-model="form.tanggal_selesai"
                                            required
                                        />
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.tanggal_selesai" />
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="pt-2 border-t border-gray-100">
                                <label for="deskripsi_kebutuhan" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Kebutuhan Tambahan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                                <div class="relative">
                                    <div class="absolute top-3.5 left-3.5 pointer-events-none text-gray-400">
                                        <FileText class="w-5 h-5" />
                                    </div>
                                    <textarea
                                        id="deskripsi_kebutuhan"
                                        v-model="form.deskripsi_kebutuhan"
                                        class="block w-full pl-11 pr-4 py-3 border-gray-200 focus:border-mbg-green focus:ring-mbg-green rounded-xl shadow-sm transition-colors resize-y min-h-[120px]"
                                        placeholder="Berikan spesifikasi lebih detail, misalnya: 'Beras kualitas medium, kemasan 5kg, diutamakan dari petani lokal...'"
                                    ></textarea>
                                </div>
                                <InputError class="mt-2" :message="form.errors.deskripsi_kebutuhan" />
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                                <Link 
                                    :href="route('sppg.procurement.index')" 
                                    class="px-6 py-3 text-sm font-bold text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors"
                                >
                                    Batal
                                </Link>
                                <button 
                                    type="submit" 
                                    :disabled="form.processing"
                                    class="flex items-center gap-2 px-8 py-3 bg-mbg-green text-white text-sm font-bold rounded-xl shadow-lg shadow-mbg-green/30 hover:bg-emerald-600 hover:shadow-xl hover:shadow-mbg-green/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mbg-green transition-all active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed"
                                >
                                    <Save class="w-4 h-4" />
                                    {{ form.processing ? 'Menyimpan...' : 'Terbitkan Permintaan' }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
