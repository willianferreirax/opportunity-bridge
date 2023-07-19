<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm('tst2', {
test: '',
});

const submit = () => {
    // form.post(route('register'), {

    // });

    emit("submit")
};

const emit = defineEmits(["submit"])
</script>
<template>
    <form @submit.prevent="submit">
                <div>
                    <InputLabel for="test" value="test" />
                    <TextInput
                        id="test"
                        v-model="form.test"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="test"
                    />
                    <InputError class="mt-2" :message="form.errors.test" />
                </div>

            

                <div class="flex items-center justify-center mt-4">
                    
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Finalizar
                    </PrimaryButton>
                </div>
            </form>
</template>