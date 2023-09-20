<script setup>
defineProps({
    infos : Object,
});
</script>

<template>
    <div class="grid gap-4 grid-cols-1 grid-rows-3 sm:gap-10 sm:grid-cols-3 sm:grid-rows-1 my-5">

    <div class="card m-0">
        <div class="card-body bg-gradient-to-r from-cyan-300 to-blue-300">
            <h5 class="text-slate-600 text-center">Address</h5>
            <h3 class="text-center text-black">
                {{ infos.address }}
            </h3>
        </div>
    </div>
    <div class="card m-0">
        <div class="card-body bg-gradient-to-r from-cyan-300 to-blue-300">
            <h5 class="text-slate-600 text-center">Contact</h5>
            <h3 class="text-center text-black">
                {{ infos.phone }}
            </h3>
        </div>
    </div>
    <div class="card m-0">
        <div class="card-body bg-gradient-to-r from-cyan-300 to-blue-300">
            <h5 class="text-slate-600 text-center">Email</h5>
            <h3 class="text-center text-black">
                {{ infos.email }}
            </h3>
        </div>
    </div>

</div>
</template>