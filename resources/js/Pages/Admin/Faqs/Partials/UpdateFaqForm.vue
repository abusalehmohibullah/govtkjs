  
<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    faq: Object,
    priorities: Object,
});

const form = useForm({
    _method: 'PUT',
    question: props.faq.question,
    answer: props.faq.answer,
    published_on: props.faq.published_on,
    scroll: props.faq.scroll, // Ensure scroll is a string
    attachment: null, // Initialize attachment as null
    priority: props.faq.priority, 
});

const selectedPriority = ref({ id: '', name: '' });
const selectedPriorityOption = props.priorities.find(priority => priority.id === form.priority);
    if (selectedPriorityOption) {
        selectedPriority.value = { id: selectedPriorityOption.id, name: selectedPriorityOption.name };
    } else {
        selectedPriority.value = { id: '', name: '' };
    }

watch(() => form.priority, (newPriority, oldPriority) => {
    const selectedPriorityOption = props.priorities.find(priority => priority.id === newPriority);
    if (selectedPriorityOption) {
        selectedPriority.value = { id: selectedPriorityOption.id, name: selectedPriorityOption.name };
    } else {
        selectedPriority.value = { id: '', name: '' };
    }
});

const handlePrioritySelected = (selectedLabel) => {
    form.priority = selectedLabel;
};


const updateFaq = () => {
    form.post(route('admin.faqs.update', props.faq.id), {
        errorBag: 'updateFaq',
        preserveScroll: true,
    });
};
</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateFaq">
            <template #title>
                Edit FAQ
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="question" value="Question">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="question" v-model="form.question" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.question }" type="text" name="question" />
                    <InputError :message="form.errors.question" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="answer" value="Answer" />
                    <TextArea id="answer" v-model="form.answer" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.answer }" name="answer" />
                    <InputError :message="form.errors.answer" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="priority" value="Select Order">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="priorities" inputName="priority" :fieldName="'name'" :valueField="'id'"
                        :selectedOption="selectedPriority" @option-selected="handlePrioritySelected" />

                    <InputError :message="form.errors.priority" class="text-red-500" />
                </div>
            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>