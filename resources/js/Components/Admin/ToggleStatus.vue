<script setup>
import { router } from '@inertiajs/vue3'
import Radio from '@/Components/Radio.vue';

const { toggle, toggleType } = defineProps(['toggle', 'toggleType']);

const toggleStatus = async (toggle) => {
    const url = route('admin.' + toggleType + '.status', {
        toggleType: toggleType,
        id: toggle.id,
    });

    await router.put(url, {
        status: toggle.status,
    }, {
        preserveScroll: true,
    });
};
</script>


<template>
    <div class="form-check form-switch relative">
        <Radio v-model:checked="toggle.status" :id="'switch-' + (toggle.id)"
            class="form-check-input checked:bg-auto checked:bg-right cursor-pointer" type="checkbox" name="status"
            :value="toggle.status == 1 ? 1 : ''" @change="toggleStatus(toggle)" />

        <label :for="'switch-' + (toggle.id)"
            class="py-1 absolute top-[14px] left-0 form-check-label text-[8px] select-none cursor-pointer">
            <small :class="toggle.status ? 'text-blue-700 font-bold' : ''">
                {{ toggle.status ? 'SHOWED' : 'HIDDEN' }}
            </small>
        </label>
    </div>
</template>