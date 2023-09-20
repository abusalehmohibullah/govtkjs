<script setup>
defineProps({
    faqs : Object,
});
</script>
<template>

    <div class="shadow-sm bg-white mb-3 py-2 rounded">
        <div class="accordion accordion-flush" id="faqs-accordion">
            <div class="h2 p-2 deep-color large-text">Frequently Asked Questions</div>
            <hr class="m-0">

            <div v-for="(faq, index) in faqs" class="accordion-item animate-on-scroll" data-animation="fadeInDown">
                <h2 class="accordion-header" id="flush-heading">
                    <button class="accordion-button collapsed bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse">
                        {{ faq.question }}
                    </button>
                </h2>
                <div id="flush-collapse1" class="accordion-collapse collapse bg-light" aria-labelledby="flush-heading" data-bs-parent="#faqs-accordion">
                    <div class="accordion-body mini-text">{{ faq.answer }}</div>
                </div>
            </div>


        </div>
    </div>


</template>