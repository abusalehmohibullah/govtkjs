<script setup>
import { computed, useSlots } from 'vue';


</script>

<template>
        <div class="mt-5 overflow-auto">
            <table class="w-full border-collapse border bg-white">
                    <thead>
                        <slot name="thead"></slot>
                    </thead>
                    <tbody>
                        <slot name="tbody"></slot>
                    </tbody>
            </table>

        </div>
</template>
