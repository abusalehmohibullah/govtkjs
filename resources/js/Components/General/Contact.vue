<script setup>
defineProps({
    infos : Object,
});
</script>

<template>
    <div class="grid gap-4 grid-cols-1 grid-rows-3 sm:gap-10 sm:grid-cols-3 sm:grid-rows-1 my-5">

    <div class="card m-0 group">
        <div class="card-body rounded bg-gradient-to-tr from-cyan-300 to-blue-300">
            <div class="text-7xl text-center text-transparent bg-clip-text bg-gradient-to-r from-red-800 to-red-400"><i class="bi bi-geo-alt"></i></div>
            <h5 class="text-slate-600 text-center">Address</h5>
            <h3 class="text-center text-black">
                {{ infos.address }}
            </h3>
        </div>
        <div class="absolute w-full card-body rounded bg-gradient-to-bl opacity-[0.001] group-hover:opacity-100 from-cyan-300 to-blue-300 transition-all duration-300">
            <div class="text-7xl text-center text-transparent bg-clip-text bg-gradient-to-r from-red-800 to-red-400"><i class="bi bi-geo-alt"></i></div>
            <h5 class="text-slate-600 text-center">Address</h5>
            <h3 class="text-center text-black">
                {{ infos.address }}
            </h3>
        </div>
    </div>
    <div class="card m-0 group">
        <div class="card-body rounded bg-gradient-to-tr from-cyan-300 to-blue-300">
            <div class="text-7xl text-center text-transparent bg-clip-text bg-gradient-to-r from-green-800 to-green-400"><i class="bi bi-telephone"></i></div>
            <h5 class="text-slate-600 text-center">Contact</h5>
            <h3 class="text-center text-black">
                {{ infos.phone }}
            </h3>
        </div>
        <div class="absolute w-full card-body rounded bg-gradient-to-bl opacity-[0.001] group-hover:opacity-100 from-cyan-300 to-blue-300 transition-all duration-300">
            <div class="text-7xl text-center text-transparent bg-clip-text bg-gradient-to-r from-green-800 to-green-400"><i class="bi bi-telephone"></i></div>
            <h5 class="text-slate-600 text-center">Contact</h5>
            <h3 class="text-center text-black">
                {{ infos.phone }}
            </h3>
        </div>
    </div>
    <div class="card m-0 group">
        <div class="card-body rounded bg-gradient-to-tr from-cyan-300 to-blue-300">
            <div class="text-7xl text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-400"><i class="bi bi-envelope"></i></div>
            <h5 class="text-slate-600 text-center">Email</h5>
            <h3 class="text-center text-black">
                {{ infos.email }}
            </h3>
        </div>
        <div class="absolute w-full card-body rounded bg-gradient-to-bl opacity-[0.001] group-hover:opacity-100 from-cyan-300 to-blue-300 transition-all duration-300">
            <div class="text-7xl text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-400"><i class="bi bi-envelope"></i></div>
            <h5 class="text-slate-600 text-center">Email</h5>
            <h3 class="text-center text-black">
                {{ infos.email }}
            </h3>
        </div>
    </div>

</div>
</template>