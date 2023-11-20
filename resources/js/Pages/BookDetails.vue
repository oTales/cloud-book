<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

defineProps(['book']);

const form = useForm({
    rented_at: '',
    returned_at: '',
});

</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-sm items-center">
            <img :src="book.image" :alt="book.title" />
            <h2>{{ book.title }}</h2>
            <h3>{{ book.author }}</h3>
            <p>{{ book.description }}</p>

            <form @submit.prevent="form.post(route('rent-book.store', book.id))">

                <!-- Usando v-model diretamente no input -->

                <InputLabel for="returned_at" value="Data para Retorno" />

                <TextInput
                    id="returned_at"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.returned_at"
                    autofocus
                    autocomplete="username"
                />
                <InputError></InputError>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Alugar
                </PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
