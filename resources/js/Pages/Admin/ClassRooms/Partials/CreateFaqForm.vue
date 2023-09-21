  
<script setup>

import { useForm } from '@inertiajs/vue3';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    question: '',
    answer: '',
});

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
            <template #question>
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
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.question }" type="text" name="question" />
                    <InputError :message="form.errors.question" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="answer" value="Answer" />
                    <TextArea id="answer" v-model="form.answer" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.answer }" name="answer" />
                    <InputError :message="form.errors.answer" class="text-red-500" />
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