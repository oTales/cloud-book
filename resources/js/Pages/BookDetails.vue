<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import ModalSucess from "@/Components/ModalSucess.vue";
import {ref} from "vue";

defineProps(['book']);

const form = useForm({
    rented_at: '',
    returned_at: '',
});
let modal = ref(false);

function openModal() {
    console.log(ref());
    modal.value.openModal();
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-3xl items-center justify-center mx-auto my-10 flex gap-5 flex-wrap">
            <img :src="book.image" :alt="book.title" />

            <div >
                <h2>{{ book.title }}</h2>
                <h3>{{ book.author }}</h3>
                <p>{{ book.description }}</p>

                <form @submit.prevent="form.post(route('rent-book.store', book.id))">


                    <InputLabel for="returned_at" value="Data para Retorno" />
                    <div class="flex justify-between items-center flex-wrap">
                    <TextInput
                        id="returned_at"
                        type="date"
                        class="mt-1 h-10 w-72"
                        v-model="form.returned_at"
                        autofocus
                        autocomplete="username"
                    />
                    <InputError></InputError>

                    <PrimaryButton
                        class="items-center bg-blue-700"
                        :class="{'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="openModal()"
                    >
                        Alugar
                    </PrimaryButton>
                    </div>
                </form>
            </div>

            <ModalSucess :is-open="true">
            </ModalSucess>
        </div>
    </AuthenticatedLayout>
</template>
