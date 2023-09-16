<script setup>
defineProps({
    on: Boolean,
});
</script>

<template>
    <div>
        <transition leave-active-class="transition ease-in duration-1000" leave-from-class="opacity-100"
            leave-to-class="opacity-0">
            <div v-show="on" class="text-sm">
                <slot />
            </div>
        </transition>
    </div>
</template>


<!--<template #actions>
        <PrimaryButton :class="{ 'opacity-25': form.processing, 'text-green-500': form.recentlySuccessful }"
            :disabled="form.processing">
            {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Save') }}
        </PrimaryButton>
    </template> -->