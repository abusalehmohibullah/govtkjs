<script setup>
defineProps({
    faqs: Object,
});
</script>
<template>
    <div class="shadow-sm bg-white mb-3 py-2 rounded">
        <div class="accordion accordion-flush px-4" id="faqs-accordion">
            <h2 class="p-2">Frequently Asked Questions</h2>
            <hr class="m-0">

            <div v-for="(faq, index) in faqs" class="accordion-item animate-on-scroll border" data-animation="fadeInDown">
                <h2 class="accordion-header" :id="'flush-heading-' + index">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        :data-bs-target="'#flush-collapse-' + index" aria-expanded="false"
                        :aria-controls="'flush-collapse-' + index">
                        <span class="text-base">{{ faq.question }}</span>
                    </button>
                </h2>
                <div :id="'flush-collapse-' + index" class="accordion-collapse collapse bg-white"
                    :aria-labelledby="'flush-heading-' + index" data-bs-parent="#faqs-accordion">
                    <div class="accordion-body text-base">{{ faq.answer }}</div>
                </div>
            </div>



        </div>
    </div>
</template>