  
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
    priorities: Object,
});

const form = useForm({
    question: '',
    answer: '',
    priority: '',
});

const selectedPriority = ref({ id: '', name: '' });
const selectedPriorityOption = props.priorities[props.priorities.length - 1];

if (selectedPriorityOption) {
    selectedPriority.value = { id: selectedPriorityOption.id, name: selectedPriorityOption.name };
    form.priority = selectedPriorityOption.id;
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

const createFaq = () => {
    form.post(route('admin.faqs.store'), {
        errorBag: 'createFaq',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createFaq">
            <template #title>
                Add FAQ
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
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.question }" type="text"
                        name="question" />
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
                    {{ form.processing ? 'Creating...' : (form.recentlySuccessful ? 'Created!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>