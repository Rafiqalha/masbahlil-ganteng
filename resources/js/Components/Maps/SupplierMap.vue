<script setup>
import { onMounted, ref, watch } from 'vue';
import 'leaflet/dist/leaflet.css';

const props = defineProps({
    sppgLat: { type: Number, required: true },
    sppgLng: { type: Number, required: true },
    radiusKm: { type: Number, default: 50 },
    suppliers: { type: Array, default: () => [] }
});

const mapContainer = ref(null);
let map = null;
let markers = [];
let circle = null;

// Fix Leaflet marker icons issue in Vue/Vite
const setupLeafletIcons = async (L) => {
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon-2x.png',
        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
    });
};

const initMap = async () => {
    if (typeof window === 'undefined') return;
    
    const L = await import('leaflet');
    await setupLeafletIcons(L);

    if (map) {
        map.remove();
    }

    map = L.map(mapContainer.value).setView([props.sppgLat, props.sppgLng], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Marker SPPG
    const sppgIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    L.marker([props.sppgLat, props.sppgLng], { icon: sppgIcon })
        .addTo(map)
        .bindPopup('<b>Lokasi SPPG Anda</b>')
        .openPopup();

    // Lingkaran Radius Pencarian
    circle = L.circle([props.sppgLat, props.sppgLng], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
        radius: props.radiusKm * 1000 // meter
    }).addTo(map);

    // Marker Suppliers
    renderSuppliers(L);
};

const renderSuppliers = (L) => {
    // Hapus marker lama
    markers.forEach(m => m.remove());
    markers = [];

    const bounds = L.latLngBounds([ [props.sppgLat, props.sppgLng] ]);

    props.suppliers.forEach(s => {
        if (s.supplier && s.supplier.latitude && s.supplier.longitude) {
            const marker = L.marker([s.supplier.latitude, s.supplier.longitude])
                .addTo(map)
                .bindPopup(`
                    <div class="text-sm">
                        <b>${s.supplier.nama_usaha}</b><br>
                        Jarak: ${Number(s.distance_km).toFixed(2)} KM<br>
                        Skor Kecocokan: ${(Number(s.total_score) * 100).toFixed(1)}%<br>
                        Ranking: #${s.ranking}
                    </div>
                `);
            markers.push(marker);
            bounds.extend([s.supplier.latitude, s.supplier.longitude]);
        }
    });

    // Zoom agar semua marker terlihat jika ada supplier
    if (props.suppliers.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }
};

onMounted(() => {
    initMap();
});

watch(() => props.suppliers, async () => {
    if (map) {
        const L = await import('leaflet');
        renderSuppliers(L);
    }
}, { deep: true });
</script>

<template>
    <div class="rounded-lg border border-gray-300 shadow-sm overflow-hidden">
        <div ref="mapContainer" class="w-full h-96 z-0"></div>
    </div>
</template>

<style scoped>
.z-0 {
    z-index: 0 !important;
}
</style>
